<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 *
 * @property GroupMeter[] $groupMeters
 * @property Meter[] $meters
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
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
        return $this->hasMany(GroupMeter::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeters()
    {
        return $this->hasMany(Meter::className(), ['id' => 'meter_id'])->viaTable('group_meter', ['group_id' => 'id']);
    }
}
