<?php

if (!defined('_PS_VERSION_'))
	exit;

class msSpecialSlider extends Module
{
	private $templatePath;

	public function __construct()
	{
		$this->name = 'msspecialslider';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Mahdi Samavi';
		$this->need_instance = 0;
		$this->bootstrap = true;

		parent::__construct();

		$this->displayName = $this->getTranslator()->trans('', array(), 'Modules.Msspecialslider.Admin');
		$this->description = $this->getTranslator()->trans('', array(), 'Modules.Msspecialslider.Admin');
		$this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
		$this->templatePath = 'module:'.$this->name.'/views/templates/hook/';
	}
	
	public function install()
	{
		if (
			!parent::install() ||
			!$this->registerHook('displayFullWidthTop1')
		) {
			return false;
		}
		return true;
	}
	
	public function uninstall()
	{
		return parent::uninstall();
	}
	
	public function hookDisplayFullWidthTop1()
	{
		return $this->fetch($this->templatePath.'specialslider.tpl');
	}
}
