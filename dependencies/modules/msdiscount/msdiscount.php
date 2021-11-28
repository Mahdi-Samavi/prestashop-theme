<?php

// use PrestaShop\PrestaShop\Core\Product\ProductExtraContent;

class MsDiscount extends Module
{
    private $_html;
    public $fields_form;
    public $tabs;

    public function __construct()
    {
        $this->name = 'msdiscount';
        $this->tab = '';
        $this->version = '1.0.0';
        $this->author = 'Mahdi Samavi';
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('Discount', array(), 'Modules.Msdiscount.Admin');
        $this->description = $this->trans('', array(), 'Modules.Msdiscount.Admin');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);

        $this->tabs = array(
            array('id' => 0, 'icon' => 'icon-gears', 'name' => $this->trans('General settings', array(), 'Modules.Msdiscount.Admin')),
            array('id' => 1, 'icon' => '', 'name' => $this->trans('Product discount settings', array(), 'Modules.Msdiscount.Admin')),
            array('id' => 2, 'icon' => '', 'name' => $this->trans('Comment discount settings', array(), 'Modules.Msdiscount.Admin')),
        );
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('displayProductExtraContent') &&
            $this->registerHook('actionObjectAddAfter') &&
            $this->registerHook('actionObjectUpdateAfter');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function getContent()
    {
        $this->context->controller->addCSS($this->_path.'views/css/admin.css');
        $this->context->controller->addJS($this->_path.'views/js/admin.js');
        if (Tools::isSubmit('comment_lists')) {
            return $this->initList();
        }
        $helper = $this->initForm();
        return $this->_html.'<div class="row">'.$this->initTab().'<div class="col-xs-12 col-lg-9">'.$helper->generateForm($this->fields_form).'</div></div>';
    }

    public function initForm()
    {
        $this->fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->trans('Settings', array(), 'Modules.Msdiscount.Admin'),
                'icon' => 'icon-cogs',
            ),
            'input' => array(
                array(
                    'type' => '',
                    'name' => '',
                    'label' => $this->trans('', array(), 'Modules.Msdiscount.Admin'),
                ),
            ),
            'submit' => array(
                'title' => $this->trans('Save', array(), 'Admin.Actions'),
            ),
        );
        $this->fields_form[1]['form'] = array(
            'legend' => array(
                'title' => $this->trans('Product discount settings', array(), 'Modules.Msdiscount.Admin'),
                'icon' => 'icon-cogs',
            ),
            'input' => array(
                array(
                    'type' => '',
                    'name' => '',
                    'label' => $this->trans('', array(), 'Modules.Msdiscount.Admin'),
                ),
            ),
            'submit' => array(
                'title' => $this->trans('Save', array(), 'Admin.Actions'),
            ),
        );
        $this->fields_form[2]['form'] = array(
            'legend' => array(
                'title' => $this->trans('Comment discount settings', array(), 'Modules.Msdiscount.Admin'),
                'icon' => 'icon-cogs',
            ),
            'input' => array(
                // if using the own comment module
                array(
                    'type' => 'switch',
                    'name' => '',
                    'label' => $this->trans(':', array(), 'Modules.Msdiscount.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => '_yes',
                            'value' => 1,
                            'label' => $this->trans('Yes', array(), 'Modules.Msdiscount.Admin'),
                        ),
                        array(
                            'id' => '_no',
                            'value' => 0,
                            'label' => $this->trans('No', array(), 'Modules.Msdiscount.Admin'),
                        ),
                    ),
                ),
                // select your comment module
                array(
                    'type' => 'select',
                    'name' => 'module',
                    'label' => $this->trans('Which module:', array(), 'Modules.Msdiscount.Admin'),
                    'options' => array(
                        'query' => $this->getModules(),
                        'id' => 'id',
                        'name' => 'name',
                    ),
                ),
            ),
            'submit' => array(
                'title' => $this->trans('Save', array(), 'Admin.Actions'),
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->module = $this;
        $helper->table = 'msdiscount';
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'savemsdiscount';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper;
    }

    public function initList()
    {
        $res = '';
        $res .= $this->helperList()->generateList(array(), $this->approval());
        $res .= $this->helperList()->generateList(array(), $this->approved());
        $res .= $this->helperList()->generateList(array(), $this->reported());
        return $res;
    }

    public function getConfigFieldsValues()
    {
        $res = array();
        return $res;
    }

    private function approval()
    {
        return array(
            '' => array(),
        );
    }

    private function approved()
    {
        return array(
            '' => array(),
        );
    }

    private function reported()
    {
        return array(
            '' => array(),
        );
    }

    public function helperList()
    {
        $helper = new HelperList();
        $helper->shopLinkType = '';
        $helper->listTotal = '';

        $helper->simple_header = false;
        $helper->module = $this;
        $helper->identifier = '';
        $helper->actions = array();
        $helper->show_toolbar = true;
        $helper->imageType = 'jpg';
        $helper->title = '';
        $helper->table = '';
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        return $helper;
    }

    private function getModules()
    {
        $res = array();
        foreach (self::getModulesInstalled() as $v)
            if ($v['name'] != $this->name)
                $res[] = array('id' => $v['name'], 'name' => self::getInstanceByName($v['name'])->displayName ?: $v['name']);

        return $res;
    }

    public function initTab()
    {
        $html = '<div id="nav-bar" class="col-xs-12 col-lg-3"><ul id="tabMenu" class="nav">';
        foreach($this->tabs as $t) {
            $html .= '<li><a href="javascript:;" title="'.$t['name'].'" data-fieldset="'.$t['id'].'">'.($t['icon'] ? '<i class="'.$t['icon'].'"></i>&nbsp' : '').$t['name'].'</a></li>';
        }
        $html .= '</ul><a href="'.AdminController::$currentIndex.'&configure='.$this->name.'&comment_lists&token='.Tools::getAdminTokenLite('AdminModules').'" class="btn btn-primary">'.$this->trans('Comment lists', array(), 'Modules.Msdiscount.Admin').'</a></div>';

        return $html;
    }

    public function hookDisplayProductExtraContent($params)
    {
        /*$extraContent = new ProductExtraContent();
        $extraContent->setTitle('title')->setContent('content');
        file_put_contents($this->local_path.'lll.txt', print_r(get_object_vars($extraContent), true));
        return array($extraContent);*/
    }

    public function hookActionObjectAddAfter($params)
    {
        return $this->objectControl($params);
    }

    public function hookActionObjectUpdateAfter($params)
    {
        return $this->objectControl($params);
    }

    public function objectControl($params)
    {
        $reflection = new ReflectionObject($params['object']);
        if (strpos($reflection->getFileName(), 'msdicount') === false)
            return false;
        file_put_contents($this->local_path.'lll.txt', print_r(get_object_vars($params['object']), true));
        return true;
    }
}
