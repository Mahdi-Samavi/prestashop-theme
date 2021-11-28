<?php

require_once _PS_MODULE_DIR_.'msnotification/classes/MsNotificationClass.php';

class msNotificationAjaxModuleFrontController extends ModuleFrontController
{
    public $ssl = true;

    public function initContent()
    {
        parent::initContent();
        if (Tools::getValue('action') == 'send_token') {
            $notification = new msNotificationClass();
            $notification->id_lang = Tools::getValue('id_lang');
            $notification->token = Tools::getValue('token');
            $notification->save();
            $result['r'] = true;
            die(json_encode($result));
        }
        Tools::redirect('index.php');
    }
}
