<?php

class EKMApi
{
    const URL = 'https://io.ekmpush.com/readMeter';

    const TYPE_V3 = 'v3';
    const TYPE_V4 = 'v4';

    const FORMAT_JSON = 'json';
    const FORMAT_HTML = 'html';
    const FORMAT_XML = 'xml';
    const FORMAT_CSV = 'csv';

    const FIELDS_KWH_TOTAL = 'kWh_Tot';
    const FIELDS_KWH_1 = 'kWh_Tariff_1';
    const FIELDS_KWH_2 = 'kWh_Tariff_2';
    const FIELDS_VOLTS_1 = 'RMS_Volts_Ln_1';
    const FIELDS_VOLTS_2 = 'RMS_Volts_Ln_2';
    const FIELDS_REV_KWH_TOTAL = 'Rev_kWh_Tot';
    const FIELDS_REV_KWH_1 = 'Rev_kWh_Tariff_1';
    const FIELDS_REV_KWH_2 = 'Rev_kWh_Tariff_1';
    const FIELDS_POWER_FACTOR_1 = 'Power_Factor_Ln_1';
    const FIELDS_POWER_FACTOR_2 = 'Power_Factor_Ln_2';
    const FIELDS_POWER_FACTOR_3 = 'Power_Factor_Ln_3';
    const FIELDS_WATTS_MAX_DEMAND = 'RMS_Watts_Max_Demand';
    const FIELDS_WATTS_TOTAL = 'RMS_Watts_Tot';
    const FIELDS_WATTS_1 = 'RMS_Watts_Ln_1';
    const FIELDS_WATTS_2 = 'RMS_Watts_Ln_2';
    const FIELDS_AMPS_1 = 'Amps_Ln_1';
    const FIELDS_AMPS_2 = 'Amps_Ln_2';
    const FIELDS_MAX_DEMAND_PERIOD = 'Max_Demand_Period';
    const FIELDS_CT_RATIO = 'CT_Ratio';

    private $_key;
    private $_type = EKMApi::TYPE_V3;
    private $_meterNumber;
    private $_format = EKMApi::FORMAT_JSON;
    private $_count = 1000;
    private $_timezone = 'Asia~Manila';
    private $_fields;
    private $_since; // > unix time
    private $_until; // <= unix time
}