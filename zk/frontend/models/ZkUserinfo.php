<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "zk_userinfo".
 *
 * @property integer $id
 * @property string $phone
 * @property string $pwd
 * @property string $name
 * @property string $birth
 * @property string $address
 * @property string $tag
 */
class ZkUserinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zk_userinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'pwd', 'name', 'birth', 'address', 'tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'pwd' => 'Pwd',
            'name' => 'Name',
            'birth' => 'Birth',
            'address' => 'Address',
            'tag' => 'Tag',
        ];
    }
}
