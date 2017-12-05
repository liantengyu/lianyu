<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "leave".
 *
 * @property integer $id
 * @property string $content
 * @property string $time
 * @property string $username_id
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
            [['content', 'username_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'time' => 'Time',
            'username_id' => 'Username ID',
        ];
    }
}
