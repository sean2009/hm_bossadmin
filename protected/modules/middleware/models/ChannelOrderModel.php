<?php

/**
 * This is the model class for table "{{split_order}}".
 *
 * The followings are the available columns in table '{{split_order}}':
 * @property integer $id
 * @property integer $channel_id
 * @property integer $tid
 * @property integer $num
 * @property string $buyer_nick
 * @property string $status
 * @property double $total_fee
 * @property double $post_fee
 * @property double $adjust_fee
 * @property double $payment
 * @property string $buyer_message
 * @property string $buyer_email
 * @property string $receiver_address
 * @property string $receiver_city
 * @property string $receiver_district
 * @property string $receiver_mobile
 * @property string $receiver_name
 * @property string $receiver_phone
 * @property string $receiver_state
 * @property string $receiver_zip
 * @property string $created
 * @property string $consign_time
 * @property string $end_time
 * @property string $pay_time
 * @property string $invoice_name
 * @property string $sys_add_time
 * @property integer $sys_deliver_goods
 * @property integer $sys_order_status
 * @property integer $sys_pay_status
 * @property integer $sys_shipping_status
 * @property string $sys_order_id
 * @property string $sys_upd_time
 * @property integer $sys_is_synch
 * @property string $sys_synch_time
 */
class ChannelOrderModel extends BaseMiddlewareActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChannelOrderModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{channel_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('channel_id', 'required'),
			array('channel_id, tid, num, sys_deliver_goods, sys_order_status, sys_pay_status, sys_shipping_status, sys_is_synch', 'numerical', 'integerOnly'=>true),
			array('total_fee, post_fee, adjust_fee, payment', 'numerical'),
			array('buyer_nick, buyer_email', 'length', 'max'=>100),
			array('status, receiver_city, receiver_district', 'length', 'max'=>50),
			array('buyer_message, receiver_address', 'length', 'max'=>255),
			array('receiver_mobile, receiver_name, receiver_phone, receiver_state', 'length', 'max'=>30),
			array('receiver_zip', 'length', 'max'=>10),
			array('invoice_name', 'length', 'max'=>200),
			array('sys_order_id', 'length', 'max'=>20),
			array('created, consign_time, end_time, pay_time, sys_add_time, sys_upd_time, sys_synch_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, channel_id, tid, num, buyer_nick, status, total_fee, post_fee, adjust_fee, payment, buyer_message, buyer_email, receiver_address, receiver_city, receiver_district, receiver_mobile, receiver_name, receiver_phone, receiver_state, receiver_zip, created, consign_time, end_time, pay_time, invoice_name, sys_add_time, sys_deliver_goods, sys_order_status, sys_pay_status, sys_shipping_status, sys_order_id, sys_upd_time, sys_is_synch, sys_synch_time', 'safe', 'on'=>'search'),
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
			'tid' => 'Tid',
			'num' => 'Num',
			'buyer_nick' => 'Buyer Nick',
			'status' => 'Status',
			'total_fee' => 'Total Fee',
			'post_fee' => 'Post Fee',
			'adjust_fee' => 'Adjust Fee',
			'payment' => 'Payment',
			'buyer_message' => 'Buyer Message',
			'buyer_email' => 'Buyer Email',
			'receiver_address' => 'Receiver Address',
			'receiver_city' => 'Receiver City',
			'receiver_district' => 'Receiver District',
			'receiver_mobile' => 'Receiver Mobile',
			'receiver_name' => 'Receiver Name',
			'receiver_phone' => 'Receiver Phone',
			'receiver_state' => 'Receiver State',
			'receiver_zip' => 'Receiver Zip',
			'created' => 'Created',
			'consign_time' => 'Consign Time',
			'end_time' => 'End Time',
			'pay_time' => 'Pay Time',
			'invoice_name' => 'Invoice Name',
			'sys_add_time' => 'Sys Add Time',
			'sys_deliver_goods' => 'Sys Deliver Goods',
			'sys_order_status' => 'Sys Order Status',
			'sys_pay_status' => 'Sys Pay Status',
			'sys_shipping_status' => 'Sys Shipping Status',
			'sys_order_id' => 'Sys Order',
			'sys_upd_time' => 'Sys Upd Time',
			'sys_is_synch' => 'Sys Is Synch',
			'sys_synch_time' => 'Sys Synch Time',
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
		$criteria->compare('tid',$this->tid);
		$criteria->compare('buyer_nick',$this->buyer_nick,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('total_fee',$this->total_fee);
		$criteria->compare('post_fee',$this->post_fee);
		$criteria->compare('adjust_fee',$this->adjust_fee);
		$criteria->compare('payment',$this->payment);
		$criteria->compare('buyer_message',$this->buyer_message,true);
		$criteria->compare('buyer_email',$this->buyer_email,true);
		$criteria->compare('receiver_address',$this->receiver_address,true);
		$criteria->compare('receiver_city',$this->receiver_city,true);
		$criteria->compare('receiver_district',$this->receiver_district,true);
		$criteria->compare('receiver_mobile',$this->receiver_mobile,true);
		$criteria->compare('receiver_name',$this->receiver_name,true);
		$criteria->compare('receiver_phone',$this->receiver_phone,true);
		$criteria->compare('receiver_state',$this->receiver_state,true);
		$criteria->compare('receiver_zip',$this->receiver_zip,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('consign_time',$this->consign_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('pay_time',$this->pay_time,true);
		$criteria->compare('invoice_name',$this->invoice_name,true);
		$criteria->compare('sys_add_time',$this->sys_add_time,true);
		$criteria->compare('sys_deliver_goods',$this->sys_deliver_goods);
		$criteria->compare('sys_order_status',$this->sys_order_status);
		$criteria->compare('sys_pay_status',$this->sys_pay_status);
		$criteria->compare('sys_shipping_status',$this->sys_shipping_status);
		$criteria->compare('sys_upd_time',$this->sys_upd_time,true);
		$criteria->compare('sys_is_synch',$this->sys_is_synch);
		$criteria->compare('sys_synch_time',$this->sys_synch_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}