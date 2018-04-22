<?php
/**
 * встроенный компонент приложения для создания URL-адресов.
 * Через этот компонент создаются все URL в приложении.
 * Для добавления префикса буквенного идентификатора языка в URL достаточно переопределить
 * метод createUrl класса UrlManager и в конфигурации приложения указать используемый менеджер URL.
 */

namespace frontend\components;

use yii\web\UrlManager;
use common\models\Lang;


class LangUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if( isset($params['lang_id']) ){

            //Если указан идентификатор языка, то делаем попытку найти язык в БД,
            //иначе работаем с языком по умолчанию

            $lang = Lang::findOne($params['lang_id']);

            if( $lang === null ){

                $lang = Lang::getDefaultLang();
            }

            unset($params['lang_id']);


        } else {

            //Если не указан параметр языка, то работаем с текущим языком

            $lang = Lang::getCurrent();
        }

        \Yii::$app->params['curLang'] = $lang;

//        \Yii::$app->language = $lang->url;

        //Получаем сформированный URL(без префикса идентификатора языка)

        $url = parent::createUrl($params);

        //Добавляем к URL префикс - буквенный идентификатор языка

        if( $url == '/' ){

            return '/'.$lang->url;

        }else{

            return '/'.$lang->url.$url;
        }
    }
}