<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_types".
 *
 * @property int $id
 * @property string $name
 * @property int $value
 */
class EventTypes extends \yii\db\ActiveRecord
{
    public const TYPE_OFFLINE = 1;
    public const TYPE_ONLINE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['value'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'value' => 'Value',
        ];
    }
}
