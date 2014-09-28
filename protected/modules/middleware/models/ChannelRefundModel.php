<?php

/**
 * This is the model class for table "{{channel_refund}}".
 *
 * The followings are the available columns in table '{{channel_refund}}':
 * @property integer $id
 * @property integer $channel_id
 * @property string $refund_id
 * @property string $tid
 * @property string $buyer_nick
 * @property double $refund_fee
 * @property string $order_status
 * @property string $oid
 * @property string $reason
 * @property string $desc
 * @property integer $has_good_return
 * @property string $company_name
 * @property string $sid
 * @property string $sys_add_time
 * @property string $channel_tid
 * @property string $channel_oid
 */
class ChannelRefundModel extends BaseMiddlewareActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChannelRefundModel the static model class
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
		return '{{channel_refund}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, channel_id, has_good_return', 'numerical', 'integerOnly'=>true),
			array('refund_fee', 'numerical'),
			array('refund_id, tid, buyer_nick, oid, company_name, sid', 'length', 'max'=>30),
			array('order_status', 'length', 'max'=>20),
			array('reason, desc', 'length', 'max'=>255),
			array('channel_tid, channel_oid', 'length', 'max'=>35),
			array('sys_add_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, channel_id, refund_id, tid, buyer_nick, refund_fee, order_status, oid, reason, desc, has_good_return, company_name, sid, sys_add_time, channel_tid, channel_oid', 'safe', 'on'=>'search'),
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
                    'channel'=>array(self::BELONGS_TO, 'ChannelModel', 'channel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'channel_id' => 'Channel',
			'refund_id' => 'Refund',
			'tid' => 'Tid',
			'buyer_nick' => 'Buyer Nick',
			'refund_fee' => 'Refund Fee',
			'order_status' => 'Order Status',
			'oid' => 'Oid',
			'reason' => 'Reason',
			'desc' => 'Desc',
			'has_good_return' => 'Has Good Return',
			'company_name' => 'Company Name',
			'sid' => 'Sid',
			'sys_add_time' => 'Sys Add Time',
			'channel_tid' => 'Channel Tid',
			'channel_oid' => 'Channel Oid',
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
		$criteria->compare('channel_id',$this->channel_id);
		$criteria->compare('refund_id',$this->refund_id,true);
		$criteria->compare('tid',$this->tid,true);
		$criteria->compare('buyer_nick',$this->buyer_nick,true);
		$criteria->compare('refund_fee',$this->refund_fee);
		$criteria->compare('order_status',$this->order_status,true);
		$criteria->compare('oid',$this->oid,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('has_good_return',$this->has_good_return);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('sys_add_time',$this->sys_add_time,true);
		$criteria->compare('channel_tid',$this->channel_tid,true);
		$criteria->compare('channel_oid',$this->channel_oid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}