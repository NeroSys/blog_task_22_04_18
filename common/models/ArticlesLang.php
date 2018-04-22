<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%articles_lang}}".
 *
 * @property int $id
 * @property int $item_id
 * @property int $lang_id
 * @property string $lang
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $author
 *
 * @property Articles $item
 */
class ArticlesLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%articles_lang}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'lang_id'], 'integer'],
            [['description', 'text'], 'string'],
            [['lang'], 'string', 'max' => 50],
            [['title', 'author'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Articles::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'item_id' => Yii::t('admin', 'Item ID'),
            'lang_id' => Yii::t('admin', 'Lang ID'),
            'lang' => Yii::t('admin', 'Lang'),
            'title' => Yii::t('admin', 'Title'),
            'description' => Yii::t('admin', 'Description'),
            'text' => Yii::t('admin', 'Text'),
            'author' => Yii::t('admin', 'Author'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Articles::className(), ['id' => 'item_id']);
    }
}
