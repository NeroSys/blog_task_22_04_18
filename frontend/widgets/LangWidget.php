<?php
/**
 * Виджет переключения языков
 */

namespace frontend\widgets;

use common\models\Lang;
use yii\bootstrap\Widget;

class LangWidget extends Widget
{
    public function init(){

    }

    public function run() {

        $langs = Lang::find()
//                    ->where('id != :current_id', [':current_id' => Lang::getCurrent()->id])
//                    ->where([':current_id' => Lang::getCurrent()->id])
                    ->orderBy(['url' => SORT_ASC])
                    ->all();

        return $this->render('lang/view', [

            'current' => Lang::getCurrent(),
            'langs' => $langs,

        ]);
    }
}
