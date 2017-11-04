<?php
namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Zend\Cache\StorageFactory;

class AuthenticationServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('Config');
        return StorageFactory::factory($config['cache']);
    }
}