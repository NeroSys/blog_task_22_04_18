<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 4/22/18
 * Time: 5:47 PM
 */
use yii\helpers\Url;
use yii\widgets\LinkPager;

$lang_cat = $category->getDataItems();

if (!empty($lang_cat['title'])){
    $this->title = $lang_cat['title'];
}else{
    $category->name;
}


?>
<div class="site-index">
    <div class="jumbotron">
        <h1><?= Yii::t('category', 'Category :')?><?=$lang_cat['title']?></h1>
    </div>

    <div class="body-content">

        <div class="row">
            <?php if (!empty($articles)) { ?>
                <?php $i=0; foreach ($articles as $article) { $i++ ?>
                    <?php $lang_article = $article->getDataItems() ?>

                    <div class="col-lg-4">

                        <a href="<?= Url::to(['article/view', 'slug' => $article->slug])?>">
                            <img src="<?= $article->getPreviewImg()?>" alt="<?= $lang_article['title'] ?>">
                        </a>

                        <a href="<?= Url::to(['article/view', 'slug' => $article->slug])?>">
                            <h2><?= $lang_article['title'] ?></h2>
                        </a>

                        <a href="<?= Url::to(['article/view', 'slug' => $article->slug])?>">
                            <p><?= $lang_article['description'] ?></p>
                        </a>
                    </div>
                    <?php if ($i % 3 == 0):?>
                        <div class="clearfix"></div>
                    <?php endif; ?>
                    <?php }?>
                <?php
                echo LinkPager::widget(['pagination' => $pages]);
                ?>
            <?}else{?>

                    <h4 align="center">Here no one items</h4><br />
                    <h4 align="center">Waiting for some new.</h4>

            <?}?>
        </div>

    </div>
</div>
