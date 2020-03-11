<?php
namespace app\components;

use yii\base\Component;

class EkmSummaryApi extends Component
{
    const URL = 'http://summary.ekmmetering.com/summary';

    const PARAM_KEY = 'key';
    const PARAM_METERS = 'meters';
    const PARAM_REPORT = 'report';
    const PARAM_FORMAT = 'format';
    const PARAM_LIMIT = 'limit';
    const PARAM_OFFSET = 'offset';
    const PARAM_TIMEZONE = 'timezone';
    const PARAM_START_DATE = 'start_date';
    const PARAM_END_DATE = 'end_date';
    const PARAM_NORMALIZE = 'normalize';

    const REPORT_HOUR = 'hr';
    const REPORT_DAY = 'dy';
    const REPORT_WEEK = 'wk';
    const REPORT_MONTH = 'mo';

    const FORMAT_HTML = 'html';
    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';
    const FORMAT_CSV = 'csv';
    const DATE_FORMAT = 'YmdHi';

    const NORMALIZE_TRUE = 1;
    const NORMALIZE_FALSE = 0;

    private $_key = null;
    private $_meters = null;
    private $_report = 'dy';
    private $_format = 'json';
    private $_limit = 1000;
    private $_offset = 0;
    private $_timezone = 'Asia~Hong_Kong';
    private $_startDate = null;
    private $_endDate = null;
    private $_normalize = EkmSummaryApi::NORMALIZE_TRUE;

    public function getKey()
    {
        if (null === $this->_key) {
            $this->_key = getenv('EKM_API_KEY');
        }
        return $this->_key;
    }

    public function setKey($key)
    {
        $this->_key = $key;
        return $this;
    }

    public function getMeters()
    {
        if (null === $this->_meters) {
            throw new \Exception('Please enter meter id');
        }
        return $this->_meters;
    }

    public function setMeters($meters)
    {
        if (is_array($meters)) {
            $meters = implode('~', $meters);
        }
        $this->_meters = $meters;
        return $this;
    }

    public function getReport()
    {
        return $this->_report;
    }

    public function setReport($report)
    {
        $this->_report = $report;
        return $this;
    }

    public function getFormat()
    {
        return $this->_format;
    }

    public function setFormat($format)
    {
        $this->_format = $format;
        return $this;
    }

    public function getLimit()
    {
        return $this->_limit;
    }

    public function setLimit($limit)
    {
        $this->_limit = $limit;
        return $this;
    }

    public function getOffset()
    {
        return $this->_offset;
    }

    public function setOffset($offset)
    {
        $this->_offset = $offset;
        return $this;
    }

    public function getTimezone()
    {
        return $this->_timezone;
    }

    public function setTimezone($timezone)
    {
        $this->_timezone = $timezone;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->_startDate;
    }

    public function setStartDate(\DateTime $startDate)
    {
        $startDate->setTimezone(new \DateTimeZone(preg_replace('/~/', '/', $this->getTimezone())));
        $this->_startDate = $startDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->_endDate;
    }

    public function setEndDate(\DateTime $endDate)
    {
        $endDate->setTimezone(new \DateTimeZone(preg_replace('/~/', '/', $this->getTimezone())));
        $this->_endDate = $endDate;
        return $this;
    }

    public function getNormalize()
    {
        return $this->_normalize;
    }

    public function setNormalize($normalize)
    {
        $this->_normalize = $normalize;
        return $this;
    }

    public function getQuery()
    {
        $params = [
            EkmSummaryApi::PARAM_KEY => $this->getKey(),
            EkmSummaryApi::PARAM_METERS => $this->getMeters(),
            EkmSummaryApi::PARAM_REPORT => $this->getReport(),
            EkmSummaryApi::PARAM_FORMAT => $this->getFormat(),
            EkmSummaryApi::PARAM_LIMIT => $this->getLimit(),
            EkmSummaryApi::PARAM_OFFSET => $this->getOffset(),
            EkmSummaryApi::PARAM_TIMEZONE => $this->getTimezone(),
            EkmSummaryApi::PARAM_NORMALIZE => $this->getNormalize()
        ];

        if (null !== $this->getStartDate()) {
            $params[EkmSummaryApi::PARAM_START_DATE] = $this->getStartDate()->format(EkmSummaryApi::DATE_FORMAT);
        }

        if (null !== $this->getEndDate()) {
            $params[EkmSummaryApi::PARAM_END_DATE] = $this->getEndDate()->format(EkmSummaryApi::DATE_FORMAT);
        }

        return http_build_query($params);
    }

    public function getUrl()
    {
        return EkmSummaryApi::URL . '?' . $this->getQuery();
    }

    public function getData()
    {
        $content = file_get_contents($this->getUrl());
        if (false === $content) {
            throw new \Exception(curl_error($ch), curl_errno($ch));
        }

        switch ($this->getFormat())
        {
            case EkmSummaryApi::FORMAT_HTML:
                return simplexml_load_string($content);
            case EkmSummaryApi::FORMAT_JSON:
                return json_decode($content);
            case EkmSummaryApi::FORMAT_XML:
                return simplexml_load_string($content);
            case EkmSummaryApi::FORMAT_CSV:
                return str_getcsv($content);
        }
        return $content;
    }
}
