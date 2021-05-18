<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "term".
 *
 * @property int $id
 * @property int $stage_id
 * @property int $project_id
 * @property string $start_time
 * @property string|null $end_time
 */
class Term extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'term';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stage_id', 'project_id', 'start_time'], 'required'],
            [['stage_id', 'project_id'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stage_id' => 'Stage ID',
            'project_id' => 'Project ID',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ];
    }
}
