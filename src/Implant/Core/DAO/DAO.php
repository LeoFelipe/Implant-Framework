<?php

namespace Implant\Core\DAO;

class DAO
{
    private $tabela;
    protected static $entityManager;
    
    public static function emCreated($entityManager)
    {
        self::$entityManager = $entityManager;
    }

    protected function setTabela($tabela)
    {
        $this->tabela = $tabela;
    }
    
    protected function queryDAO($dql, Array $params = null)
    {
        try
        {
            $query = self::$entityManager->createQuery($dql);

            if ($params)
                $query->setParameters($params);
            
            return $query->getResult();
        }
        catch(Exception $e)
        {
            return false;
        }
    }
}