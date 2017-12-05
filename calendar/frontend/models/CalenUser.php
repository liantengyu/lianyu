<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "calen_user".
 *
 * @property integer $id
 * @property string $user
 * @property string $pwd
 * @property integer $money
 */
class CalenUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calen_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money'], 'integer'],
            [['user', 'pwd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'pwd' => 'Pwd',
            'money' => 'Money',
        ];
    }
}
