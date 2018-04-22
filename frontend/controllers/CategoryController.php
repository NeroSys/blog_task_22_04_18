<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 4/22/18
 * Time: 5:38 PM
 */

namespace frontend\controllers;

use common\models\CatalogList;
use common\models\Articles;
use yii\data\Pagination;

class CategoryController extends AppController
{

    public function actionView($slug){

        $category = CatalogList::find()->where(['slug' => $slug])->one();

        if (!empty($category)){

            $query = Articles::find()->where(['category_id' => $category->id])->orderBy(['id' => SORT_DESC]);
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3,
                'forcePageParam' => false, 'pageSizeParam' => false]);

            $articles = $query->offset($pages->offset)->limit($pages->limit)->all();

        }
        return $this->render('view', compact('category', 'articles', 'pages'));

    }

}