<?php

use yii\db\Migration;

/**
 * Handles adding news_type_id to table `news`.
 */
class m180908_033224_add_news_type_id_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'news_type_id', $this->integer());
        
        $this->createIndex('idx-news_type-news_type_id', 'news', 'news_type_id');
        
        $this->addForeignKey('fk-news_type-news_type_id', 'news', 'news_type_id', 'news_type', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'news_type_id');
    }
}
