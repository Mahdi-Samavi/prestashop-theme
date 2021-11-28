<?php

class msProductSliderClass extends ObjectModel
{
	/** @var integer */
    public $id;
    /** @var integer */
	public $id_msproductslider;
	/** @var integer */
	public $type;
	/** @var  */
	public $place;
	/**
     * @see ObjectModel::$definition
     */
	public static $definition = array(
		'table' => 'msproductslider',
		'primary' => 'id_msproductslider',
		'fields' => array(
			'type' => array(),
			'place' => array(),
		),
	);
	
	public static function getAll()
	{
		return Db::getInstance()->executeS('
			SELECT * FROM `'._DB_PREFIX_.'msproductslider`
		');
	}
}
