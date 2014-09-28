<?php

/**
 * This is the model class for table "{{admin_user}}".
 *
 * The followings are the available columns in table '{{admin_user}}':
 * @property integer $admin_id
 * @property string $admin_name
 * @property integer $role_id
 * @property string $email
 * @property string $passwd
 * @property integer $mobile
 * @property string $last_login_date
 * @property string $last_login_ip
 * @property integer $is_deleted
 * @property string $add_date
 * @property string $edit_date
 * @property integer $add_admin_id
 * @property integer $edit_admin_id
 * @property string $latest_time
 */
class AdminUserModel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminUserModel the static model class
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
		return '{{admin_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id,  is_deleted, add_admin_id, edit_admin_id', 'numerical', 'integerOnly'=>true),
			array('admin_name', 'length', 'max'=>100),
			array('captcha','captcha','on'=>'login'),
			array('admin_name,passwd','required','on'=>'login'),
			array('passwd','valiPass','on'=>'login'),
			array('email, passwd, last_login_ip', 'length', 'max'=>200),
			array('last_login_date, add_date, edit_date, latest_time,mobile', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_id, admin_name, role_id, email, passwd, mobile, last_login_date, last_login_ip, is_deleted, add_date, edit_date, add_admin_id, edit_admin_id, latest_time', 'safe', 'on'=>'search'),
		);
	}
	
	public function valiPass(){
		$info = $this->find(array(
		       'select'=>'admin_id,admin_name,email,passwd',
		       'condition'=>'admin_name = :admin_name and passwd = :passwd',
		       'params'=>array(':admin_name'=>$this->admin_name,':passwd'=>$this->passwd),
  		 ));
		 if(empty($info)){
			$this->addError('passwd','登录密码错误!');
			return false;
		 }
		 return true;
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
			'admin_id' => 'Admin',
			'admin_name' => 'Admin Name',
			'role_id' => 'Role',
			'email' => 'Email',
			'passwd' => 'Passwd',
			'mobile' => 'Mobile',
			'last_login_date' => 'Last Login Date',
			'last_login_ip' => 'Last Login Ip',
			'is_deleted' => 'Is Deleted',
			'add_date' => 'Add Date',
			'edit_date' => 'Edit Date',
			'add_admin_id' => 'Add Admin',
			'edit_admin_id' => 'Edit Admin',
			'latest_time' => 'Latest Time',
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

		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('admin_name',$this->admin_name,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('passwd',$this->passwd,true);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('last_login_date',$this->last_login_date,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('add_date',$this->add_date,true);
		$criteria->compare('edit_date',$this->edit_date,true);
		$criteria->compare('add_admin_id',$this->add_admin_id);
		$criteria->compare('edit_admin_id',$this->edit_admin_id);
		$criteria->compare('latest_time',$this->latest_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}