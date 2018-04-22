<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Test site';

?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Test site</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <?php if (!empty($categories)) { ?>
                <?php $i=0; foreach ($categories as $category) { $i++ ?>
                    <?php $lang_cat = $category->getDataItems() ?>

                    <div class="col-lg-4">

                        <a href="<?= Url::to(['category/view', 'slug' => $category->slug])?>">
                            <img src="<?= $category->getImg()?>" alt="<?= $lang_cat['title'] ?>">
                        </a>

                        <a href="<?= Url::to(['category/view', 'slug' => $category->slug])?>">
                            <h2><?= $lang_cat['title'] ?></h2>
                        </a>

                        <a href="<?= Url::to(['category/view', 'slug' => $category->slug])?>">
                            <p><?= $lang_cat['description'] ?></p>
                        </a>
                    </div>
                    <?php if ($i % 3 == 0):?>
                        <div class="clearfix"></div>
                    <?php endif; ?>
                <?}?>
            <?}?>
        </div>

    </div>
</div>
