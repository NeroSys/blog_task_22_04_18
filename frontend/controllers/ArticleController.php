<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 4/22/18
 * Time: 6:45 PM
 */

namespace frontend\controllers;

use common\models\Articles;
use common\models\CatalogList;

class ArticleController extends AppController
{

    public function actionView($slug){

        $article = Articles::find()->where(['slug' => $slug])->one();

        if (!empty($article)){
            $lang = $article->getDataItems();

            $category = CatalogList::findOne($article->category_id);
            $lang_category = $category->getDataitems();
        }

        return $this->render('view', compact('article', 'lang', 'category', 'lang_category'));
    }

}