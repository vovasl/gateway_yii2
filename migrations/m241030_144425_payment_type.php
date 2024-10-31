<?php

use yii\db\Migration;

/**
 * Class m241030_144425_payment_type
 */
class m241030_144425_payment_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payment_type}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'type' => $this->integer()->notNull(),
            'environment' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment_type}}');
    }
}
