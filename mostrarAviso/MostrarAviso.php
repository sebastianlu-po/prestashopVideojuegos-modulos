<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class MostrarAviso extends Module{

    public function __construct(){
        $this->name = 'mostrarAviso';
        $this -> tab = 'front_office_features';
        $this -> version = '1.0.0';
        $this -> author = 'Sebastián Luna';

        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '8.0.0',
            'max' => '9.99.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('mostrarAviso', [], 'Modules.Mymodule.Admin');
        $this->description = $this->trans('Muestra avisos sobre cualquier vista de nuestra tienda', [], 'Modules.Mymodule.Admin');

        $this->confirmUninstall = $this->trans('¿Está seguro que quiere desinstalar?', [], 'Modules.Mymodule.Admin');

        if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->trans('Ningún nombre dado', [], 'Modules.Mymodule.Admin');
        }


    }

    public function install(){

    if (Shop::isFeatureActive()) {
        Shop::setContext(Shop::CONTEXT_ALL);
    }

   return (
        parent::install() 
        && Configuration::updateValue('MYMODULE_NAME', 'mostrarAviso')

    ); 
    }

    public function uninstall(){
        return (
            parent::uninstall() 
            && Configuration::deleteByName('MYMODULE_NAME')
        );
    }



}