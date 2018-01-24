<?php
namespace app\models;

use Yii;

class Bonus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bonus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'amount'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'UID',
            'amount' => 'Amount',
            'update_time' => 'Updated At',
        ];
    }

    public function getBousAmmountByUid($uid){
        $res = Bonus::find()
            ->where(['uid' => $uid])
            ->one();

        if(!empty($res))
            return $res->amount;

        return 0;
    }

    /**
     * Custom save record function
     *
     * @param $uid
     * @param $amount
     * @return bool
     */
    public function saveRecord($uid, $amount){
        if(!$uid || !$amount)
            return false;

        $res = Bonus::find()
            ->where(['uid' => $uid])
            ->one();

        if(!empty($res)){
            $res->amount = $amount;
        }else{
            $res = new Bonus();
            $res->uid = $uid;
            $res->amount = $amount;
        }

        if($res->save())
            return true;

        return false;
    }
}