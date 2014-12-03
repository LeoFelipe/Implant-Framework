<?php

// o Doctrine utiliza namespaces em sua estrutura, por isto estes uses
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Criar uma configuração simples ["default"] de Doctrine ORM para Annotations
$isDevMode = true;
$pathEntitys = array(__DIR__."/src/Implant/Core/Model", __DIR__."/src/Implant/App/Model");

$config = Setup::createAnnotationMetadataConfiguration($pathEntitys, $isDevMode);

// Parâmetros de Configuração do Banco de Dasdos
require_once(DBCONFIG.'dbconfig.php');

// Obtendo o Entity Manager com base nas configurações anteriores
$entityManager = EntityManager::create($dbParams, $config);

\Implant\Core\DAO\DAO::emCreated($entityManager);
Implant\FrontController::run();