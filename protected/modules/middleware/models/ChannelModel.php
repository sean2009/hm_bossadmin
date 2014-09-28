<?php

/**
 * This is the model class for table "{{channel}}".
 *
 * The followings are the available columns in table '{{channel}}':
 * @property integer $id
 * @property string $channel_name
 * @property string $channel_type
 * @property string $appkey
 * @property string $secretkey
 * @property integer $token_create_time
 * @property string $access_token
 * @property integer $expires_in
 * @property string $refresh_token
 * @property integer $re_expires_in
 * @property string $add_time
 * @property string $upd_time
 */
class ChannelModel extends BaseMiddlewareActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChannelModel the static model class
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
		return '{{channel}}';
	}
        
        public function getList(){
            $list = $this->findAll('access_token is not NULL');
            $channel = array();
            foreach($list as $v){
                $channel[] = $v->attributes;
            }
            return $channel;
        }
        
        public function setTokenValue($channel_id,$token){
            $data['access_token'] = $token->access_token;
            $data['expires_in'] = $token->expires_in;
            $data['refresh_token'] = $token->refresh_token;
            $data['re_expires_in'] = $token->re_expires_in;
            $data['token_create_time'] = time();
            $this->updateByPk($channel_id,$data);
        }

        /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('channel_name, channel_type, appkey, secretkey', 'required'),
			array('channel_name, channel_type, appkey, secretkey', 'length', 'max'=>50),
			array('access_token, refresh_token', 'length', 'max'=>32),
			array('add_time, upd_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, channel_name, channel_type, appkey, secretkey, token_create_time, access_token, expires_in, refresh_token, re_expires_in, add_time, upd_time', 'safe', 'on'=>'search'),
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
			'channel_name' => 'Channel Name',
			'channel_type' => 'Channel Type',
			'appkey' => 'Appkey',
			'secretkey' => 'Secretkey',
			'token_create_time' => 'Token Create Time',
			'access_token' => 'Access Token',
			'expires_in' => 'Expires In',
			'refresh_token' => 'Refresh Token',
			're_expires_in' => 'Re Expires In',
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
		$criteria->compare('channel_name',$this->channel_name,true);
		$criteria->compare('channel_type',$this->channel_type,true);
		$criteria->compare('appkey',$this->appkey,true);
		$criteria->compare('secretkey',$this->secretkey,true);
		$criteria->compare('token_create_time',$this->token_create_time);
		$criteria->compare('access_token',$this->access_token,true);
		$criteria->compare('expires_in',$this->expires_in);
		$criteria->compare('refresh_token',$this->refresh_token,true);
		$criteria->compare('re_expires_in',$this->re_expires_in);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('upd_time',$this->upd_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}