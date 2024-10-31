<?php

use yii\db\Migration;

/**
 * Class m241029_180636_order
 */
class m241029_180636_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'amount' => $this->string()->notNull(),
            'payment_id' => $this->bigInteger()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
