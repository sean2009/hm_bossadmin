<?php

/**
 * This is the model class for table "{{arg}}".
 *
 * The followings are the available columns in table '{{arg}}':
 * @property integer $arg_id
 * @property string $arg_code
 * @property string $arg_value
 * @property string $arg_type
 * @property integer $cate_id
 * @property string $arg_remark
 * @property integer $is_deleted
 * @property string $add_date
 * @property string $edit_date
 * @property integer $add_admin_id
 * @property integer $edit_admin_id
 * @property string $latest_time
 */
class ArgModel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArgModel the static model class
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
		return '{{arg}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cate_id', 'required'),
			array('cate_id, is_deleted, add_admin_id, edit_admin_id', 'numerical', 'integerOnly'=>true),
			array('arg_code', 'length', 'max'=>100),
			array('arg_value', 'length', 'max'=>2000),
			array('arg_type', 'length', 'max'=>60),
			array('arg_remark', 'length', 'max'=>600),
			array('add_date, edit_date, latest_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('arg_id, arg_code, arg_value, arg_type, cate_id, arg_remark, is_deleted, add_date, edit_date, add_admin_id, edit_admin_id, latest_time', 'safe', 'on'=>'search'),
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
			'arg_id' => 'Arg',
			'arg_code' => 'Arg Code',
			'arg_value' => 'Arg Value',
			'arg_type' => 'Arg Type',
			'cate_id' => 'Cate',
			'arg_remark' => 'Arg Remark',
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

		$criteria->compare('arg_id',$this->arg_id);
		$criteria->compare('arg_code',$this->arg_code,true);
		$criteria->compare('arg_value',$this->arg_value,true);
		$criteria->compare('arg_type',$this->arg_type,true);
		$criteria->compare('cate_id',$this->cate_id);
		$criteria->compare('arg_remark',$this->arg_remark,true);
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