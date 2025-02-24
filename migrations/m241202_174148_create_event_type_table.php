<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_type}}`.
 */
class m241202_174148_create_event_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'value' => $this->integer()->notNull(),
        ]);

        $this->batchInsert('event_types', ['name', 'value'], [['offline', 1], ['online', 2]]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_types}}');
    }
}
