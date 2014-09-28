<?php

/**
 * This is the model class for table "{{power_user}}".
 *
 * The followings are the available columns in table '{{power_user}}':
 * @property integer $admin_id
 * @property string $admin_name
 * @property string $admin_tname
 * @property integer $admin_type
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
 * @property integer $login_num
 */
class PowerUserModel extends BaseBossActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PowerUserModel the static model class
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
		return '{{power_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_name, admin_tname, role_id, email, mobile', 'required'),
                        array('passwd','required','on'=>'add'),
//                        array('passwd','valiPwd','on'=>'add'),
//                        array('add_admin_id','valiUpd','on'=>'upd'),
                        array('admin_tname','unique','message'=>'该真实姓名已经存在！'),
                        array('admin_name','unique','message'=>'该登录名已经存在！'),
                        array('email','email'),
                        array('mobile','match','pattern'=>'/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/','message'=>'请输入正确的手机号码！'),
			array('admin_type, role_id, is_deleted, add_admin_id, edit_admin_id, login_num', 'numerical', 'integerOnly'=>true),
			array('admin_name', 'length', 'max'=>100),
			array('admin_tname', 'length', 'max'=>50),
			array('email, passwd, last_login_ip', 'length', 'max'=>200),
			array('last_login_date,mobile, add_date, edit_date, latest_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_id, admin_name, admin_tname, admin_type, role_id, email, passwd, mobile, last_login_date, last_login_ip, is_deleted, add_date, edit_date, add_admin_id, edit_admin_id, latest_time, login_num', 'safe', 'on'=>'search'),
		);
	}
        
        public function beforeSave() {
		if ($this->isNewRecord){
			$this->add_admin_id = Yii::app()->adminuser->admin_id;
                        $this->passwd = md5($this->passwd);
		}else
			$this->edit_admin_id = Yii::app()->adminuser->admin_id;
		return parent::beforeSave();
	}

        /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'role' => array(self::BELONGS_TO,'PowerRoleModel','role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'admin_id' => 'Admin',
			'admin_name' => '登录名',
			'admin_tname' => '真实姓名',
			'admin_type' => '员工类型',
			'role_id' => '角色',
			'email' => 'Email',
			'passwd' => '密码',
			'mobile' => '手机号码',
			'last_login_date' => 'Last Login Date',
			'last_login_ip' => 'Last Login Ip',
			'is_deleted' => 'Is Deleted',
			'add_date' => 'Add Date',
			'edit_date' => 'Edit Date',
			'add_admin_id' => 'Add Admin',
			'edit_admin_id' => 'Edit Admin',
			'latest_time' => 'Latest Time',
			'login_num' => 'Login Num',
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
		$criteria->compare('admin_tname',$this->admin_tname,true);
		$criteria->compare('admin_type',$this->admin_type);
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
		$criteria->compare('login_num',$this->login_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}