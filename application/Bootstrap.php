<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _iniLogger()
    {
    
        $this->bootstrap('log');
        Zend_Registry::set('logger', $this->getResource('log'));
    }


}

