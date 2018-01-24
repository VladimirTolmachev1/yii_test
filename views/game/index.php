<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\helpers\Html;
?>
<div class="site-index">
    <div class="top-panel">
        <div class="top-panel-items">My money: $<span id="money-count"><?= $money_amount; ?></span></div>
        <div class="top-panel-items">My bonuses: <span id="bonus-count"><?= $bonus_amount; ?></span></div>
        <div class="top-panel-items">
            <?= Html::a('Send money to cart', '#', ['onclick' => 'sendMoney()']); ?>
        </div>
        <div class="top-panel-items">
            <?= Html::a('Convert money to bonus', '#', ['onclick' => 'convertMoney()']); ?>
        </div>
    </div>
    <div class="push-button">
        <?= Html::submitButton('START GAME',
            [
                'class' => 'btn btn-danger',
                'name' => 'game-button',
                'id' => 'game-button',
                'onclick' => 'startGame()'
            ]); ?>
    </div>
    <div id="game-result">
    </div>
</div>
