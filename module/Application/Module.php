<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\Navigation;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);


        $sm = $e->getApplication()->getServiceManager();

        // Add ACL information to the Navigation view helper
        $authorize = $sm->get('BjyAuthorize\Service\Authorize');
        $acl = $authorize->getAcl();
        $role = $authorize->getIdentity();
        Navigation::setDefaultAcl($acl);
        Navigation::setDefaultRole($role);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
