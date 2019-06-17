<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meter".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property GroupMeter[] $groupMeters
 * @property Groups[] $groups
 * @property MeterData[] $meterDatas
 * @property MeterSummary[] $meterSummaries
 */
class Meter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupMeters()
    {
        return $this->hasMany(GroupMeter::className(), ['meter_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['id' => 'group_id'])->viaTable('group_meter', ['meter_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeterDatas()
    {
        return $this->hasMany(MeterData::className(), ['meter_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeterSummaries()
    {
        return $this->hasMany(MeterSummary::className(), ['meter_id' => 'id']);
    }
}
