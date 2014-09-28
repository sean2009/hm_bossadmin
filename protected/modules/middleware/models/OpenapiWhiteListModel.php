<?php

/**
 * This is the model class for table "openapi_white_list".
 *
 * The followings are the available columns in table 'openapi_white_list':
 * @property integer $id
 * @property string $api_type
 * @property string $white_ip
 * @property string $add_time
 * @property string $upd_time
 */
class OpenapiWhiteListModel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OpenapiWhiteListModel the static model class
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
		return 'openapi_white_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('api_type', 'length', 'max'=>10),
			array('white_ip', 'length', 'max'=>20),
			array('add_time, upd_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, api_type, white_ip, add_time, upd_time', 'safe', 'on'=>'search'),
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
			'api_type' => 'Api Type',
			'white_ip' => 'White Ip',
			'add_time' => 'Add Time',
			'upd_time' => 'Upd Time',
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
		$criteria->compare('api_type',$this->api_type,true);
		$criteria->compare('white_ip',$this->white_ip,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('upd_time',$this->upd_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}