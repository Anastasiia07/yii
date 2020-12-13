<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m201213_084751_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()

    {

        $this->createTable('{{%comment}}', [

            'id' => $this->primaryKey(),

            'text' => $this->string(),

            'user_id' => $this->integer(),

            'comment_id' => $this->integer(),

            'article_id' => $this->integer(),

            'date' => $this->date(),

            'delete' => $this->boolean(),

        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
