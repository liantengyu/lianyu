<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "filed".
 *
 * @property integer $id
 * @property string $name
 * @property string $default
 * @property string $cat
 * @property integer $is_must
 * @property string $rule
 * @property string $min
 * @property string $max
 */
class Filed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_must'], 'integer'],
            [['name', 'default', 'cat', 'rule', 'min', 'max'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'default' => 'Default',
            'cat' => 'Cat',
            'is_must' => 'Is Must',
            'rule' => 'Rule',
            'min' => 'Min',
            'max' => 'Max',
        ];
    }
}
