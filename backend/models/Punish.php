<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "punish".
 *
 * @property int $punish_id
 * @property string $content
 * @property int $is_use
 */
class Punish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'punish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_use'], 'integer'],
            [['content'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'punish_id' => 'Punish ID',
            'content' => '惩罚内容',
            'is_use' => '是否启用',
        ];
    }
}
