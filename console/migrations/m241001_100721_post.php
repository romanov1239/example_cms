<?php

use yii\db\Migration;

/**
 * Class m241001_100721_post
 */
class m241001_100721_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'post_category_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'image' => $this->string()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-post-category',
            'post',
            'post_category_id',
            'post_category',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-post-category', 'post');
        $this->dropTable('post');
    }
}

