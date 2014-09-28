<?php

/**
 * This is the model class for table "{{task_log}}".
 *
 * The followings are the available columns in table '{{task_log}}':
 * @property integer $id
 * @property string $task_type
 * @property integer $start_modify
 * @property integer $end_modify
 * @property integer $status
 * @property string $sys_add_time
 * @property string $params
 * @property integer $operate_type
 * @property string $error_msg
 * @property string $start_date
 * @property string $end_date
 */
class TaskLogModel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TaskLogModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return CDbConnection database connection
	 */
	public function getDbConnection()
	{
		return Yii::app()->db_mid;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{task_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_modify, end_modify, status, operate_type', 'numerical', 'integerOnly'=>true),
			array('task_type', 'length', 'max'=>30),
			array('sys_add_time, params, error_msg, start_date, end_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, task_type, start_modify, end_modify, status, sys_add_time, params, operate_type, error_msg, start_date, end_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'task_type' => 'Task Type',
			'start_modify' => 'Start Modify',
			'end_modify' => 'End Modify',
			'status' => 'Status',
			'sys_add_time' => 'Sys Add Time',
			'params' => 'Params',
			'operate_type' => 'Operate Type',
			'error_msg' => 'Error Msg',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('task_type',$this->task_type,true);
		$criteria->compare('start_modify',$this->start_modify);
		$criteria->compare('end_modify',$this->end_modify);
		$criteria->compare('status',$this->status);
		$criteria->compare('sys_add_time',$this->sys_add_time,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('operate_type',$this->operate_type);
		$criteria->compare('error_msg',$this->error_msg,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}