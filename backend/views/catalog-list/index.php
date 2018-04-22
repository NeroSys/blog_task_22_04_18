<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CatalogListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Catalog Lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <div class="col-lg-2">
        <p>
            <?= Html::a(Yii::t('admin', 'Create Category'), ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-lg-10">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'img',
                    'format'=> 'html',
                    'value' => function($data){
                        return Html::img($data->getImg(), ['width' => 180]);

                    }
                ],
                'id',
                'name',
                'visible:boolean',
                'sort',
                'slug',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

    <?php Pjax::end(); ?>
</div>
