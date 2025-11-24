<?php

namespace Alura\Doctrine\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;

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

        $consoleOutput = new ConsoleOutput(ConsoleOutput::VERBOSITY_DEBUG);
        $consoleLogger = new ConsoleLogger($consoleOutput);
        $logMiddleware = new Middleware($consoleLogger);
        $config->setMiddlewares([$logMiddleware]);

        $cacheDirectory =  __DIR__ . '/../../var/cache';
        $config->setMetadataCache(
            new PhpFilesAdapter(
                namespace: 'metadata_cache', 
                directory: $cacheDirectory
            )
        );

        $config->setMetadataCache(
            new PhpFilesAdapter(
                namespace: 'query_cache', 
                directory: $cacheDirectory
            )
        );

        $config->setMetadataCache(
            new PhpFilesAdapter(
                namespace: 'result_cache', 
                directory: $cacheDirectory
            )
        );

        // or if you prefer XML
        // $config = ORMSetup::createXMLMetadataConfig( // on PHP < 8.4, use ORMSetup::createXMLMetadataConfiguration()
        //    paths: [__DIR__ . '/config/xml'],
        //    isDevMode: true,
        //);
        // configuring the database connection
        $connection = DriverManager::getConnection([
            /* 'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db.sqlite', */
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'port' => '3306',
            'dbname' => "alura_teste",
            'user' => 'root',
            'pasword' => ''
        ], $config);
        // obtaining the entity manager
        return  new EntityManager($connection, $config);

    }

}