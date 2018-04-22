<?php
/**
 * @var \yii\db\ActiveRecord $model
 * @var \common\components\cropper\Widget $widget
 *
 */

use yii\helpers\Html;

?>

<div class="cropper-widget">
    <?= Html::activeHiddenInput($model, $widget->attribute, ['class' => 'photo-field']); ?>
    <?= Html::hiddenInput('width', $widget->width, ['class' => 'width-input']); ?>
    <?= Html::hiddenInput('height', $widget->height, ['class' => 'height-input']); ?>
    <?= Html::img(
        $model->{$widget->attribute} != ''
            ? $model->{$widget->attribute}
            : $widget->noPhotoImage,
        [
            'style' => 'max-height: ' . $widget->thumbnailHeight . 'px; max-width: ' . $widget->thumbnailWidth . 'px',
            'class' => 'thumbnail',
            'data-no-photo' => $widget->noPhotoImage
        ]
    ); ?>

    <div class="cropper-buttons">
        <button type="button" class="btn btn-sm btn-danger delete-photo" aria-label="<?= Yii::t('cropper', 'Удалить');?>">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> <?= Yii::t('cropper', 'Удалить');?>
        </button>
        <button type="button" class="btn btn-sm btn-success crop-photo hidden" aria-label="<?= Yii::t('cropper', 'Обрезать');?>">
            <span class="glyphicon glyphicon-scissors" aria-hidden="true"></span> <?= Yii::t('cropper', 'Обрезать');?>
        </button>
        <button type="button" class="btn btn-sm btn-info upload-new-photo hidden" aria-label="<?= Yii::t('cropper', 'Загрузить другое');?>">
            <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <?= Yii::t('cropper', 'Загрузить другое');?>
        </button>
    </div>

    <div class="new-photo-area" style="height: <?= $widget->cropAreaHeight; ?>px; width: <?= $widget->cropAreaWidth; ?>px;">
        <div class="cropper-label">
            <span><?= $widget->label;?></span>
        </div>
    </div>
    <div class="progress hidden" style="width: <?= $widget->cropAreaWidth; ?>px;">
        <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" style="width: 0%">
            <span class="sr-only"></span>
        </div>
    </div>
</div>