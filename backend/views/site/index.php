<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Admin template';
?>
<div class="site-index">

    <?php Pjax::begin(); ?>

    <div class="col-lg-2">
        <p>
            <?= Html::a(Yii::t('admin', 'Create Article'), ['articles/create'], ['class' => 'btn btn-warning']) ?>
        </p>
        <p>
            <?= Html::a(Yii::t('admin', 'Create Category'), ['catalog-list/create'], ['class' => 'btn btn-primary']) ?>
        </p>

        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-lg-10">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'small_img',
                    'format'=> 'html',
                    'value' => function($data){
                        return Html::img($data->getPreviewImg(), ['width' => 180]);

                    }
                ],
                'id',
                'name',
                [
                    'attribute' => 'category_id',
                    'value' => 'category.name'
                ],
                //'sort',
                'status',
                'created_at:date',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {link}',

                    'controller' => 'articles',

                ],
            ],
        ]); ?>
    </div>

   <?php Pjax::end(); ?>

</div>
