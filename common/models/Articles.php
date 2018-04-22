<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%articles}}".
 *
 * @property int $id
 * @property string $name
 * @property string $main_img
 * @property string $small_img
 * @property int $category_id
 * @property string $slug
 * @property int $sort
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CatalogList $category
 * @property ArticlesLang[] $articlesLangs
 */
class Articles extends \yii\db\ActiveRecord
{
    public $title;
    public $titleNew;
    public $description;
    public $descriptionNew;
    public $text;
    public $textNew;
    public $author;
    public $authorNew;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%articles}}';
    }

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'slugStr' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'name', // Свойтво в модели на базе которого будет создавться slug
                'out_attribute' => 'slug', // Свойтво в модели выступающее как slug
                'translit' => true
            ]
        ];
    }


    public function rules()
    {
        return [
            [['category_id', 'sort'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [[
                'title',
                'titleNew',
                'description',
                'descriptionNew',
                'text',
                'textNew',
                'author',
                'authorNew',
                'hostImage', 'mainImage'
            ], 'safe'],
            [['name', 'main_img', 'small_img', 'slug', 'status'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogList::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'name' => Yii::t('admin', 'Name'),
            'img' => Yii::t('admin', 'Img'),
            'category_id' => Yii::t('admin', 'Category ID'),
            'slug' => Yii::t('admin', 'Slug'),
            'sort' => Yii::t('admin', 'Sort'),
            'status' => Yii::t('admin', 'Status'),
            'created_at' => Yii::t('admin', 'Date'),
            'updated_at' => Yii::t('admin', 'Date update'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CatalogList::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticlesLangs()
    {
        return $this->hasMany(ArticlesLang::className(), ['item_id' => 'id']);
    }

    /*
* Возвращает массив объектов модели
*/
    public function getItems(){
        return $this->find()->all();
    }
    /*
     * Возвращает данные для указанного языка
     */
    public function getDataItems(){
        $language = Yii::$app->language;
        $data_lang = $this->getArticlesLangs()->where(['lang'=>$language])->one();
        return $data_lang;
    }

    /*
     * Возвращает объект поста по его url
     */
    public function getLang($url){
        return $this->find()->where(['url' => $url])->one();
    }

    /*
    * Сохранение значений переводов в сопутствующую таблицу
    */

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if(!empty($this->title)){
            foreach ($this->title as $lang => $item){

                $key_id = key($item);
                $lang = ArticlesLang::find()->where(['lang_id' => $lang])->andWhere(['id'=>$key_id])->one();

                if(!empty($lang)){
                    $lang->title = array_pop($item);
                    $lang->description = $this->description[$lang->lang_id][$key_id];
                    $lang->text = $this->text[$lang->lang_id][$key_id];
                    $lang->author = $this->author[$lang->lang_id][$key_id];

                    $lang->save();
                }
            }
        };

        if(!empty($this->titleNew)) {

            foreach ($this->titleNew as $lang_id => $data) {


                $lang = Lang::find()->where(['id' => $lang_id])->one()->local;


                $itemName = (is_array($data) ? array_pop($data) : '');
                $itemDesc = (is_array($this->descriptionNew) ? array_pop($this->descriptionNew[$lang_id]) : '');
                $itemText = (is_array($this->textNew) ? array_pop($this->textNew[$lang_id]) : '');
                $itemAuthor = (is_array($this->authorNew) ? array_pop($this->authorNew[$lang_id]) : '');
                $item = new ArticlesLang();

                $item->item_id = $this->id;
                $item->lang_id = $lang_id;
                $item->lang = $lang;
                $item->title = (!empty($itemName) ? $itemName : '');
                $item->description = (!empty($itemDesc) ? $itemDesc: '');
                $item->text = (!empty($itemText) ? $itemText: '');
                $item->author = (!empty($itemAuthor) ? $itemAuthor: '');
                $item->save();
            }
        }

    }

    public static function getValue($id, $langId){

        return ArticlesLang::find()->where(['item_id' => $id])->andWhere(['lang_id' => $langId])->one();
    }

    // image block--
    public function getMainImage(){
        return Url::toRoute('/../upload/articles/'.$this->main_img, true);
    }

    public function getHostImage(){
        return Url::toRoute('/../upload/articles/'.$this->small_img, true);
    }

    public function setHostImage($file){
        $this->small_img = $file;
    }

    public function setMainImage($file){
        $this->main_img = $file;
    }

    public function beforeSave($insert)
    {
        if(!empty($this->small_img)){
            $tmp = explode('/', $this->small_img);
            $this->small_img = array_pop($tmp);
        }

        if(!empty($this->main_img)){
            $tmp = explode('/', $this->main_img);
            $this->main_img = array_pop($tmp);
        }

        return parent::beforeSave($insert);
    }

    public function getPreviewImg(){


        return ($this->small_img) ?  '/frontend/web/upload/articles/'. $this->small_img : '/frontend/web/no-image.jpg';
    }

    public function getMainImg(){


        return ($this->main_img) ?  '/frontend/web/upload/articles/'. $this->main_img : '/frontend/web/no-image.jpg';
    }

// end of image block --
}
