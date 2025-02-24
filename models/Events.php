<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $type
 * @property int $owner
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $address
 * @property string|null $image
 * @property string|null $created_at
 * @property int|null $is_deleted
 * @property int|null $is_canceled
 *
 * @property Users $owner0
 * @property UserEvents[] $userEvents
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'owner', 'start_date', 'end_date'], 'required'],
            [['description'], 'string'],
            [['type', 'owner', 'is_deleted', 'is_canceled'], 'integer'],
            [['name', 'address', 'image'], 'string', 'max' => 255],
            [['owner'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['owner' => 'id']],
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
            'type' => 'Type',
            'owner' => 'Owner',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'address' => 'Address',
            'image' => 'Image',
            'created_at' => 'Created At',
            'is_deleted' => 'Is Deleted',
            'is_canceled' => 'Is Canceled',
        ];
    }

    /**
     * Gets query for [[Owner0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::class, ['id' => 'owner']);
    }

    public function getType()
    {
        return $this->hasOne(EventTypes::class, ['value' => 'type']);
    }

    /**
     * Gets query for [[UserEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserEvents()
    {
        return $this->hasMany(UserEvents::class, ['event_id' => 'id']);
    }

    public function isOwner(): bool
    {
        return $this->owner === (int)Yii::$app->user->id;
    }
}
