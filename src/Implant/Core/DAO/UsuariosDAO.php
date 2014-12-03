<?php

namespace Implant\Core\DAO;

class UsuariosDAO extends DAO
{
    private $entidade = '\Implant\Core\Model\Usuarios';
    
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
    
    public function findOneBy(Array $criteria)
    {
        try
        {
            $entityRepository = DAO::$entityManager->getRepository($this->entidade);
            return $entityRepository->findOneBy($criteria);
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
    
    public function cadastrar(\Implant\Core\Model\Usuarios $usuario)
    {
        DAO::$entityManager->getConnection()->beginTransaction();
        try
        {
            DAO::$entityManager->persist($usuario);
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
    
    public function editar(\Implant\Core\Model\Usuarios $usuario)
    {
        DAO::$entityManager->getConnection()->beginTransaction();
        try
        {
            DAO::$entityManager->persist($usuario);
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
    
    public function excluir(\Implant\Core\Model\Usuarios $usuario)
    {
        DAO::$entityManager->getConnection()->beginTransaction();
        try
        {
            DAO::$entityManager->remove($usuario);
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
    
    public function queryChkLogin(\Implant\Core\Model\Usuarios $usuario)
    {
        try
        {
            $dql = "SELECT u
                    FROM {$this->entidade} u
                    WHERE u.login = :login AND
                          u.id <> :id";
            
            $params = array('login' => $usuario->getLogin(),
                            'id'    => $usuario->getId());
            
            return $this->queryDAO($dql, $params);
        } catch (Exception $e)
        {
            return false;
        }
    }
    
    public function queryChkEmail(\Implant\Core\Model\Usuarios $usuario)
    {
        try
        {
            $dql = "SELECT u
                    FROM {$this->entidade} u
                    WHERE u.email = :email AND
                          u.id <> :id";
            
            $params = array('email' => $usuario->getEmail(),
                            'id'    => $usuario->getId());
            
            return $this->queryDAO($dql, $params);
        } catch (Exception $e)
        {
            return false;
        }
    }
    
    public function queryChkCpf(\Implant\Core\Model\Usuarios $usuario)
    {
        try
        {
            $dql = "SELECT u
                    FROM {$this->entidade} u
                    WHERE u.cpf = :cpf AND
                          u.id <> :id";
            
            $params = array('cpf' => $usuario->getCpf(),
                            'id'    => $usuario->getId());
            
            return $this->queryDAO($dql, $params);
        } catch (Exception $e)
        {
            return false;
        }
    }
}