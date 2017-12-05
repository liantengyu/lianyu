<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "username".
 *
 * @property integer $id
 * @property string $user
 * @property string $pwd
 */
class Username extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'username';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        ];
    }
}
