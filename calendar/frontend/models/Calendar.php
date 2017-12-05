<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "calendar".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $days
 * @property integer $money
 * @property integer $date
 * @property integer $num_money
 */
class Calendar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calendar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'days', 'money', 'date', 'num_money'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'days' => 'Days',
            'money' => 'Money',
            'date' => 'Date',
            'num_money' => 'Num Money',
        ];
    }
}
