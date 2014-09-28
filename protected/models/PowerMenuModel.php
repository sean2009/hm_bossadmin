<?php

/**
 * This is the model class for table "{{power_menu}}".
 *
 * The followings are the available columns in table '{{power_menu}}':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $url
 * @property string $sign
 * @property string $add_time
 * @property string $upd_time
 * @property integer $is_deleted
 * @property integer $menu_type
 * @property integer $level
 * @property integer $sort
 */
class PowerMenuModel extends BaseBossActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PowerMenuModel the static model class
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
		return '{{power_menu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('parent_id,name,sign','required'),
			array('parent_id, is_deleted, menu_type,url_type, level, sort', 'numerical', 'integerOnly'=>true),
			array('name, sign', 'length', 'max'=>50),
                        array('url', 'length', 'max'=>250),
//                        array('name','unique','message'=>'该名称已使用！'),
                        array('sign','unique','message'=>'该标识已使用！'),
			array('add_time, upd_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, name, url, sign, add_time, upd_time, is_deleted, menu_type,url_type, level, sort', 'safe', 'on'=>'search'),
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
			'parent_id' => '上级菜单ID',
			'name' => '名称',
			'url' => '链接',
			'sign' => '标识',
			'add_time' => 'Add Time',
			'upd_time' => 'Upd Time',
			'is_deleted' => 'Is Deleted',
			'menu_type' => 'Menu Type',
                        'url_type' => 'Url Type',
			'level' => 'Level',
			'sort' => 'Sort',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('sign',$this->sign,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('upd_time',$this->upd_time,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('menu_type',$this->menu_type);
		$criteria->compare('level',$this->level);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}