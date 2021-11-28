<?php
/*
* 2007-2017 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    ST-themes <hellolee@gmail.com>
*  @copyright 2007-2017 ST-themes
*  @license   Use, by you or one client for one Prestashop instance.
*/

if (!defined('_PS_VERSION_'))
	exit;

class msBanner extends Module
{
	private $templatePath;

	public function __construct()
	{
		$this->name = 'msbanner';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Mahdi Samavi';
		$this->need_instance = 0;
		$this->bootstrap = true;
		
		parent::__construct();
		
		$this->displayName = $this->getTranslator()->trans('Advanced banner', array(), 'Modules.Msbanner.Admin');
		$this->description = $this->getTranslator()->trans('', array(), 'Modules.Msbanner.Admin');
		$this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
		$this->templatePath = 'module:'.$this->name.'/views/templates/hook/';
	}

	public function install()
	{
		if (
			!parent::install() ||
			!$this->registerHook('displayHomeTop')
		) {
			return false;
		}
		return true;
	}

	public function uninstall()
	{
		return parent::uninstall();
	}
	
	public function hookDisplayHomeTop()
	{
		return $this->fetch($this->templatePath.'banner.tpl');
	}
}
