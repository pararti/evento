<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EventCreateForm extends Model
{
    public $name;
    public $description;
    public $type;
    public $startDate;
    public $endDate;
    public $image;
    public $address;

    public function rules()
    {
        return [
            [['name', 'description', 'type', 'startDate', 'endDate'], 'required', 'message' => 'Пожалуйста, заполните поле'],
            ['name', 'string', 'length' => [4, 255], 'message' => 'Название должно быть больше не менее 4 и не более 255'],
            [['startDate', 'endDate'], 'datetime'],
            ['image', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],
            ['address', 'required', 'when' => function ($model) {
                return $model->type === EventTypes::TYPE_OFFLINE;
            }, 'whenClient' => "function (attribute, value) {
                return $('#event-type').val() == " . EventTypes::TYPE_OFFLINE . ';}'],
        ];
    }

    public function saveImage()
    {
        if ($this->image) {
            $path = Yii::getAlias('@web') . 'upload/events/' . uniqid() . '.' . $this->image->extension;
            if ($this->image->saveAs($path)) {
                return $path;
            }
        }
        return null;
    }

    public function create(): bool
    {
        $imagePath = $this->saveImage();

        $event = new Events();
        $event->name = $this->name;
        $event->description = $this->description;
        $event->start_date = $this->startDate;
        $event->end_date = $this->endDate;
        $event->image = $imagePath;
        $event->type = $this->type;
        $event->address = $this->type === EventTypes::TYPE_OFFLINE ? $this->address : null;
        $event->owner = Yii::$app->user->id ?? 0;

        return $event->save();
    }

    public function update(int $id): bool
    {
        $event = Events::findOne($id);

        $imagePath = $this->saveImage();

        $event->name = $this->name;
        $event->description = $this->description;
        $event->start_date = $this->startDate;
        $event->end_date = $this->endDate;
        $event->image = $imagePath;
        $event->type = $this->type;
        $event->address = $this->type === EventTypes::TYPE_OFFLINE ? $this->address : null;

    }
}