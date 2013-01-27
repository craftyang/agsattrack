<?php

/**
 * This is the model class for table "tlegroups".
 *
 * The followings are the available columns in table 'tlegroups':
 * @property string $id
 * @property string $name
 * @property integer $default
 */
class Tlegroups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tlegroups the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'tlegroups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('default', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>100),
			array('name', 'length', 'max'=>255),
			array('id, name, default', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'default' => 'Default',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('default',$this->default);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}