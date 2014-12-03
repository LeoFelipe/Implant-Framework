<?php

namespace Implant\Core\DAO;

class ActionsDAO extends DAO
{
    private $entidade = '\Implant\Core\Model\Actions';

    public function findAll()
    {
        try
        {
            $entityRepository = DAO::$entityManager->getRepository($this->entidade);
            return $entityRepository->findAll();
        } catch (Exception $e)
        {
            return false;
        }
    }
    
    public function getById($id)
    {
        try
        {
            $entityRepository = DAO::$entityManager->getRepository($this->entidade);
            return $entityRepository->find($id);
        } catch (Exception $e)
        {
            return false;
        }
    }
    
    public function cadastrar(\Implant\Core\Model\Actions $action)
    {
        DAO::$entityManager->getConnection()->beginTransaction();
        try
        {
            DAO::$entityManager->persist($action);
            DAO::$entityManager->flush();
            DAO::$entityManager->getConnection()->commit();
            return true;
        }
        catch (Exception $e)
        {
            DAO::$entityManager->getConnection()->rollback();
            DAO::$entityManager->close();
            return false;
        }
    }
    
    public function editar(\Implant\Core\Model\Actions $action)
    {
        DAO::$entityManager->getConnection()->beginTransaction();
        try
        {
            DAO::$entityManager->persist($action);
            DAO::$entityManager->flush();
            DAO::$entityManager->getConnection()->commit();
            return true;
        }
        catch (Exception $e)
        {
            DAO::$entityManager->getConnection()->rollback();
            DAO::$entityManager->close();
            return false;
        }
    }
    
    public function excluir(\Implant\Core\Model\Actions $action)
    {
        DAO::$entityManager->getConnection()->beginTransaction();
        try
        {
            DAO::$entityManager->remove($action);
            DAO::$entityManager->flush();
            DAO::$entityManager->getConnection()->commit();
            return true;
        }
        catch (Exception $e)
        {
            DAO::$entityManager->getConnection()->rollback();
            DAO::$entityManager->close();
            return false;
        }
    }
}