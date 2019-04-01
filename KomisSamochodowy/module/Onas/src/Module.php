<?php
/**
 * Module Onas Zend Framework 3
 */
namespace Onas;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface {
    
    public function getConfig() {
        
        return include __DIR__ . '/../config/module.config.php';
    }  
} 