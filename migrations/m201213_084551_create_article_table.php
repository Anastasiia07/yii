<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m201213_084551_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()

    {

        $this->createTable('{{%article}}', [

            'id' => $this->primaryKey(),

            'title' => $this->string(),

            'description' => $this->text(),

            'date' => $this->date(),

            'image' => $this->string(),

            'tag' => $this->string(),

            'viewed' => $this->integer(),

            'topic_id' => $this->integer(),

            'user_id' => $this->integer(),

        ]);


    }
    /**
     * {@inheritdoc}
     */

    public function safeDown()
    {

        $this->dropTable('{{%article}}');

    }

}