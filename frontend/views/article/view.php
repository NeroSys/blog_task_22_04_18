<?php
use yii\helpers\Html;

if (!empty($lang['title'])){
    $this->title = $lang['title'];
}else{
    $this->title = $article->name;
}


$this->params['breadcrumbs'][] = ['label' => Yii::t('article', 'Home'), 'url' => ['site/index']];
$this->params['breadcrumbs'][] = ['label' =>  $lang_category['title'], 'url' => ['category/view', 'slug' => $category->slug ]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-lg-6">
        <h3><?= $lang['author']?></h3>
        <p><?= $lang['text'] ?></p>
    </div>
    <div class="col-lg-6">
        <img src="<?= $article->getMainImg() ?>">
    </div>




</div>