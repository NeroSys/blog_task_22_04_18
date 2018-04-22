<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Articles;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use common\models\CatalogList;
use yii\helpers\Url;
use common\components\cropper\Widget;

/* @var $this yii\web\View */
/* @var $model common\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(CatalogList::find()->asArray()->all(),'id', 'name'), ['prompt' => 'Choose category']) ?>


    <?php if (!$model->isNewRecord){?>
        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?}?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <h1>Translations content</h1>

    <?php foreach ($langs as $lang): ?>
    <p>-----------<?= $lang->name ?>----------------</p>

            <?php
            if(!$model->isNewRecord) $transcription = Articles::getValue($model->id, $lang->id);
            ?>

            <?if(!empty($transcription)){?>
                <?= $form->field($model,'title['.$lang->id.']['.$transcription->id .']')->textInput(['maxlength' => true, 'value' => $transcription['title']])?>
            <?} else {?>
                <?= $form->field($model,'titleNew['.$lang->id.'][]')->textInput(['maxlength' => true, 'value' => ''])?>
            <?}?>

            <?if(!empty($transcription)){?>
                <?= $form->field($model,'author['.$lang->id.']['.$transcription->id .']')->textInput(['maxlength' => true, 'value' => $transcription['author']])?>
            <?} else {?>
                <?= $form->field($model,'authorNew['.$lang->id.'][]')->textInput(['maxlength' => true, 'value' => ''])?>
            <?}?>

            <?if(!empty($transcription)){?>
                <?= $form->field($model, 'description['.$lang->id.']['.$transcription->id .']')->widget(CKEditor::className(), [
                    'options' => [
                        'row' => 2,
                        'value' => $transcription['description']],
                ])?>

            <?} else {?>

                <?= $form->field($model, 'descriptionNew['.$lang->id.'][]')->widget(CKEditor::className(), [
                    'options' => [
                        'row' => 2,
                        'value' => '',]
                ])?>

            <?}?>

            <?if(!empty($transcription)){?>
                <?= $form->field($model, 'text['.$lang->id.']['.$transcription->id .']')->widget(CKEditor::className(), [
                    'options' => [
                        'row' => 2,
                        'value' => $transcription['text']],
                ])?>

            <?} else {?>

                <?= $form->field($model, 'textNew['.$lang->id.'][]')->widget(CKEditor::className(), [
                    'options' => [
                        'row' => 2,
                        'value' => ''],
                ])?>

            <?}?>

    <?php endforeach; ?>

    <h1>Images</h1>

    <?php echo $form->field($model, 'hostImage')->widget(Widget::className(), [
        'uploadUrl' => Url::toRoute('articles/uploadPhoto'),
        'width' => 350,
        'height' => 300
    ])->label('Preview') ?>


    <?php echo $form->field($model, 'mainImage')->widget(Widget::className(), [
        'uploadUrl' => Url::toRoute('articles/uploadPhoto'),
        'width' => 600,
        'height' => 575
    ])->label('Main') ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
