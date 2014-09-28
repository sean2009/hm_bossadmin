<?php

/**
 * This is the model class for table "{{power_login}}".
 *
 * The followings are the available columns in table '{{power_login}}':
 * @property integer $id
 * @property string $token
 * @property integer $admin_id
 * @property integer $admin_type
 * @property string $admin_name
 * @property string $admin_tname
 * @property string $login_time
 * @property integer $is_valid
 * @property string $login_ip
 * @property string $sign_list
 * @property integer $login_num
 * @property integer $role_id
 */
class PowerLoginModel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PowerLoginModel the static model class
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
		return '{{power_login}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_id, admin_type, is_valid, login_num, role_id', 'numerical', 'integerOnly'=>true),
			array('token', 'length', 'max'=>32),
			array('admin_name, admin_tname', 'length', 'max'=>50),
			array('login_ip', 'length', 'max'=>20),
			array('login_time, sign_list', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, token, admin_id, admin_type, admin_name, admin_tname, login_time, is_valid, login_ip, sign_list, login_num, role_id', 'safe', 'on'=>'search'),
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
			'token' => 'Token',
			'admin_id' => 'Admin',
			'admin_type' => 'Admin Type',
			'admin_name' => 'Admin Name',
			'admin_tname' => 'Admin Tname',
			'login_time' => 'Login Time',
			'is_valid' => 'Is Valid',
			'login_ip' => 'Login Ip',
			'sign_list' => 'Sign List',
			'login_num' => 'Login Num',
			'role_id' => 'Role',
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
		$criteria->compare('token',$this->token,true);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('admin_type',$this->admin_type);
		$criteria->compare('admin_name',$this->admin_name,true);
		$criteria->compare('admin_tname',$this->admin_tname,true);
		$criteria->compare('login_time',$this->login_time,true);
		$criteria->compare('is_valid',$this->is_valid);
		$criteria->compare('login_ip',$this->login_ip,true);
		$criteria->compare('sign_list',$this->sign_list,true);
		$criteria->compare('login_num',$this->login_num);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}