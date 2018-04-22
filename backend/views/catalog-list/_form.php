<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CatalogList;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use common\components\cropper\Widget;

/* @var $this yii\web\View */
/* @var $model common\models\CatalogList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-list-form">

        <h1>Main content</h1>

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'visible')->checkbox() ?>

        <?= $form->field($model, 'sort')->textInput() ?>

        <?php if (!$model->isNewRecord){?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        <?}?>

        <h1>Translation of content</h1>
        <?php foreach ($langs as $lang): ?>
        <h3>-------<?= $lang->name ?>-------</h3>

                <?php
                if(!$model->isNewRecord) $transcription = CatalogList::getValue($model->id, $lang->id);
                ?>

                <?if(!empty($transcription)){?>
                    <?= $form->field($model,'title['.$lang->id.']['.$transcription->id .']')->label('Title')->textInput(['maxlength' => true, 'value' => $transcription['title']])?>
                <?} else {?>
                    <?= $form->field($model,'titleNew['.$lang->id.'][]')->label('Title')->textInput(['maxlength' => true, 'value' => ''])?>
                <?}?>

                <?if(!empty($transcription)){?>
                    <?= $form->field($model, 'description['.$lang->id.']['.$transcription->id .']')->widget(CKEditor::className(), [
                        'options' => [
                            'row' => 2,
                            'value' => $transcription['description']],
                    ])->label(Yii::t('app','Description'))?>

                <?} else {?>

                    <?= $form->field($model, 'descriptionNew['.$lang->id.'][]')->widget(CKEditor::className(), [
                        'options' => [
                            'row' => 2,
                            'value' => '',]
                    ])->label(Yii::t('app','Description'))?>

                <?}?>

        <?php endforeach; ?>


        <h1>Put image here</h1>

    <?php echo $form->field($model, 'hostImage')->widget(Widget::className(), [
        'uploadUrl' => Url::toRoute('catalog-list/uploadPhoto'),
        'width' => 350,
        'height' => 335
    ])->label('') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-lg btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
