<?php

class msNewsletter extends Module
{
    public function __construct()
    {
        $this->name = 'msnewsletter';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Mahdi Samavi';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->getTranslator()->trans('Newsletter', array(), 'Modules.Msthemeeditor.Admin');
        $this->description = $this->getTranslator()->trans('', array(), 'Modules.Msthemeeditor.Admin');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        return parent::install();
    }

    public function uninstall()
    {
        return parent::uninstall();
    }
}
