<?php

namespace Komis;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    // getConfig() and getServiceConfig() methods are here
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    // Add this method:
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\KomisController::class => function($container) {
                    return new Controller\KomisController(
                        $container->get(Model\KomisTable::class)
                    );
                },
            ],
        ];
    }
     // Add this method:
     public function getServiceConfig()
     {
         return [
             'factories' => [
                 Model\KomisTable::class => function($container) {
                     $tableGateway = $container->get(Model\KomisTableGateway::class);
                     return new Model\KomisTable($tableGateway);
                 },
                 Model\KomisTableGateway::class => function ($container) {
                     $dbAdapter = $container->get(AdapterInterface::class);
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Model\Komis());
                     return new TableGateway('komis', $dbAdapter, null, $resultSetPrototype);
                 },
             ],
         ];
     }
}