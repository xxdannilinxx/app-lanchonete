<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Proxy\AbstractProxyFactory,
    Doctrine\ORM\Mapping\Driver\DatabaseDriver,
    Doctrine\ORM\Tools\DisconnectedClassMetadataFactory,
    Doctrine\ORM\Tools\EntityGenerator;

class Doctrine
{

    public $em = false;

    public function __construct()
    {
        require_once FCPATH . 'vendor/autoload.php';

        $loader = new ClassLoader('DoctrineOverWrite', APPPATH . 'libraries');
        $loader->register();

        $entityClassLoader = new ClassLoader('Entities', APPPATH . 'models');
        $entityClassLoader->register();

        $entityClassLoader = new ClassLoader('DAO', APPPATH . 'models');
        $entityClassLoader->register();

        $config = new Configuration;
        $driver = new \Doctrine\ORM\Mapping\Driver\PHPDriver(APPPATH . 'models/Mappings');
        $config->setMetadataDriverImpl($driver);

        $config->setProxyDir(APPPATH . '/models/Proxies');
        $config->setProxyNamespace('Proxies');
        $config->setMetadataDriverImpl($config->newDefaultAnnotationDriver(APPPATH . 'models/Entities'));
        $config->setSQLLogger(new DoctrineOverWrite\ExportSQL());

        $config->addCustomStringFunction('IF', 'DoctrineExtensions\Query\Mysql\IfElse');
        $config->addCustomStringFunction('DATE_FORMAT', 'DoctrineExtensions\Query\Mysql\DateFormat');
        $config->addCustomStringFunction('DATEDIFF', 'DoctrineExtensions\Query\Mysql\DateDiff');
        $config->addCustomStringFunction('LPAD', 'DoctrineExtensions\Query\Mysql\Lpad');
        $config->addCustomStringFunction('RPAD', 'DoctrineExtensions\Query\Mysql\Rpad');
        $config->addCustomStringFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
        $config->addCustomStringFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        $config->addCustomStringFunction('MD5', 'DoctrineExtensions\Query\Mysql\Md5');
        $config->addCustomStringFunction('REPLACE', 'DoctrineExtensions\Query\Mysql\Replace');
        $config->addCustomStringFunction('GROUP_CONCAT', 'DoctrineExtensions\Query\Mysql\GroupConcat');
        $config->addCustomStringFunction('UNIX_TIMESTAMP', 'DoctrineExtensions\Query\Mysql\UnixTimestamp');
        $config->addCustomStringFunction('NOW', 'DoctrineExtensions\Query\Mysql\Now');
        $config->addCustomStringFunction('CONCAT_WS', 'DoctrineExtensions\Query\Mysql\ConcatWs');
        $config->setAutoGenerateProxyClasses(ENVIRONMENT == 'development' ? AbstractProxyFactory::AUTOGENERATE_FILE_NOT_EXISTS : true);
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' =>     DB_USER,
            'password' => DB_PASS,
            'host' =>     DB_HOST,
            'dbname' =>   DB_NAME,
            'charset' => 'utf8',
            'driverOptions' => array(
                'charset' => 'utf8',
            )
        );

        $this->em = EntityManager::create($connectionOptions, $config);
    }

    public function gerarEntities(): string
    {
        try {
            $platform = $this->em->getConnection()->getDatabasePlatform();
            $platform->registerDoctrineTypeMapping('enum', 'string');

            $this->em->getConfiguration()
                ->setMetadataDriverImpl(
                    new DatabaseDriver(
                        $this->em->getConnection()->getSchemaManager()
                    )
                );

            $cmf = new DisconnectedClassMetadataFactory();
            $cmf->setEntityManager($this->em);

            $metadata = $cmf->getAllMetadata();

            $generator = new EntityGenerator();
            $generator->setUpdateEntityIfExists(true);
            $generator->setAnnotationPrefix("");
            $generator->setGenerateStubMethods(true);
            $generator->setGenerateAnnotations(true);
            $generator->generate($metadata, APPPATH . "models/Entities");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
