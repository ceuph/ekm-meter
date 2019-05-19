<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_meter".
 *
 * @property int $meter_id
 * @property string $group_id
 *
 * @property Groups $group
 * @property Meter $meter
 */
class GroupMeter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_meter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meter_id', 'group_id'], 'required'],
            [['meter_id', 'group_id'], 'integer'],
            [['meter_id', 'group_id'], 'unique', 'targetAttribute' => ['meter_id', 'group_id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['meter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meter::className(), 'targetAttribute' => ['meter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'meter_id' => 'Meter ID',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeter()
    {
        return $this->hasOne(Meter::className(), ['id' => 'meter_id']);
    }
}
