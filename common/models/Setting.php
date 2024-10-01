<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property string $parameter Название параметра
 * @property string $value Значение
 * @property string $description Описание параметра
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parameter', 'value', 'description'], 'required'],
            [['parameter'], 'string', 'max' => 100],
            [['value', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parameter' => 'Parameter',
            'value' => 'Value',
            'description' => 'Description',
        ];
    }
}
