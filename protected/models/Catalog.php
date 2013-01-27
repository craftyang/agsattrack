<?php

/**
 * This is the model class for table "catalog".
 *
 * The followings are the available columns in table 'catalog':
 * @property string $id
 * @property string $norad
 * @property string $multiple
 * @property string $payload
 * @property string $operationalstatus
 * @property string $name
 * @property string $owner
 * @property string $launchdate
 * @property string $site_id
 * @property string $decaydate
 * @property string $period
 * @property string $inclination
 * @property string $apogee
 * @property string $perigee
 * @property string $radarcrosssection
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Site $site
 */
class Catalog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catalog the static model class
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
		return 'catalog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, norad, launchdate, site_id, decaydate, radarcrosssection', 'length', 'max'=>20),
			array('multiple, payload, operationalstatus', 'length', 'max'=>1),
			array('name', 'length', 'max'=>40),
			array('owner, period, inclination, apogee, perigee, status', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, norad, multiple, payload, operationalstatus, name, owner, launchdate, site_id, decaydate, period, inclination, apogee, perigee, radarcrosssection, status', 'safe', 'on'=>'search'),
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
			'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'norad' => 'Norad',
			'multiple' => 'Multiple',
			'payload' => 'Payload',
			'operationalstatus' => 'Operationalstatus',
			'name' => 'Name',
			'owner' => 'Owner',
			'launchdate' => 'Launchdate',
			'site_id' => 'Site',
			'decaydate' => 'Decaydate',
			'period' => 'Period',
			'inclination' => 'Inclination',
			'apogee' => 'Apogee',
			'perigee' => 'Perigee',
			'radarcrosssection' => 'Radarcrosssection',
			'status' => 'Status',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('norad',$this->norad,true);
		$criteria->compare('multiple',$this->multiple,true);
		$criteria->compare('payload',$this->payload,true);
		$criteria->compare('operationalstatus',$this->operationalstatus,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('launchdate',$this->launchdate,true);
		$criteria->compare('site_id',$this->site_id,true);
		$criteria->compare('decaydate',$this->decaydate,true);
		$criteria->compare('period',$this->period,true);
		$criteria->compare('inclination',$this->inclination,true);
		$criteria->compare('apogee',$this->apogee,true);
		$criteria->compare('perigee',$this->perigee,true);
		$criteria->compare('radarcrosssection',$this->radarcrosssection,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}