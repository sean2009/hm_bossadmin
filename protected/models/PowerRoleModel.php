<?php

/**
 * This is the model class for table "{{power_role}}".
 *
 * The followings are the available columns in table '{{power_role}}':
 * @property integer $id
 * @property string $role_name
 * @property string $sign_ids
 * @property string $sign_list
 * @property integer $is_deleted
 * @property string $add_date
 * @property string $edit_date
 * @property integer $add_admin_id
 * @property integer $edit_admin_id
 */
class PowerRoleModel extends BaseBossActiveRecord
{
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PowerRoleModel the static model class
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
		return '{{power_role}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_deleted, add_admin_id, edit_admin_id', 'numerical', 'integerOnly'=>true),
			array('role_name', 'length', 'max'=>100),
                        array('role_name', 'required'),
                       // array('role_name','unique','message'=>'该名称已使用！'),
//			array('sign_ids, sign_list', 'length', 'max'=>60000),
			array('add_date, edit_date,sign_ids, sign_list', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, role_name, sign_ids,sign_list,is_deleted, add_date, edit_date, add_admin_id, edit_admin_id, latest_time', 'safe', 'on'=>'search'),
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
                    'user' => array(self::BELONGS_TO,'PowerUserModel','edit_admin_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_name' => '角色名',
			'sign_ids' => '菜单列表',
			'sign_list' => 'Sign List',
			'is_deleted' => 'Is Deleted',
			'add_date' => 'Add Date',
			'edit_date' => 'Edit Date',
			'add_admin_id' => 'Add Admin',
			'edit_admin_id' => 'Edit Admin',
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
		$criteria->compare('role_name',$this->role_name,true);
                $criteria->compare('sign_ids',$this->sign_ids,true);
		$criteria->compare('sign_list',$this->sign_list,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('add_date',$this->add_date,true);
		$criteria->compare('edit_date',$this->edit_date,true);
		$criteria->compare('add_admin_id',$this->add_admin_id);
		$criteria->compare('edit_admin_id',$this->edit_admin_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave() {
            $this->edit_date = new CDbExpression('NOW()');
            $this->edit_admin_id = Yii::app()->adminuser->admin_id;
            if ($this->isNewRecord){
                $this->add_admin_id = Yii::app()->adminuser->admin_id;
                $this->add_date = new CDbExpression('NOW()');  
            }
            return parent::beforeSave();
        }
}