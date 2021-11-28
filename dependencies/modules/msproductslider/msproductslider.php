<?php

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

require_once _PS_MODULE_DIR_.'msproductslider/classes/MsProductSliderClass.php';

class msProductSlider extends Module implements WidgetInterface
{
    private $_html;
    private $record;
    public $fields_list;
    public $fields_form;
    public $fields_value;
    public $tabs;
    private $sort_by = array(
        array('id' => 1, 'name' => 'Date add: Desc'),
        array('id' => 2, 'name' => 'Date add: Asc'),
        array('id' => 3, 'name' => 'Date update: Desc'),
        array('id' => 4, 'name' => 'Date update: Asc'),
        array('id' => 5, 'name' => 'Product Name: A to Z'),
        array('id' => 6, 'name' => 'Product Name: Z to A'),
        array('id' => 7, 'name' => 'Price: Lowest first'),
        array('id' => 8, 'name' => 'Price: Highest first'),
        array('id' => 9, 'name' => 'Product ID: Asc'),
        array('id' => 10, 'name' => 'Product ID: Desc'),
        array('id' => 11, 'name' => 'Position: Desc'),
        array('id' => 12, 'name' => 'Position: Asc'),
    );
    public static $_hooks;

    public function __construct()
    {
        $this->name = 'msproductslider';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Mahdi Samavi';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->getTranslator()->trans('Product slider', array(), 'Modules.Msproductslider.Admin');
        $this->description = $this->getTranslator()->trans('', array(), 'Modules.Msproductslider.Admin');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);

        $this->tabs = array(
            array('id' => 0, 'name' => $this->getTranslator()->trans('General', array(), 'Modules.Msproductslider.Admin')),
            array('id' => 1, 'name' => $this->getTranslator()->trans('Other settings', array(), 'Modules.Msproductslider.Admin')),
            array('id' => 2, 'name' => $this->getTranslator()->trans('Homepage', array(), 'Modules.Msproductslider.Admin')),
        );
        
        self::$_hooks = array(
            array('id' => '', 'val' => '', 'name' => '', 'hook' => ''),
        );
    }

    public function install()
    {
        return parent::install() &&
            $this->installDB() &&
            $this->prepareHooks();
    }

    public function installDB()
    {
        $return = (bool)Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'msproductslider` (
                `id_msproductslider` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
                `display_on` varchar(10) DEFAULT NULL,
                `position` int(10) UNSIGNED NOT NULL DEFAULT 0,
                `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
                `next_prev` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
                `hide_nav_on_mob` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
                `control_nav` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
                `hide_control_nav_on_mob` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
                `btn_color` varchar(30) DEFAULT NULL,
                `btn_h_color` varchar(30) DEFAULT NULL,
                `btn_dis_color` varchar(30) DEFAULT NULL,
                `btn_bg_color` varchar(30) DEFAULT NULL,
                `btn_bg_h_color` varchar(30) DEFAULT NULL,
                `btn_dis_bg_color` varchar(30) DEFAULT NULL,
                `nav_color` varchar(30) DEFAULT NULL,
                `nav_h_color` varchar(30) DEFAULT NULL,
                `nav_act_color` varchar(30) DEFAULT NULL,
                `nav_act_h_color` varchar(30) DEFAULT NULL,
                `aw_display` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
                `title_align` tinyint(1) UNSIGNED NOT NULL DEFAULT 3,
                `title_font_size` int(10) UNSIGNED NOT NULL DEFAULT 12,
                `title_color` varchar(30) DEFAULT NULL,
                `title_h_color` varchar(30) DEFAULT NULL,
                PRIMARY KEY (`id_msproductslider`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        ');

        return $return;
    }

    public function prepareHooks()
    {
        foreach (self::$_hooks as $v) {
            $hook = 'display'.ucfirst($v['hook']);
            $id_hook = Hook::getIdByName($hook);
            if ($id_hook && Hook::getModulesFromHook($id_hook, $this->id))
                continue;
            if (!$this->isHookableOn($hook))
                $this->validation_errors[] = $this->getTranslator()->trans('This module cannot be transplanted to ', array(), 'Modules.Msthemeeditor.Admin').$hook;
            else
                $this->registerHook($hook, Shop::getContextListShopID());
        }
        Cache::clean('hook_module_list');
        return true;
    }

    public function uninstall()
    {
        return $this->uninstallDB() &&
            parent::uninstall();
    }
    
    public function uninstallDB()
    {
        return Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'msproductslider`');
    }

    public function getContent()
    {
        $this->context->controller->addCSS($this->_path.'views/css/admin.css');
        $this->context->controller->addJS(_MODULE_DIR_.'msthemeeditor/views/js/owl.carousel.min.js');
        $this->context->controller->addJS($this->_path.'views/js/admin.js');
        if (Tools::isSubmit('addproductslider')) {
            $helper = $this->initForm();
            return $this->_html.$this->initTab().$helper->generateForm($this->fields_form);
        } else {
            $this->record = msProductSliderClass::getAll();
            $helper = $this->initList();
            return $this->_html.$helper->generateList($this->record, $this->fields_list);
        }
    }

    public function initList()
    {
        $this->fields_list = array(
            'id_msproductslider' => array(
                'type' => 'text',
                'title' => $this->getTranslator()->trans('Id', array(), 'Modules.Msproductslider.Admin'),
                'align' => 'center',
                'width' => 120,
                'search' => false,
                'orderby' => false,
            ),
            'type' => array(
                'type' => 'text',
                'title' => $this->getTranslator()->trans('Type', array(), 'Modules.Msproductslider.Admin'),
                'align' => 'center',
                'width' => 200,
                'callback' => '',
                'callback_object' => '',
                'search' => false,
                'orderby' => false,
            ),
            'place' => array(
                'type' => 'text',
                'title' => $this->getTranslator()->trans('Show on', array(), 'Modules.Msproductslider.Admin'),
                'align' => 'center',
                'width' => 200,
                'callback' => '',
                'callback_object' => '',
                'search' => false,
                'orderby' => false,
            ),
            'position' => array(
                'type' => 'text',
                'title' => $this->getTranslator()->trans('Position', array(), 'Modules.Msproductslider.Admin'),
                'align' => 'center',
                'search' => false,
                'orderby' => false,
            ),
            'active' => array(
                'type' => 'bool',
                'title' => $this->getTranslator()->trans('Status', array(), 'Modules.Msproductslider.Admin'),
                'align' => 'center',
                'width' => 25,
                'active' => 'groupstatus',
                'search' => false,
                'orderby' => false,
            ),
        );

        $helper = new HelperList();
        $helper->shopLinkType = '';
        $helper->listTotal = count($this->record);
        $helper->simple_header = false;
        $helper->module = $this;
        $helper->identifier = '';
        $helper->actions = array('edit', 'delete');
        $helper->show_toolbar = true;
        $helper->imageType = 'jpg';
        $helper->toolbar_btn['new'] = array(
            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&addproductslider&token='.Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->getTranslator()->trans('Add a list', array(), 'Modules.Msproductslider.Admin'),
        );
        $helper->title = $this->getTranslator()->trans('', array(), 'Modules.Msproductslider.Admin');
        $helper->table = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        return $helper;
    }

    public function initForm()
    {
        $id_msproductslider = Tools::getValue('id_msproductslider');
        $productSlider = new msProductSliderClass($id_msproductslider);
        $btn_cancel = array(
            'type' => 'html',
            'name' => '<a class="btn btn-default btn-block fixed-width-md" href="'.AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'"><i class="icon-arrow-left"></i> '.$this->getTranslator()->trans('Back to list', array(), 'Modules.Msproductslider.Admin').'</a>',
        );
        $this->fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->getTranslator()->trans('Group configuration', array(), 'Modules.Msproductslider.Admin'),
                'icon' => 'icon-cogs',
            ),
            'input' => array(
                array(
                    'type' => 'select',
                    'name' => 'type',
                    'label' => $this->getTranslator()->trans('Category / Brand:', array(), 'Modules.Msproductslider.Admin'),
                    'required' => true,
                    'options' => array(
                        'optiongroup' => array(
                            'query' => $this->gets(),
                            'label' => 'name',
                        ),
                        'options' => array(
                            'query' => 'query',
                            'id' => 'id',
                            'name' => 'name',
                        ),
                        'default' => array(
                            'value' => '',
                            'label' => $this->getTranslator()->trans('Select a category or brand', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'name' => 'display_on',
                    'label' => $this->getTranslator()->trans('Display on:', array(), 'Modules.Msproductslider.Admin'),
                    'required' => true,
                    'values' => array(
                        'query' => self::$_hooks,
                        'id' => 'id',
                        'name' => 'name',
                    ),
                ),
                array(
                    'type' => 'text',
                    'name' => 'position',
                    'label' => $this->getTranslator()->trans('Position:', array(), 'Modules.Msproductslider.Admin'),
                    'default_value' => 0,
                    'class' => 'fixed-width-sm',
                ),
                array(
                    'type' => 'switch',
                    'name' => 'active',
                    'label' => $this->getTranslator()->trans('Status:', array(), 'Modules.Msproductslider.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'active_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'active_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                ),
                $btn_cancel,
            ),
            'buttons' => array(
                array(
                    'type' => 'submit',
                    'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
                    'icon' => 'process-icon-save',
                    'class' => 'pull-right',
                ),
            ),
            'submit' => array(
                'title' => $this->getTranslator()->trans('Save and stay', array(), 'Admin.Actions'),
                'stay' => true,
            ),
        );
        $this->fields_form[1]['form'] = array(
            'legend' => array(
                'title' => $this->getTranslator()->trans('Other settings', array(), 'Modules.Msproductslider.Admin'),
                'icon' => 'icon-cogs',
            ),
            'input' => array(
                array(
                    'type' => 'radio',
                    'name' => 'next_prev',
                    'label' => $this->getTranslator()->trans('Show Next/Prev buttons:', array(), 'Modules.Msproductslider.Admin'),
                    'default_value' => 1,
                    'values' => array(
                        array(
                            'id' => 'next_prev_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'next_prev_top_right',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Top right-hand side', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'next_prev_full_height',
                            'value' => 2,
                            'label' => $this->getTranslator()->trans('Full height', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'next_prev_full_height_hover',
                            'value' => 3,
                            'label' => $this->getTranslator()->trans('Full height, show out when mouseover', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'next_prev_square',
                            'value' => 4,
                            'label' => $this->getTranslator()->trans('Square', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'next_prev_square_hover',
                            'value' => 5,
                            'label' => $this->getTranslator()->trans('Square, show out when mouseover', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'next_prev_circle',
                            'value' => 6,
                            'label' => $this->getTranslator()->trans('Circle', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'next_prev_circle_hover',
                            'value' => 7,
                            'label' => $this->getTranslator()->trans('Circle, show out when mouseover', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'next_prev_arrow',
                            'value' => 8,
                            'label' => $this->getTranslator()->trans('Arrow', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'next_prev_arrow_hover',
                            'value' => 9,
                            'label' => $this->getTranslator()->trans('Arrow, show out when mouseover', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'validation' => 'isUnsignedInt',
                ),
                array(
                    'type' => 'switch',
                    'name' => 'hide_nav_on_mob',
                    'label' => $this->getTranslator()->trans('Hide Next/Prev buttons on small screen devices:', array(), 'Modules.Msproductslider.Admin'),
                    'default_value' => 1,
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'hide_nav_on_mob_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'hide_nav_on_mob_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'desc' => $this->getTranslator()->trans('Screen width < 992px.', array(), 'Modules.Msproductslider.Admin'),
                ),
                array(
                    'type' => 'radio',
                    'name' => 'control_nav',
                    'label' => $this->getTranslator()->trans('Show Next/Prev buttons:', array(), 'Modules.Msproductslider.Admin'),
                    'default_value' => 1,
                    'values' => array(
                        array(
                            'id' => 'control_nav_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'control_nav_1',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Bullets', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'control_nav_2',
                            'value' => 2,
                            'label' => $this->getTranslator()->trans('Number', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'control_nav_3',
                            'value' => 3,
                            'label' => $this->getTranslator()->trans('Round', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'validation' => 'isUnsignedInt',
                ),
                array(
                    'type' => 'switch',
                    'name' => 'hide_control_nav_on_mob',
                    'label' => $this->getTranslator()->trans('Hide navigation on small screen devices:', array(), 'Modules.Msproductslider.Admin'),
                    'default_value' => 0,
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'hide_control_nav_on_mob_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'hide_control_nav_on_mob_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'desc' => $this->getTranslator()->trans('Screen width < 992px.', array(), 'Modules.Msproductslider.Admin'),
                ),
                array(
                    'type' => 'color',
                    'name' => 'btn_color',
                    'label' => $this->getTranslator()->trans('Next/Prev buttons color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'btn_h_color',
                    'label' => $this->getTranslator()->trans('Next/Prev buttons hover color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'btn_dis_color',
                    'label' => $this->getTranslator()->trans('Next/Prev buttons disabled color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'btn_bg_color',
                    'label' => $this->getTranslator()->trans('Next/Prev buttons background color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'btn_bg_h_color',
                    'label' => $this->getTranslator()->trans('Next/Prev buttons hover background color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'btn_dis_bg_color',
                    'label' => $this->getTranslator()->trans('Next/Prev buttons disabled background color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'nav_color',
                    'label' => $this->getTranslator()->trans('Navigation color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'nav_h_color',
                    'label' => $this->getTranslator()->trans('Navigation hover color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'nav_act_color',
                    'label' => $this->getTranslator()->trans('Navigation active color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'nav_act_h_color',
                    'label' => $this->getTranslator()->trans('Navigation active hover color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'switch',
                    'name' => 'aw_display',
                    'label' => $this->getTranslator()->trans('Always display this block:', array(), 'Modules.Msproductslider.Admin'),
                    'default_value' => 1,
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'aw_display_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'aw_display_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'validation' => 'isBool',
                ),
                array(
                    'type' => 'radio',
                    'name' => 'title_align',
                    'label' => $this->getTranslator()->trans('Show Next/Prev buttons:', array(), 'Modules.Msproductslider.Admin'),
                    'default_value' => 1,
                    'values' => array(
                        array(
                            'id' => 'title_align_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'title_align_left',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Left', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'title_align_center',
                            'value' => 2,
                            'label' => $this->getTranslator()->trans('Center', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'title_align_right',
                            'value' => 3,
                            'label' => $this->getTranslator()->trans('Right', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'validation' => 'isUnsignedInt',
                ),
                array(
                    'type' => 'text',
                    'name' => 'title_font_size',
                    'label' => $this->getTranslator()->trans('Title size:', array(), 'Modules.Msproductslider.Admin'),
                    'class' => 'fixed-width-md',
                    'prefix' => 'px',
                    'desc' => $this->getTranslator()->trans('Set it to 0 to use the default value.', array(), 'Modules.Msproductslider.Admin'),
                    'validation' => 'isUnsignedInt',
                ),
                array(
                    'type' => 'color',
                    'name' => 'title_color',
                    'label' => $this->getTranslator()->trans('Title color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                array(
                    'type' => 'color',
                    'name' => 'title_h_color',
                    'label' => $this->getTranslator()->trans('Title hover color:', array(), 'Modules.Msproductslider.Admin'),
                    'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msproductslider.Admin'),
                    'size' => 33,
                ),
                $btn_cancel,
            ),
            'buttons' => array(
                array(
                    'type' => 'submit',
                    'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
                    'icon' => 'process-icon-save',
                    'class' => 'pull-right',
                ),
            ),
            'submit' => array(
                'title' => $this->getTranslator()->trans('Save and stay', array(), 'Admin.Actions'),
                'stay' => true,
            ),
        );
        $this->fields_form[2]['form'] = array(
            'legend' => array(
                'title' => $this->getTranslator()->trans('Other settings', array(), 'Modules.Msproductslider.Admin'),
                'icon' => 'icon-cogs',
            ),
            'input' => array(
                array(
                    'type' => 'radio',
                    'name' => 'display_method',
                    'label' => $this->getTranslator()->trans('How to display products:', array(), 'Modules.Msproductslider.Admin'),
                    'default_value' => 0,
                    'values' => array(
                        array(
                            'id' => 'display_method_slider',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('Slider', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'display_method_grid',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Grid view', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'display_method_simple',
                            'value' => 2,
                            'label' => $this->getTranslator()->trans('Simple layout', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'validation' => 'isUnsignedInt',
                ),
                array(
                    'type' => 'text',
                    'name' => 'nbr',
                    'label' => $this->getTranslator()->trans('Define the number of products to be displayed:', array(), 'Modules.Msproductslider.Admin'),
                    'class' => 'fixed-width-md',
                    'default_value' => 8,
                    'validation' => 'isUnsignedInt',
                ),
                array(
                    'type' => 'select',
                    'name' => 'sort',
                    'label' => $this->getTranslator()->trans('Sort by:', array(), 'Modules.Msproductslider.Admin'),
                    'options' => array(
                        'query' => $this->sort_by,
                        'id' => 'id',
                        'name' => 'name',
                    ),
                    'validation' => 'isUnsignedInt',
                ),
                array(
                    'type' => 'text',
                    'name' => 'spacing_between',
                    'label' => $this->getTranslator()->trans('Spacing between items:', array(), 'Modules.Msproductslider.Admin'),
                    'class' => 'fixed-width-md',
                    'prefix' => 'px',
                    'desc' => $this->getTranslator()->trans('Distance between items.', array(), 'Modules.Msproductslider.Admin'),
                    'validation' => 'isNullOrUnsignedId',
                ),
                array(
                    'type' => 'select',
                    'name' => 'img_type',
                    'label' => $this->getTranslator()->trans('Image type for products in Grid view and Slider:', array(), 'Modules.Msproductslider.Admin'),
                    'options' => array(
                        'query' => $this->imgType(),
                        'id' => 'id',
                        'name' => 'name',
                        'default' => array(
                            'value' => '',
                            'label' => $this->getTranslator()->trans('--', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'validation' => 'isGenericName',
                ),
                array(
                    'type' => 'switch',
                    'name' => 'loop',
                    'label' => $this->getTranslator()->trans('Loop:', array(), 'Modules.Msproductslider.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'loop_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'loop_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                ),
                array(
                    'type' => 'switch',
                    'name' => 'lazy_load',
                    'label' => $this->getTranslator()->trans('Lazy loading:', array(), 'Modules.Msproductslider.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'lazy_load_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'lazy_load_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                ),
                array(
                    'type' => 'radio',
                    'name' => 'autoplay',
                    'label' => $this->getTranslator()->trans('Autoplay:', array(), 'Modules.Msproductslider.Admin'),
                    'values' => array(
                        array(
                            'id' => 'autoplay_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'autoplay_once',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Once, has no effect in loop mode', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'autoplay_yes',
                            'value' => 2,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'validation' => 'isUnsignedInt',
                ),
                array(
                    'type' => 'switch',
                    'name' => 'auto_pause',
                    'label' => $this->getTranslator()->trans('Pause:', array(), 'Modules.Msproductslider.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'auto_pause_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'auto_pause_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'desc' => array(
                        $this->getTranslator()->trans('Pause on mouse hover.', array(), 'Modules.Msproductslider.Admin'),
                        $this->getTranslator()->trans('Works when "autoplay" is enabled.', array(), 'Modules.Msproductslider.Admin'),
                    ),
                ),
                array(
                    'type' => 'switch',
                    'name' => 'auto_rtl',
                    'label' => $this->getTranslator()->trans('RTL:', array(), 'Modules.Msproductslider.Admin'),
                    'tooltip' => $this->getTranslator()->trans('right to left', array(), 'Modules.Msproductslider.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'auto_rtl_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msproductslider.Admin'),
                        ),
                        array(
                            'id' => 'auto_rtl_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msproductslider.Admin'),
                        ),
                    ),
                    'desc' => $this->getTranslator()->trans('Slider rotation direction.', array(), 'Modules.Msproductslider.Admin'),
                ),
                array(
                    'type' => 'text',
                    'name' => 'auto_speed',
                    'label' => $this->getTranslator()->trans('Autoplay speed:', array(), 'Modules.Msproductslider.Admin'),
                    'class' => 'fixed-width-md',
                    'prefix' => 'ms',
                ),
                array(
                    'type' => 'text',
                    'name' => 'auto_timeout',
                    'label' => $this->getTranslator()->trans('Autoplay timeout:', array(), 'Modules.Msproductslider.Admin'),
                    'placeholder' => 'Default: 5000',
                    'class' => 'fixed-width-md',
                    'prefix' => 'ms',
                    'desc' => array(
                        $this->getTranslator()->trans('Autoplay interval timeout.', array(), 'Modules.Msproductslider.Admin'),
                        $this->getTranslator()->trans('the period, between the end of a transition effect and the start of the next one.', array(), 'Modules.Msproductslider.Admin'),
                    )
                ),
                $btn_cancel,
            ),
            'buttons' => array(
                array(
                    'type' => 'submit',
                    'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
                    'icon' => 'process-icon-save',
                    'class' => 'pull-right',
                ),
            ),
            'submit' => array(
                'title' => $this->getTranslator()->trans('Save and stay', array(), 'Admin.Actions'),
                'stay' => true,
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->id = (int)$productSlider->id;
        $helper->module = $this;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'savemsproductslider';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues($productSlider),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper;
    }

    public function getConfigFieldsValues($obj)
    {}

    public function gets()
    {
        $categories = $this->getCategories();
        foreach ($categories as &$category)
            $category['id'] = '1_'.$category['id'];
        $manufacturers = array();
        foreach (Manufacturer::getManufacturers(false, $this->context->language->id) as $mfr)
            $manufacturers[] = array('id' => '2_'.$mfr['id_manufacturer'], 'name' => $mfr['name']);
        $links = array(
            array('name' => $this->getTranslator()->trans('Category', array(), 'Modules.Msproductslider.Admin'), 'query' => $categories),
            array('name' => $this->getTranslator()->trans('Manufacturer', array(), 'Modules.Msproductslider.Admin'), 'query' => $manufacturers),
        );
        return $links;
    }

    public function getCategories()
    {
        $categories = array();
        $this->getCategoryOption($categories, Category::getRootCategory()->id);
        return $categories;
    }

    private function getCategoryOption(&$categories, $id_category = 1, $id_lang = false, $id_shop = false, $recursive = true, $selected_id_category = 0)
    {
        $id_lang = $id_lang ? (int)$id_lang : (int)Context::getContext()->language->id;
        $category = new Category((int)$id_category, (int)$id_lang, (int)$id_shop);
        if (is_null($category->id))
            return;
        if ($recursive) {
            $children = Category::getChildren((int)$id_category, (int)$id_lang, true, (int)$id_shop);
            $spacer = str_repeat('&nbsp;', 5 * (int)$category->level_depth);
        }
        $shop = (object)Shop::getShop($category->getShopID());
        $categories[] = array(
            'id' => $category->id,
            'name' => (isset($spacer) ? $spacer : '').$category->name.' ('.$shop->name.')',
        );
        if (isset($children) && count($children))
            foreach ($children as $child)
                $this->getCategoryOption($categories, (int)$child['id_category'], (int)$id_lang, (int)$child['id_shop'], $recursive, $selected_id_category);
    }

    private function imgType()
    {
        $img_types = array();
        foreach (ImageType::getImagesTypes('products') as $k => $imgType) {
            if (Tools::substr($imgType['name'], -3) == '_2x')
                continue;
            $img_types[] = array('id' => $imgType['name'], 'name' => $imgType['name'].' ('.$imgType['width'].'x'.$imgType['height'].')');
        }
        return $img_types;
    }

    public function initTab()
    {
        $html = '<div id="nav-bar"><div id="tabMenu" class="owl-carousel">';
        foreach($this->tabs as $t) {
            $html .= '<a href="javascript:;" title="'.$t['name'].'" data-fieldset="'.$t['id'].'">'.$t['name'].'</a>';
        }
        $html .= '</div><div id="dots-nav-bar"></div></div>';

        return $html;
    }

    public function renderWidget($hookName = null, array $configuration = [])
    {}

    public function getWidgetVariables($hookName = null, array $configuration = [])
    {}
}
