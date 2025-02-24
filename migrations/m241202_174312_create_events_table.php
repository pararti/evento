<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 */
class m241202_174312_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('events', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'type' => $this->integer()->notNull(),
            'owner' => $this->integer()->notNull(),
            'start_date' => $this->dateTime()->notNull(),
            'end_date' => $this->dateTime(),
            'address' => $this->string(),
            'image' => $this->string(),
            'created_at' => $this->dateTime()->defaultExpression('NOW()'),
            'is_deleted' => $this->boolean()->defaultValue(false),
            'is_canceled' => $this->boolean()->defaultValue(false),
        ]);

        $this->createIndex(
            'idx-owner_id',
            'events',
            'owner'
        );

        $this->addForeignKey(
            'fk-owner_id',
            'events',
            'owner',
            'users',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('events');
    }
}
