<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "zk_tag".
 *
 * @property integer $id
 * @property string $tag_name
 */
class ZkTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zk_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_name' => 'Tag Name',
        ];
    }
}
