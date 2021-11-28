<?php

class msNotificationClass extends ObjectModel
{
    /** @var integer */
    public $id;
    /** @var integer */
    public $id_lang;
    /** @var string */
    public $token;
    /**
    * @see ObjectModel::$definition
    */
    public static $definition = array(
        'table' => 'msnotification',
        'primary' => 'id_msnotification',
        'fields' => array(
            'id_lang' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'token' => array('type' => self::TYPE_STRING, 'validate' => 'isAnything'),
        ),
    );

    public function __construct($id = null, $id_lang = null, $id_shop = null)
    {
        parent::__construct($id, $id_lang, $id_shop);
    }

    public static function get($select = '*', $where = '')
    {
        return Db::getInstance()->executeS('SELECT '.$select.' FROM `'._DB_PREFIX_.'msnotification`'.($where ? ' WHERE '.$where : ''));
    }
}
