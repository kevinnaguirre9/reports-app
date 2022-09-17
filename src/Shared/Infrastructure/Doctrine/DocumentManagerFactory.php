<?php

namespace ReportsApp\Shared\Infrastructure\Doctrine;

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\SimplifiedXmlDriver;
use ReportsApp\Shared\Infrastructure\Doctrine\CustomTypes\CustomTypeRegistrar;
use ReportsApp\Shared\Infrastructure\Doctrine\CustomTypes\CustomTypesSearcher;
use ReportsApp\Shared\Infrastructure\Doctrine\Mappings\DoctrinePrefixesSearcher;
use MongoDB\Client;

/**
 * Class DocumentManagerFactory
 *
 * @package ReportsApp\Shared\Infrastructure\Doctrine
 */
final class DocumentManagerFactory
{
    /**
     * @return DocumentManager
     */
    public static function create() : DocumentManager
    {
        CustomTypeRegistrar::register(self::getCustomTypesToRegister());

        $dm = DocumentManager::create(self::createClient(), self::createConfiguration());

        $dm->getSchemaManager()->ensureIndexes();

        return $dm;
    }

    /**
     * @return Configuration
     */
    private static function createConfiguration() : Configuration
    {
        $config = new Configuration();

        $config->setHydratorDir(__DIR__.'/Hydrators');

        $config->setHydratorNamespace('ReportsApp\Shared\Infrastructure\Doctrine\Hydrators');

        $config->setMetadataDriverImpl(new SimplifiedXmlDriver(self::getContextPrefixes()));

        $config->setDefaultDB(config('database.connections.mongodb.database'));

        return $config;
    }

    /**
     * @return Client
     */
    private static function createClient() : Client
    {
        return new Client(
            config('database.connections.mongodb.uri'),
            [],
            ['typeMap' => DocumentManager::CLIENT_TYPEMAP]
        );
    }

    /**
     * @return array
     */
    private static function getCustomTypesToRegister() : array
    {
        return CustomTypesSearcher::inPath(
            __DIR__ . '/../../../Architecture/',
            'Architecture'
        );
    }

    /**
     * @return array
     */
    private static function getContextPrefixes() : array
    {
        return DoctrinePrefixesSearcher::inPath(
            __DIR__ . '/../../../Architecture/',
            'ReportsApp\Architecture'
        );
    }
}
