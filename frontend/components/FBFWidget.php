<?php

namespace frontend\components;

use Yii;
use yii\base\Widget;
use frontend\models\ContactForm;

class FBFWidget extends Widget
{

    public function run()
    {
//        сделать запись сообщений в БД

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
        }
        return $this->render('fbfWidget', [
            'model' => $model,
        ]);
    }

}