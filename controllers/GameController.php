<?php
namespace app\controllers;

use app\models\Bonus;
use app\models\Money;
use app\models\Presents;
use app\models\Transactions;
use Yii;
use yii\web\Controller;

class GameController extends Controller{

    /**
     * Index action
     *
     * @return string
     */
    public function actionIndex(){
        $this->view->registerJsFile('js/game.js');
        $this->view->registerCssFile('css/game.css');

        $money_amount = (new Money())->getMoneyAmmountByUid(Yii::$app->user->identity->getId());
        $bonus_amount = (new Bonus())->getBousAmmountByUid(Yii::$app->user->identity->getId());

        return $this->render('index', ['money_amount' => $money_amount, 'bonus_amount' => $bonus_amount]);
    }

    /**
     * Save present action
     *
     * @return bool
     */
    public function actionSavePresent(){
        $present_item = new Presents();
        $present_item->uid = Yii::$app->user->identity->getId();
        $present_item->present_name = Yii::$app->request->post('present_name');
        $present_item->status = Yii::$app->request->post('present_status');

        if($present_item->save())
            return true;

        return false;
    }

    /**
     * Save money action
     *
     * @return bool
     */
    public function actionSaveMoney(){
        $money_item = new Money();
        if($money_item->saveRecord(Yii::$app->user->identity->getId(), Yii::$app->request->post('money_count')))
            return true;

        return false;
    }

    /**
     * Save bonus action
     *
     * @return bool
     */
    public function actionSaveBonus(){
        $bonus_item = new Bonus();

        if($bonus_item->saveRecord(Yii::$app->user->identity->getId(), Yii::$app->request->post('bonus_count')))
            return true;

        return false;
    }

    /**
     * Action to send money to card
     *
     * @return bool
     */
    public function actionSendMoney(){
        // Get all values
        $send_sum = Yii::$app->request->post('send_sum');
        $current_money_amount = (new Money())->getMoneyAmmountByUid(Yii::$app->user->identity->getId());

        // @TODO in this action we should call some lib method to send money to card!!

        // New money amount
        $new_money_amount = $current_money_amount - $send_sum;

        // Save new value for money
        if(!(new Money())->saveRecord(Yii::$app->user->identity->getId(), $new_money_amount))
            return false;

        // Write transaction
        $transaction_item = new Transactions();
        $transaction_item->uid = Yii::$app->user->identity->getId();
        $transaction_item->amount = $send_sum;
        $transaction_item->type = 'to_card';

        if($transaction_item->save())
            return true;

        return false;
    }

    /**
     * Action to convert money to bonuses
     *
     * @return bool
     */
    public function actionConvertMoney(){
        // Get all values
        $convert_sum = Yii::$app->request->post('convert_sum');
        $current_money_amount = (new Money())->getMoneyAmmountByUid(Yii::$app->user->identity->getId());
        $current_bonus_amount = (new Bonus())->getBousAmmountByUid(Yii::$app->user->identity->getId());

        // Convert with coefficient
        $new_bonus_amount = $current_bonus_amount + ($convert_sum / 2);

        // New money amount
        $new_money_amount = $current_money_amount - $convert_sum;

        // Save new value for bonus
        if(!(new Bonus())->saveRecord(Yii::$app->user->identity->getId(), $new_bonus_amount))
            return false;

        // Save new value for money
        if(!(new Money())->saveRecord(Yii::$app->user->identity->getId(), $new_money_amount))
            return false;

        // Write transaction
        $transaction_item = new Transactions();
        $transaction_item->uid = Yii::$app->user->identity->getId();
        $transaction_item->amount = $convert_sum;
        $transaction_item->type = 'to_bonus';

        if($transaction_item->save())
            return true;

        return false;
    }
}