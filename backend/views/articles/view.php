<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model common\models\Articles */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('admin', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'small_img',
                'format'=> 'html',
                'value' => function($data){
                    return Html::img($data->getPreviewImg(), ['width' => 180]);

                }
            ],
            [
                'attribute' => 'main_img',
                'format'=> 'html',
                'value' => function($data){
                    return Html::img($data->getMainImg(), ['width' => 180]);

                }
            ],
            'id',
            'name',
            'category_id',
            'slug',
            'sort',
            'status',
            'created_at',
        ],
    ]) ?>

    <p>Translations content</p>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getArticlesLangs()]),
        'layout' => "{items}\n{pager}",
        'columns' => [

            'lang',
            'title:ntext',
            'author:ntext',
//            'description:html'

        ],
    ]); ?>
</div>
