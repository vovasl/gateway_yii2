<?php

use yii\db\Migration;

/**
 * Class m241029_162517_logs
 */
class m241029_162517_logs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%logs}}', [
            'id' => $this->bigPrimaryKey(),
            'level' => $this->integer(),
            'category' => $this->string(),
            'message' => $this->text(),
            'created_at' => $this->dateTime()
        ]);

        $this->createIndex('idx_logs_level', '{{%logs}}', 'level');
        $this->createIndex('idx_logs_category', '{{%logs}}', 'category');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%logs}}');
    }
}
