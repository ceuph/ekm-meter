<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 26/06/2019
 * Time: 9:29 AM
 */

namespace app\controllers;


use app\models\GroupsSearch;
use yii\db\Query;
use yii\web\Controller;

class ReportController extends Controller
{
    const GRANULARITY_METER = 'meter';
    const GRANULARITY_GROUP = 'groups';
    public $queryCount = 0;

    public static function getHtmlClass($data, $value, $min, $max)
    {
        $class = ['meter-data'];

        if (min($data) == $value) {
            $class[] = 'meter-data-row-min';
        }

        if (max($data) == $value) {
            $class[] = 'meter-data-row-max';
        }

        if ($min == $value) {
            $class[] = 'meter-data-min';
        }

        if ($max == $value) {
            $class[] = 'meter-data-max';
        }

        return implode(' ', $class);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMeter()
    {

    }

    public function actionGroups()
    {
        $dropDownItems = GroupsSearch::find()->all();
        $data = [];
        if ($post = \Yii::$app->request->post()) {
            foreach ($post['id'] as $i => $value) {
                $result = $this->getQueryByGranularity(self::GRANULARITY_GROUP, $post, $i)->all();
                $this->processResultsToData($post['type'], $post['data'], $post['color'], $result, $data, 'yes' == $post['shift']);
            }
            $this->postProcessData($data, 'yes' == $post['shift']);
        }
        return $this->render('groups',[
            'dropDownItems' => $dropDownItems,
            'data' => $data
        ]);
    }

    public function postProcessData(&$data, $shift = true) {
        ksort($data['labels']);
        $data['rows'] = [
            'labels' => [],
            'data' => [],
        ];
        $data['min'] = null;
        $data['max'] = 0;
        foreach ($data['labels'] as $index => $label) {
            foreach ($data['data'] as $name => $value) {
                if ($shift && !isset($data['data'][$name][$index])) {
                    $data['data'][$name][$index] = 0;
                }
                $data['rows']['labels'][$name] = $name;
                $data['rows']['data'][$index][$name] = isset($data['data'][$name][$index]) ? $data['data'][$name][$index] : 0;
                if (isset($data['data'][$name][$index])) {
                    if (null === $data['min']) {
                        $data['min'] = $data['data'][$name][$index];
                    }
                    $data['min'] = $data['min'] > $data['data'][$name][$index] ? $data['data'][$name][$index] : $data['min'];
                    $data['max'] = $data['max'] < $data['data'][$name][$index] ? $data['data'][$name][$index] : $data['max'];
                }
            }
        }
        foreach ($data['data'] as $name => $value) {
            ksort($data['data'][$name]);
        }
    }

    public function processResultsToData($type, $dataType, $colors, $result, &$data, $shift = true)
    {
        $format = $this->getFormatFromType($type);
        if (empty($data)) {
            $data['labels'] = [];
            $data['data'] = [];
            $data['colors'] = $colors;
        }
        foreach ($result as $i => $row) {
            $index = $i;
            $label = $i;
            $name = array_shift($row) . (!$shift ? $this->queryCount : null);
            $startTime = array_shift($row);
            $endTime = array_shift($row);
            if ($shift) {
                $index = date($format['index'], $startTime);
                $label = date($format['from'], $startTime) . date($format['to'], $endTime);
            }
            $data['labels'][$index] = $label;
            $data['data'][$name][$index] = $this->getValueFromDataType($row, $dataType);
        }
        $this->queryCount++;
    }

    public function getValueFromDataType(&$row, $dataType)
    {
        $value = 0;
        $count = 1;
        if ('diff' == $dataType) {
            return array_shift($row);
        } else {
            foreach ($row as $val) {
                if ($val > 0) {
                    $count++;
                    $value += $val;
                }
            }
            return $value / $count;
        }
        return 0;
    }

    public function getFormatFromType($type)
    {
        switch ($type) {
            case 'hr':
                return [
                    'index' => 'Y-m-dTH:i',
                    'from' => 'M d h:iA',
                    'to' => '-M d h:iA'
                ];
            case 'dy':
                return [
                    'index' => 'Y-m-d',
                    'from' => 'M d,',
                    'to' => ' Y'
                ];
            case 'wk':
                return [
                    'index' => 'Y-m-d',
                    'from' => 'M d',
                    'to' => '-M d, Y'
                ];
            case 'mo':
                return [
                    'index' => 'Y-m',
                    'from' => 'M d',
                    'to' => '-M d, Y'
                ];
        }
    }

    public function getQueryByGranularity($granularity, $post, $i)
    {
        $query = new Query();
        $query
            ->select($this->getColumnsByDataType($granularity, $post['data']))
            ->from($granularity)
            ->where($granularity . '.id = :id AND start_timestamp >= :min AND start_timestamp <= :max AND report = :report', [
                ':id' => $post['id'][$i],
                ':min' => strtotime($post['min_time'][$i].':00+08:00'),
                ':max' => strtotime($post['max_time'][$i].':59+08:00'),
                ':report' => $post['type']
            ])
            ->groupBy($this->getGroupByType($post['type']))
            ->orderBy('start_timestamp')
        ;
        if (self::GRANULARITY_GROUP === $granularity) {
            $query->join('INNER JOIN', 'group_meter', 'group_meter.group_id = groups.id')
                ->join('INNER JOIN', 'meter', 'meter.id = group_meter.meter_id')
            ;
        }
        $query->join('LEFT JOIN', 'meter_summary', 'meter_summary.meter_id = meter.id');
        return $query;
    }

    public function getColumnsByDataType($granularity, $dataType)
    {
        switch ($dataType) {
            case 'diff':
                return [$granularity . '.name', 'MIN(start_timestamp)', 'MAX(end_timestamp)', 'SUM(kWh_Tot_Diff)'];
            case 'avg':
                return [$granularity . '.name', 'MIN(start_timestamp)', 'MAX(end_timestamp)', 'AVG(RMS_Watts_Ln_1_Average)', 'AVG(RMS_Watts_Ln_2_Average)', 'AVG(RMS_Watts_Ln_3_Average)'];
            case 'volt':
                return [$granularity . '.name', 'MIN(start_timestamp)', 'MAX(end_timestamp)', 'AVG(RMS_Volts_Ln_1_Average)','AVG(RMS_Volts_Ln_2_Average)','AVG(RMS_Volts_Ln_3_Average)'];
            case 'amp':
                return [$granularity . '.name', 'MIN(start_timestamp)', 'MAX(end_timestamp)', 'AVG(Amps_Ln_1_Average)','AVG(Amps_Ln_2_Average)','AVG(Amps_Ln_3_Average)'];
        }
    }

    public function getGroupByType($type)
    {
        switch ($type) {
            case 'hr':
                return ['year','month','day','hour'];
            case 'dy':
            case 'wk':
                return ['year','month','day'];
            case 'mo':
                return ['year','month'];
        }
    }
}