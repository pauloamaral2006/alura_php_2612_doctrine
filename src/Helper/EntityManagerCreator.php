<?php

namespace Alura\Doctrine\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerCreator
{

    public static function createEntityManager() : EntityManager
    {

        // Create a simple "default" Doctrine ORM configuration for Attributes
        $config = ORMSetup::createAttributeMetadataConfig( // on PHP < 8.4, use ORMSetup::createAttributeMetadataConfiguration()
            paths: [__DIR__ . '/..'],
            isDevMode: true,

        );
        
        // Define o namespace dos proxies
        $config->setProxyNamespace('Alura\\Doctrine\\Proxies');

        // Configura o diretório explicitamente (opcional, mas recomendado)
        $config->setProxyDir(__DIR__ . '/src/Proxies');

        // or if you prefer XML
        // $config = ORMSetup::createXMLMetadataConfig( // on PHP < 8.4, use ORMSetup::createXMLMetadataConfiguration()
        //    paths: [__DIR__ . '/config/xml'],
        //    isDevMode: true,
        //);
        // configuring the database connection
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db.sqlite',
        ], $config);
        // obtaining the entity manager
        return  new EntityManager($connection, $config);

    }

}