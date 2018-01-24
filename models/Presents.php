<?php
namespace app\models;

use Yii;

class Presents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'present_name', 'status'], 'required'],
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
            'present_name' => 'Present name',
            'status' => 'status',
            'update_time' => 'Updated At',
        ];
    }
}