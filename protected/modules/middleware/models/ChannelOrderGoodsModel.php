<?php

/**
 * This is the model class for table "{{channel_order_goods}}".
 *
 * The followings are the available columns in table '{{channel_order_goods}}':
 * @property integer $id
 * @property integer $order_id
 * @property string $oid
 * @property string $status
 * @property string $title
 * @property double $price
 * @property integer $num_iid
 * @property string $sku_id
 * @property string $outer_iid
 * @property string $outer_sku_id
 * @property integer $num
 * @property double $total_fee
 * @property double $payment
 * @property double $discount_fee
 * @property double $adjust_fee
 * @property string $sku_properties_name
 * @property integer $refund_id
 * @property integer $is_service_order
 * @property double $divide_order_fee
 * @property double $part_mjz_discount
 * @property string $refund_status
 * @property string $sys_add_time
 * @property integer $sys_goods_id
 * @property integer $sys_goods_sku_id
 */
class ChannelOrderGoodsModel extends BaseMiddlewareActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChannelOrderGoodsModel the static model class
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
		return '{{channel_order_goods}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, num_iid, num, refund_id, is_service_order, sys_goods_id, sys_goods_sku_id', 'numerical', 'integerOnly'=>true),
			array('price, total_fee, payment, discount_fee, adjust_fee, divide_order_fee, part_mjz_discount', 'numerical'),
			array('oid, status, outer_iid, outer_sku_id', 'length', 'max'=>30),
			array('title', 'length', 'max'=>200),
			array('sku_id, refund_status', 'length', 'max'=>20),
			array('sku_properties_name', 'length', 'max'=>255),
			array('sys_add_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, oid, status, title, price, num_iid, sku_id, outer_iid, outer_sku_id, num, total_fee, payment, discount_fee, adjust_fee, sku_properties_name, refund_id, is_service_order, divide_order_fee, part_mjz_discount, refund_status, sys_add_time, sys_goods_id, sys_goods_sku_id', 'safe', 'on'=>'search'),
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
			'order_id' => 'Order',
			'oid' => 'Oid',
			'status' => 'Status',
			'title' => 'Title',
			'price' => 'Price',
			'num_iid' => 'Num Iid',
			'sku_id' => 'Sku',
			'outer_iid' => 'Outer Iid',
			'outer_sku_id' => 'Outer Sku',
			'num' => 'Num',
			'total_fee' => 'Total Fee',
			'payment' => 'Payment',
			'discount_fee' => 'Discount Fee',
			'adjust_fee' => 'Adjust Fee',
			'sku_properties_name' => 'Sku Properties Name',
			'refund_id' => 'Refund',
			'is_service_order' => 'Is Service Order',
			'divide_order_fee' => 'Divide Order Fee',
			'part_mjz_discount' => 'Part Mjz Discount',
			'refund_status' => 'Refund Status',
			'sys_add_time' => 'Sys Add Time',
			'sys_goods_id' => 'Sys Goods',
			'sys_goods_sku_id' => 'Sys Goods Sku',
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('oid',$this->oid,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('num_iid',$this->num_iid);
		$criteria->compare('sku_id',$this->sku_id,true);
		$criteria->compare('outer_iid',$this->outer_iid,true);
		$criteria->compare('outer_sku_id',$this->outer_sku_id,true);
		$criteria->compare('num',$this->num);
		$criteria->compare('total_fee',$this->total_fee);
		$criteria->compare('payment',$this->payment);
		$criteria->compare('discount_fee',$this->discount_fee);
		$criteria->compare('adjust_fee',$this->adjust_fee);
		$criteria->compare('sku_properties_name',$this->sku_properties_name,true);
		$criteria->compare('refund_id',$this->refund_id);
		$criteria->compare('is_service_order',$this->is_service_order);
		$criteria->compare('divide_order_fee',$this->divide_order_fee);
		$criteria->compare('part_mjz_discount',$this->part_mjz_discount);
		$criteria->compare('refund_status',$this->refund_status,true);
		$criteria->compare('sys_add_time',$this->sys_add_time,true);
		$criteria->compare('sys_goods_id',$this->sys_goods_id);
		$criteria->compare('sys_goods_sku_id',$this->sys_goods_sku_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}