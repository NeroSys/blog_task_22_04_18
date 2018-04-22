<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%catalog_lang}}".
 *
 * @property int $id
 * @property int $item_id
 * @property int $lang_id
 * @property string $lang
 * @property string $title
 * @property string $description
 *
 * @property CatalogList $item
 */
class CatalogLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_lang}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'lang_id'], 'integer'],
            [['lang'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogList::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(CatalogList::className(), ['id' => 'item_id']);
    }
}
