<?php
namespace app\models;

use Yii;
use common\models\User;
use yii\db\ActiveRecord;

class Taskapp extends ActiveRecord
{
	// Здесь будет храниться отформатированная дата
	public $created_at_formatted;

    public $desc;

	

	public static function tableName(){
		return 'task';
	}

	public function rules()
    {
        return [
            [['description', 'created_at_formatted','deadline','priority','status'], 'required', 'message' => 'Это поле пустое!'],
            ['deadline', 'integer'],
            ['created_at_formatted', 'date', 'format' => 'php:d.m.Y'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'description' => 'Описание',
            'priority' => 'Приоритет',
            'status' => 'Статус',
            'created_at_formatted' => 'Крайний срок',
            'desc' => false,
        ];
    }

}