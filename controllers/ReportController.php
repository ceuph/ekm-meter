<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 26/06/2019
 * Time: 9:29 AM
 */

namespace app\controllers;


use app\models\GroupsSearch;
use app\models\MeterSearch;
use app\models\Variables;
use yii\db\Query;
use yii\web\Controller;

class ReportController extends Controller
{
    const GRANULARITY_METER = 'meter';
    const GRANULARITY_GROUP = 'groups';
    public $queryCount = 0;
    private $emissionFactor = null;

    public static function getHtmlClass($data, $value, $min, $max)
    {
        $class = ['meter-data'];
        $values = [];
        foreach ($data as $tmp) {
            $values[] = $tmp['value'];
        }
        if (min($values) == $value) {
            $class[] = 'meter-data-row-min';
        }

        if (max($values) == $value) {
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
        return $this->renderReport(self::GRANULARITY_METER);
    }

    public function actionGroups()
    {
        return $this->renderReport(self::GRANULARITY_GROUP);
    }

    public function renderReport($granularity)
    {
        $dropDownItems = [];
        switch ($granularity) {
            case self::GRANULARITY_METER:
                $dropDownItems = MeterSearch::find()->orderBy('name')->all();
                break;
            case self::GRANULARITY_GROUP:
                $dropDownItems = GroupsSearch::find()->orderBy('name')->all();
                break;
        }
        $data = [];
        if (\Yii::$app->request->get('id')) {
            $get = \Yii::$app->request->get();
            foreach ($get['id'] as $i => $value) {
                $result = $this->getQueryByGranularity($granularity, $get, $i)->all();
                $this->processResultsToData($get['type'], $get['data'], $get['color'], $result, $data, 'yes' == $get['shift']);
            }
            $this->postProcessData($data, 'yes' == $get['shift']);
        }
        return $this->render('report',[
            'dropDownItems' => $dropDownItems,
            'granularity' => $granularity,
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
                    $data['data'][$name][$index]['label'] = $label;
                    $data['data'][$name][$index]['value'] = 0;
                }
                $data['rows']['labels'][$name] = $name;
                if (isset($data['data'][$name][$index])) {
                    $data['rows']['data'][$index][$name]['label'] = $data['data'][$name][$index]['label'];
                    $data['rows']['data'][$index][$name]['value'] = $data['data'][$name][$index]['value'];
                } else {
                    $data['rows']['data'][$index][$name]['label'] = $label;
                    $data['rows']['data'][$index][$name]['value'] = 0;
                }
                if (isset($data['data'][$name][$index])) {
                    if (null === $data['min']) {
                        $data['min'] = $data['data'][$name][$index]['value'];
                    }
                    $data['min'] = $data['min'] > $data['data'][$name][$index]['value'] ? $data['data'][$name][$index]['value'] : $data['min'];
                    $data['max'] = $data['max'] < $data['data'][$name][$index]['value'] ? $data['data'][$name][$index]['value'] : $data['max'];
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
            $data['data'][$name][$index]['label'] = date($format['from'], $startTime) . date($format['to'], $endTime);
            $data['data'][$name][$index]['value'] = $this->getValueFromDataType($row, $dataType);
        }
        $this->queryCount++;
    }

    public function getValueFromDataType(&$row, $dataType)
    {
        $value = 0;
        $count = 1;
        if ('diff' == $dataType || 'co2' == $dataType) {
            $kwh = array_shift($row);
            return 'diff' == $dataType ? $kwh : $kwh * $this->getEmissionFactor();
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

    public function getQueryByGranularity($granularity, $params, $i)
    {
        $query = new Query();
        $query
            ->select($this->getColumnsByDataType($granularity, $params['data']))
            ->from($granularity)
            ->where($granularity . '.id = :id AND start_timestamp >= :min AND start_timestamp <= :max AND report = :report', [
                ':id' => $params['id'][$i],
                ':min' => strtotime($params['min_time'][$i].':00+08:00'),
                ':max' => strtotime($params['max_time'][$i].':59+08:00'),
                ':report' => $params['type']
            ])
            ->groupBy($this->getGroupByType($params['type']))
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
            case 'co2':
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

    public function getEmissionFactor()
    {
        if (null === $this->emissionFactor) {
            $this->emissionFactor = Variables::findOne(['name' => 'EmissionFactor']);
        }
        return (float)$this->emissionFactor->value;
    }
}