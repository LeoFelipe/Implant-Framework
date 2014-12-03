<?php

namespace Implant\Core\DAO;

class CargosDAO extends DAO
{
    private $entidade = '\Implant\Core\Model\Cargos';

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
    
    public function findBy(Array $findType)
    {
        try
        {
            $entityRepository = DAO::$entityManager->getRepository($this->entidade);
            return $entityRepository->findBy(array(), $findType);
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
    
    public function cadastrar(\Implant\Core\Model\Cargos $cargo)
    {
        DAO::$entityManager->getConnection()->beginTransaction();
        try
        {
            DAO::$entityManager->persist($cargo);
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
    
    public function editar(\Implant\Core\Model\Cargos $cargo)
    {
        DAO::$entityManager->getConnection()->beginTransaction();
        try
        {
            DAO::$entityManager->persist($cargo);
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
    
    public function excluir(\Implant\Core\Model\Cargos $cargo)
    {
        DAO::$entityManager->getConnection()->beginTransaction();
        try
        {
            DAO::$entityManager->remove($cargo);
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