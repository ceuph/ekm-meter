<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "variables".
 *
 * @property string $name
 * @property string $description
 * @property string $value
 */
class Variables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variables';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['description', 'value'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'description' => 'Description',
            'value' => 'Value',
        ];
    }
}
