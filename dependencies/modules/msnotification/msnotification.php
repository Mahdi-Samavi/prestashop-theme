<?php

require_once _PS_MODULE_DIR_.'msnotification/classes/MsNotificationClass.php';

class msNotification extends Module
{
    private $_html;
    private $config;
    private $using = array();
    public $fields_list;
    public $fields_form;
    public $fields_value;
    public $tabs;
    private $hooks = array(
        'header',
        'actionObjectUpdateBefore',
        'actionProductAdd',
        'actionProductUpdate',
        'actionProductSave',
    );
    private $attr = array();

    public function __construct()
    {
        $this->name = 'msnotification';
        $this->tab = 'social_networks';
        $this->version = '1.0.0';
        $this->author = 'Mahdi Samavi';
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->getTranslator()->trans('Notification', array(), 'Modules.Msnotification.Admin');
        $this->description = $this->getTranslator()->trans('', array(), 'Modules.Msnotification.Admin');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->controllers = array('ajax');

        $this->tabs = array(
            array('id' => 0, 'name' => $this->getTranslator()->trans('General settings', array(), 'Modules.Msnotification.Admin')),
            array('id' => 1, 'name' => $this->getTranslator()->trans('Other settings', array(), 'Modules.Msnotification.Admin')),
            array('id' => 2, 'name' => $this->getTranslator()->trans('Send message', array(), 'Modules.Msnotification.Admin')),
        );

        $this->config = array(
            'sender_id' => '',
            'server_key' => '',
            'config' => '',
            'using' => 1,
            'display_price' => [1 => 'Old price: {O}, New price: {N}'],
            'using_img' => 2,
            'status' => 1,
            'title' => [1 => ''],
            'body' => [1 => ''],
            'link' => [1 => ''],
            'img_url' => [1 => ''],
            'all_langs' => 1,
        );

        $this->using = array(
            array('id' => 1, 'val' => 1, 'name' => 'After adding/updating the product'),
            array('id' => 2, 'val' => 2, 'name' => 'After adding the category'),
        );
    }

    public function install()
    {
        return parent::install() &&
            $this->installDB() &&
            $this->installConfig() &&
            $this->registers();
    }

    public function installDB()
    {
        return (bool)Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'msnotification` (
                `id_msnotification` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `id_lang` int(10) UNSIGNED NOT NULL,
                `token` varchar(255) NOT NULL,
                PRIMARY KEY (`id_msnotification`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
        ');
    }

    public function installConfig()
    {
        $res = true;
        foreach ($this->config as $k => $v)
            $res &= (bool)Configuration::updateValue('MS_'.strtoupper($k), $v);
        return $res;
    }

    public function registers()
    {
        $res = true;
        foreach ($this->hooks as $v)
            $res &= $this->registerHook($v);
        return $res;
    }

    public function uninstall()
    {
        return $this->uninstallDB() &&
            $this->uninstallConfig() &&
            $this->unregisters() &&
            parent::uninstall();
    }

    public function uninstallDB()
    {
        return Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'msnotification`');
    }

    public function uninstallConfig()
    {
        foreach ($this->config as $k => $v)
            if (!Configuration::deleteByName('MS_'.strtoupper($k)))
                return false;
        return true;
    }

    public function unregisters()
    {
        $res = true;
        foreach ($this->hooks as $v)
            $res &= $this->unregisterHook($v);
        return $res;
    }

    public function getContent()
    {
        $this->context->controller->addCSS($this->_path.'views/css/admin.css');
        $this->context->controller->addJS($this->_path.'views/js/admin.js');
        if (Tools::getValue('act') == 'send_message' && $data = Tools::getValue('data')) {
            $id_lang = 0;
            $all_langs = Tools::getValue('all_langs');
            $data = json_decode($data);
            foreach ($data as $k => $v)
                if ($v->is_default)
                    $id_lang = $k;
            foreach ($data as $k => $v) {
                $token = array();
                foreach (msNotificationClass::get('token', '`id_lang` = '.$v->id_lang) as $val)
                    $token[] = $val['token'];
                $this->sendNotification($token, array(
                    'title' => ($all_langs && !$v->title ? $data[$id_lang]->title : $v->title),
                    'body' => ($all_langs && !$v->body ? $data[$id_lang]->body : $v->body),
                    'image' => ($all_langs && !$v->image ? $data[$id_lang]->image : $v->image),
                    'click_action' => ($all_langs && !$v->url ? $data[$id_lang]->url : $v->url),
                ));
            }
            die(true);
        }
        if (Tools::isSubmit('savemsnotification')) {
            $errors = array();
            if (!Tools::getValue('sender_id'))
                $errors[] = $this->displayError($this->getTranslator()->trans('The field "Sender id" is required', array(), 'Modules.Msnotification.Admin'));
            if (!Tools::getValue('server_key'))
                $errors[] = $this->displayError($this->getTranslator()->trans('The field "Server key" is required', array(), 'Modules.Msnotification.Admin'));
            if (!Tools::getValue('config'))
                $errors[] = $this->displayError($this->getTranslator()->trans('The field "Config" is required', array(), 'Modules.Msnotification.Admin'));
            $using = 0;
            foreach ($this->using as $v)
                $using += (int)Tools::getValue('using_'.$v['id']);
            if (!$using)
                $errors[] = $this->displayError($this->getTranslator()->trans('The field "Which to use" is required', array(), 'Modules.Msnotification.Admin'));
            Configuration::updateValue('MS_USING', $using);
            if (!count($errors))
                if ($this->save())
                    $this->_html .= $this->displayConfirmation($this->getTranslator()->trans('Notification saved', array(), 'Modules.Msnotification.Admin'));
                else
                    $this->_html .= $this->displayError($this->getTranslator()->trans('An error occurred during slideshow saving', array(), 'Modules.Msnotification.Admin'));
            else
                $this->_html .= implode('', $errors);
        }
        Media::addJsDef(array(
            'module_name' => $this->name,
        ));
        $helper = $this->initForm();
        return $this->_html.'<div class="row">'.$this->initTab().'<div class="col-xs-12 col-lg-10">'.$helper->generateForm($this->fields_form).'</div></div>';
    }

    public function initForm()
    {
        $users = msNotificationClass::get();
        $this->fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->getTranslator()->trans('Settings', array(), 'Modules.Msnotification.Admin'),
                'icon' => 'icon-cogs',
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'name' => 'sender_id',
                    'label' => $this->getTranslator()->trans('Sender id:', array(), 'Modules.Msnotification.Admin'),
                    'class' => 'fixed-width-md',
                    'size' => 15,
                    'required' => true,
                ),
                array(
                    'type' => 'textarea',
                    'name' => 'server_key',
                    'label' => $this->getTranslator()->trans('Server key:', array(), 'Modules.Msnotification.Admin'),
                    'rows' => 1,
                    'required' => true,
                ),
                array(
                    'type' => 'textarea',
                    'name' => 'config',
                    'label' => $this->getTranslator()->trans('Config:', array(), 'Modules.Msnotification.Admin'),
                    'cols' => 80,
                    'rows' => 10,
                    'required' => true,
                ),
            ),
            'submit' => array(
                'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
            ),
        );
        $this->fields_form[1]['form'] = array(
            'legend' => array(
                'title' => $this->getTranslator()->trans('Settings', array(), 'Modules.Msnotification.Admin'),
                'icon' => 'icon-cogs',
            ),
            'input' => array(
                array(
                    'type' => 'checkbox',
                    'name' => 'using',
                    'label' => $this->getTranslator()->trans('Which to use:', array(), 'Modules.Msnotification.Admin'),
                    'required' => true,
                    'values' => array(
                        'query' => $this->using,
                        'id' => 'id',
                        'name' => 'name',
                    ),
                ),
                array(
                    'type' => 'text',
                    'name' => 'display_price',
                    'label' => $this->getTranslator()->trans('Price display:', array(), 'Modules.Msnotification.Admin'),
                    'desc' => array(
                        '{O}: '.$this->getTranslator()->trans('Old price', array(), 'Modules.Msnotification.Admin'),
                        '{N}: '.$this->getTranslator()->trans('New price', array(), 'Modules.Msnotification.Admin'),
                    ),
                    'lang' => true,
                ),
                array(
                    'type' => 'radio',
                    'name' => 'using_img',
                    'label' => $this->getTranslator()->trans('Using image', array(), 'Modules.Msnotification.Admin'),
                    'values' => array(
                        array(
                            'id' => 'using_img',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msnotification.Admin'),
                        ),
                        array(
                            'id' => 'using_img_shop',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Use store logo', array(), 'Modules.Msnotification.Admin'),
                        ),
                        array(
                            'id' => 'using_img_option',
                            'value' => 2,
                            'label' => $this->getTranslator()->trans('Photo of "Which to use" option', array(), 'Modules.Msnotification.Admin'),
                        ),
                    ),
                    'desc' => $this->getTranslator()->trans('', array(), 'Modules.Msnotification.Admin'),
                ),
                array(
                    'type' => 'switch',
                    'name' => 'status',
                    'label' => $this->getTranslator()->trans('Status:', array(), 'Modules.Msnotification.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'status_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msnotification.Admin'),
                        ),
                        array(
                            'id' => 'status_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msnotification.Admin'),
                        ),
                    ),
                    'validation' => 'isBool',
                ),
            ),
            'submit' => array(
                'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
            ),
        );
        $this->fields_form[2]['form'] = array(
            'legend' => array(
                'title' => $this->getTranslator()->trans('Send custom message', array(), 'Modules.Msnotification.Admin'),
                'icon' => 'icon-cogs',
            ),
            'description' => $this->getTranslator()->trans('Number of users: ', array(), 'Modules.Msnotification.Admin').count($users),
            'input' => array(
                array(
                    'type' => 'text',
                    'name' => 'title',
                    'label' => $this->getTranslator()->trans('Title:', array(), 'Modules.Msnotification.Admin'),
                    'required' => true,
                    'lang' => true,
                ),
                array(
                    'type' => 'text',
                    'name' => 'body',
                    'label' => $this->getTranslator()->trans('Body:', array(), 'Modules.Msnotification.Admin'),
                    'required' => true,
                    'lang' => true,
                ),
                array(
                    'type' => 'text',
                    'name' => 'link',
                    'label' => $this->getTranslator()->trans('Link:', array(), 'Modules.Msnotification.Admin'),
                    'lang' => true,
                ),
                array(
                    'type' => 'text',
                    'name' => 'img_url',
                    'label' => $this->getTranslator()->trans('Image url:', array(), 'Modules.Msnotification.Admin'),
                    'lang' => true,
                ),
                array(
                    'type' => 'switch',
                    'name' => 'all_langs',
                    'label' => $this->getTranslator()->trans('Send original language value:', array(), 'Modules.Msnotification.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'all_langs_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msnotification.Admin'),
                        ),
                        array(
                            'id' => 'all_langs_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msnotification.Admin'),
                        ),
                    ),
                    'desc' => $this->getTranslator()->trans('Uses the original language value if it does not value any other languages.', array(), 'Modules.Msnotification.Admin'),
                ),
            ),
            'submit' => array(
                'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
            ),
        );

        if (
            !Configuration::get('MS_SENDER_ID') ||
            !Configuration::get('MS_SERVER_KEY') ||
            !Configuration::get('MS_CONFIG')
        ) {
            $this->fields_form[2]['form']['input'][] = array(
                'type' => 'warning',
                'name' => '',
                'detail' => $this->getTranslator()->trans('Please complete General settings tab and save it.', array(), 'Modules.Msnotification.Admin'),
            );
        } else {
            $this->fields_form[2]['form']['input'][] = array(
                'type' => 'button',
                'name' => 'send_message',
                'label' => '',
                'title' => $this->getTranslator()->trans('Send', array(), 'Modules.Msnotification.Admin'),
                'icon' => 'icon-send',
            );
        }

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->module = $this;
        $helper->table = 'msnotification';
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'savemsnotification';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );
        foreach ($this->using as $v)
            $helper->tpl_vars['fields_value']['using_'.$v['id']] = (int)$v['val']&(int)Configuration::get('MS_USING');

        return $helper;
    }

    public function getConfigFieldsValues()
    {
        $res = array();
        foreach ($this->config as $k => $v)
            $res[$k] = Tools::getValue($k, Configuration::get('MS_'.strtoupper($k)));
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $res['display_price'][$lang['id_lang']] = Configuration::get('MS_DISPLAY_PRICE', $lang['id_lang']);
            $res['title'][$lang['id_lang']] = Configuration::get('MS_TITLE', $lang['id_lang']);
            $res['body'][$lang['id_lang']] = Configuration::get('MS_BODY', $lang['id_lang']);
            $res['link'][$lang['id_lang']] = Configuration::get('MS_LINK', $lang['id_lang']);
            $res['img_url'][$lang['id_lang']] = Configuration::get('MS_IMG_URL', $lang['id_lang']);
        }
        return $res;
    }

    public function initTab()
    {
        $html = '<div id="nav-bar" class="col-xs-12 col-lg-2"><ul id="tabMenu" class="nav">';
        foreach($this->tabs as $t) {
            $html .= '<li><a href="javascript:;" title="'.$t['name'].'" data-fieldset="'.$t['id'].'">'.$t['name'].'</a></li>';
        }
        $html .= '</ul><div id="dots-nav-bar"></div></div>';

        return $html;
    }

    private function save()
    {
        $res = true;
        foreach ($this->config as $k => $v) {
            if ($k == 'using')
                continue;
            $res &= Configuration::updateValue('MS_'.strtoupper($k), Tools::getValue($k));
        }
        $languages = Language::getLanguages(false);
        $default_lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $display_price = $title = $body = $link = $img_url = array();
        foreach ($languages as $lang) {
            $display_price[$lang['id_lang']] = Tools::getValue('display_price_'.$lang['id_lang']) ? Tools::getValue('display_price_'.$lang['id_lang']) : Tools::getValue('display_price_'.$default_lang->id);
            $title[$lang['id_lang']] = Tools::getValue('title_'.$lang['id_lang']) ? Tools::getValue('title_'.$lang['id_lang']) : Tools::getValue('title_'.$default_lang->id);
            $body[$lang['id_lang']] = Tools::getValue('body_'.$lang['id_lang']) ? Tools::getValue('body_'.$lang['id_lang']) : Tools::getValue('body_'.$default_lang->id);
            $link[$lang['id_lang']] = Tools::getValue('link_'.$lang['id_lang']) ? Tools::getValue('link_'.$lang['id_lang']) : Tools::getValue('link_'.$default_lang->id);
            $img_url[$lang['id_lang']] = Tools::getValue('img_url_'.$lang['id_lang']) ? Tools::getValue('img_url_'.$lang['id_lang']) : Tools::getValue('img_url_'.$default_lang->id);
        }
        Configuration::updateValue('MS_DISPLAY_PRICE', $display_price);
        Configuration::updateValue('MS_TITLE', $title);
        Configuration::updateValue('MS_BODY', $body);
        Configuration::updateValue('MS_LINK', $link);
        Configuration::updateValue('MS_IMG_URL', $img_url);
        $config = Tools::getValue('config').file_get_contents($this->local_path.'views/js/config.js');
        file_put_contents($this->local_path.'views/js/notification.js', $config);
        return $res;
    }

    public function hookHeader()
    {
        if (!Configuration::get('MS_STATUS'))
            return false;
        if (!file_exists(_PS_ROOT_DIR_.'/firebase-messaging-sw.js'))
            $this->writeSW();
        $this->context->controller->registerJavascript('firebase-app', $this->context->link->protocol_content.'www.gstatic.com/firebasejs/7.8.2/firebase-app.js', ['server' => 'remote']);
        $this->context->controller->registerJavascript('firebase-messaging', $this->context->link->protocol_content.'www.gstatic.com/firebasejs/7.8.2/firebase-messaging.js', ['server' => 'remote']);
        $this->context->controller->registerJavascript('firebase-auth', $this->context->link->protocol_content.'www.gstatic.com/firebasejs/7.8.2/firebase-auth.js', ['server' => 'remote']);
        $this->context->controller->addJS($this->_path.'views/js/notification.js');
    }

    public function hookActionCategoryAdd($params)
    {
        if (!(2&(int)Configuration::get('MS_USING')) || !Configuration::get('MS_STATUS'))
            return true;
        $params = $params['category'];
        $id_shop = (int)Context::getContext()->shop->id;
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $token = array();
            foreach (msNotificationClass::get('token', 'id_lang = '.$lang['id_lang']) as $v)
                $token[] = $v['token'];

            $category = new Category($params->id, $lang['id_lang'], $id_shop);
            $this->sendNotification($token, array(
                'title' => $category->name,
                'body' => Tools::getDescriptionClean($category->description),
                'image' => $this->getImageUrl($category, $id_shop),
                'click_action' => $category->getLink(),
            ));
        }
    }

    public function hookActionObjectUpdateBefore($params)
    {
        if (!Configuration::get('MS_STATUS'))
            return false;
        $params = $params['object'];
        if (get_class($params) != 'Product')
            return false;
        $fields = (new Product($params->id))->getFieldsShop();
        $this->attr['old_price'] = $fields['price'];
        $this->attr['new_price'] = $params->price;
    }

    public function hookActionProductSave()
    {
        if (!(1&(int)Configuration::get('MS_USING')) || !Configuration::get('MS_STATUS'))
            return true;

        $id_shop = (int)Context::getContext()->shop->id;
        $id_product = (int)Tools::getValue('id_product');
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $token = array();
            foreach (msNotificationClass::get('token', 'id_lang = '.$lang['id_lang']) as $v)
                $token[] = $v['token'];

            $product = new Product($id_product, false, $lang['id_lang'], $id_shop);
            $body = '';
            if ($this->attr['old_price'] != $this->attr['new_price']) {
                $symbol = array('{O}', '{N}');
                $price = array(Tools::displayPrice($this->attr['old_price']), Tools::displayPrice($this->attr['new_price']));
                $body = ' '.str_replace($symbol, $price, Configuration::get('MS_DISPLAY_PRICE', $lang['id_lang'], null, $id_shop));
            }
            $this->sendNotification($token, array(
                'title' => $product->name,
                'body' => Tools::getDescriptionClean($product->description_short).$body,
                'image' => $this->getImageUrl($product, $id_shop),
                'click_action' => $product->getLink(),
            ));
        }
    }

    public function getImageUrl($o, $id_shop)
    {
        $img = Configuration::get('MS_USING_IMG');
        $img_url = '';
        if ($img == 2) {
            $images = Product::getCover($o->id);
            $img_url = (get_class($o) == 'Category') ?
                $this->context->link->getCatImageLink($o->name, $o->id) :
                $this->context->link->getImageLink($o->link_rewrite, $images['id_image'], ImageType::getFormattedName('home'));
        }
        return ($img == 1 ? _PS_IMG_.Configuration::get('PS_LOGO', null, null, $id_shop) : $img_url);
    }

    private function writeSW()
    {
        $js = 'importScripts(\'https://www.gstatic.com/firebasejs/4.8.1/firebase-app.js\');importScripts(\'https://www.gstatic.com/firebasejs/4.8.1/firebase-messaging.js\');'
            .'firebase.initializeApp({messagingSenderId:\''.Configuration::get('MS_SENDER_ID').'\'});'
            .'const messaging=firebase.messaging();'
            .'messaging.setBackgroundMessageHandler(function(payload){'
            .'console.log(\'[firebase-messaging-sw.js] Received background message \', payload);'
            .'var notificationTitle=\'Background Message Title\';'
            .'var notificationOptions={body:\'Background Message body.\',icon:\'/firebase-logo.png\'};'
            .'return self.registration.showNotification(notificationTitle,notificationOptions)});';
        file_put_contents(_PS_ROOT_DIR_.'/firebase-messaging-sw.js', $js);
    }

    public function sendNotification($to = array(), $data = array())
    {
        $fields = array('registration_ids' => $to, 'notification' => $data);
        $headers = array('Authorization: key='.Configuration::get('MS_SERVER_KEY'), 'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_exec($ch);
        curl_close($ch);
    }
}
