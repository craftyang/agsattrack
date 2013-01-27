<?php
class Catalog extends ActiveRecord\Model {

	static $belongs_to = array(
		array('site')
	);
}