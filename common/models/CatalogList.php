<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%catalog_list}}".
 *
 * @property int $id
 * @property string $name
 * @property string $img
 * @property int $visible
 * @property int $sort
 * @property string $slug
 *
 * @property CatalogLang[] $catalogLangs
 */
class CatalogList extends \yii\db\ActiveRecord
{
    public $title;
    public $titleNew;
    public $description;
    public $descriptionNew;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_list}}';
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'name',
                'out_attribute' => 'slug',
                'translit' => true
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visible', 'sort'], 'integer'],
            [[
                'title',
                'titleNew',
                'description',
                'descriptionNew',
                'hostImage'
            ], 'safe'],
            [['name', 'img', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'name' => Yii::t('admin', 'Name'),
            'img' => Yii::t('admin', 'Img'),
            'visible' => Yii::t('admin', 'Visible'),
            'sort' => Yii::t('admin', 'Sort'),
            'slug' => Yii::t('admin', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogLangs()
    {
        return $this->hasMany(CatalogLang::className(), ['item_id' => 'id']);
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
        $data_lang = $this->getCatalogLangs()->where(['lang'=>$language])->one();
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
                $lang = CatalogLang::find()->where(['lang_id' => $lang])->andWhere(['id'=>$key_id])->one();

                if(!empty($lang)){
                    $lang->title = array_pop($item);
                    $lang->description = $this->description[$lang->lang_id][$key_id];
                    $lang->save();
                }
            }
        };

        if(!empty($this->titleNew)) {

            foreach ($this->titleNew as $lang_id => $data) {


                $lang = Lang::find()->where(['id' => $lang_id])->one()->local;


                $itemTitle = (is_array($data) ? array_pop($data) : '');
                $itemDesc = (is_array($this->descriptionNew) ? array_pop($this->descriptionNew[$lang_id]) : '');

                $item = new CatalogLang();

                $item->item_id = $this->id;
                $item->lang_id = $lang_id;
                $item->lang = $lang;
                $item->title = (!empty($itemTitle) ? $itemTitle : '');
                $item->description = (!empty($itemDesc) ? $itemDesc: '');
                $item->save();
            }
        }

    }

    public static function getValue($id, $langId){

        return CatalogLang::find()->where(['item_id' => $id])->andWhere(['lang_id' => $langId])->one();
    }

    // image block--


    public function getHostImage(){
        return Url::toRoute('/../upload/catalog/'.$this->img, true);
    }

    public function setHostImage($file){
        $this->img = $file;
    }

    public function beforeSave($insert)
    {
        if(!empty($this->img)){
            $tmp = explode('/', $this->img);
            $this->img = array_pop($tmp);
        }
        return parent::beforeSave($insert);
    }

    public function getImg(){


        return ($this->img) ?  '/frontend/web/upload/catalog/'. $this->img : '/frontend/web/no-image.jpg';
    }

// end of image block --

}
