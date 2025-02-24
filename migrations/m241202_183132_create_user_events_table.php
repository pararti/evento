<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_events}}`.
 */
class m241202_183132_create_user_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_events}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'event_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-user_id',
            'user_events',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_id',
            'user_events',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-event_id',
            'user_events',
            'event_id'
        );

        $this->addForeignKey(
            'fk-event_id',
            'user_events',
            'event_id',
            'events',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_events}}');
    }
}
