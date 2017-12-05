<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reg".
 *
 * @property integer $id
 * @property string $user
 * @property string $pwd
 * @property string $desc
 */
class Reg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'pwd', 'desc'], 'string', 'max' => 255],
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
            'desc' => 'Desc',
        ];
    }
}
