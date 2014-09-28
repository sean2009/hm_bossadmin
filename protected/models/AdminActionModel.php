<?php

/**
 * This is the model class for table "{{admin_action}}".
 *
 * The followings are the available columns in table '{{admin_action}}':
 * @property integer $action_id
 * @property string $action_name
 * @property integer $parent_id
 * @property string $action_code
 * @property string $action_url
 * @property integer $action_desc
 * @property string $admin_website
 * @property integer $is_deleted
 * @property string $add_date
 * @property string $edit_date
 * @property integer $add_admin_id
 * @property integer $edit_admin_id
 * @property string $latest_time
 */
class AdminActionModel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminActionModel the static model class
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
		return '{{admin_action}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, action_desc, is_deleted, add_admin_id, edit_admin_id', 'numerical', 'integerOnly'=>true),
			array('action_name', 'length', 'max'=>100),
			array('action_code', 'length', 'max'=>200),
			array('action_url', 'length', 'max'=>600),
			array('admin_website', 'length', 'max'=>50),
			array('add_date, edit_date, latest_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('action_id, action_name, parent_id, action_code, action_url, action_desc, admin_website, is_deleted, add_date, edit_date, add_admin_id, edit_admin_id, latest_time', 'safe', 'on'=>'search'),
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
			'action_id' => 'Action',
			'action_name' => 'Action Name',
			'parent_id' => 'Parent',
			'action_code' => 'Action Code',
			'action_url' => 'Action Url',
			'action_desc' => 'Action Desc',
			'admin_website' => 'Admin Website',
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

		$criteria->compare('action_id',$this->action_id);
		$criteria->compare('action_name',$this->action_name,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('action_code',$this->action_code,true);
		$criteria->compare('action_url',$this->action_url,true);
		$criteria->compare('action_desc',$this->action_desc);
		$criteria->compare('admin_website',$this->admin_website,true);
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