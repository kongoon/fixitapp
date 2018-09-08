<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `news`.
 */
class m180908_025338_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'content' => Schema::TYPE_TEXT,
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('news');
    }
}
