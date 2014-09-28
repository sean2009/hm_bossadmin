<?php

/**
 * This is the model class for table "{{logistics}}".
 *
 * The followings are the available columns in table '{{logistics}}':
 * @property integer $id
 * @property string $order_sn
 * @property string $tid
 * @property string $channel_tid
 * @property string $channel_type
 * @property string $channel_oid
 * @property string $logistics_company
 * @property string $logistics_id
 * @property integer $sys_is_send
 * @property string $sys_add_time
 * @property string $sys_upd_time
 */
class LogisticsModel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LogisticsModel the static model class
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
		return '{{logistics}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sys_is_send', 'numerical', 'integerOnly'=>true),
			array('order_sn, tid, channel_tid, channel_oid, logistics_company, logistics_id', 'length', 'max'=>30),
			array('channel_type', 'length', 'max'=>6),
			array('sys_add_time, sys_upd_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_sn, tid, channel_tid, channel_type, channel_oid, logistics_company, logistics_id, sys_is_send, sys_add_time, sys_upd_time', 'safe', 'on'=>'search'),
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
			'order_sn' => 'Order Sn',
			'tid' => 'Tid',
			'channel_tid' => 'Channel Tid',
			'channel_type' => 'Channel Type',
			'channel_oid' => 'Channel Oid',
			'logistics_company' => 'Logistics Company',
			'logistics_id' => 'Logistics',
			'sys_is_send' => 'Sys Is Send',
			'sys_add_time' => 'Sys Add Time',
			'sys_upd_time' => 'Sys Upd Time',
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
		$criteria->compare('order_sn',$this->order_sn,true);
		$criteria->compare('tid',$this->tid,true);
		$criteria->compare('channel_tid',$this->channel_tid,true);
		$criteria->compare('channel_type',$this->channel_type,true);
		$criteria->compare('channel_oid',$this->channel_oid,true);
		$criteria->compare('logistics_company',$this->logistics_company,true);
		$criteria->compare('logistics_id',$this->logistics_id,true);
		$criteria->compare('sys_is_send',$this->sys_is_send);
		$criteria->compare('sys_add_time',$this->sys_add_time,true);
		$criteria->compare('sys_upd_time',$this->sys_upd_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}