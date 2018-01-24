<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\helpers\Html;
use yii\bootstrap\Modal;
?>
<div class="site-index">
    <div class="top-panel">
        <div class="top-panel-items">My money: $<span id="money-count"><?= $money_amount; ?></span></div>
        <div class="top-panel-items">My bonuses: <span id="bonus-count"><?= $bonus_amount; ?></span></div>
        <div class="top-panel-items">
            <?= Html::a('Send money to card', '#', ['onclick' => 'showModalSend()']); ?>
        </div>
        <div class="top-panel-items">
            <?= Html::a('Convert money to bonus', '#', ['onclick' => 'showModalConvert()']); ?>
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

    <?php
        Modal::begin([
                'id' => 'modal',
                'size' => 'modal-md'
        ]);

        echo '<div id="modal-content"></div>';

        Modal::end();
    ?>

</div>
