<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $text
 * @property int $post_category_id
 * @property int $status
 * @property string|null $image
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PostCategory $postCategory
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'text', 'post_category_id', 'status', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'post_category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['title', 'image'], 'string', 'max' => 255],
            [['post_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::class, 'targetAttribute' => ['post_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Название',
            'text' => 'Содержание поста',
            'post_category_id' => 'Категория поста',
            'status' => 'Status',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[PostCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategory()
    {
        return $this->hasOne(PostCategory::class, ['id' => 'post_category_id']);
    }
}
