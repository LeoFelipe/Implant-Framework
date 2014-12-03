<?php

namespace Implant\Core\Controller;

class ControllersController extends Controller
{
    public function index()
    {
        try
        {
            $controllersDAO = new \Implant\Core\DAO\ControllersDAO();            
            $dadosToView[\Implant\FrontController::getController()] = $controllersDAO->findAll();            
            parent::view($dadosToView);
        }
        catch (Exception $e)
        {
            echo "<script>alert('Erro ao listar. Por favor, tente novamente.');</script>";
        }
    }
        
    public function cadastrar()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){
            
            try
            {
                var_dump($_POST);
                
                die();
                
                $controller = new \Implant\Core\Model\Controllers();
                $controller->setNome($_POST['nome']);
                $controller->setOnMenu($_POST['onMenu']);
                $controller->setStatus($_POST['status']);
                $controller->setDtInsert();
                $controller->setDtEdit();
                
                if ($controller->rulesInsert()) {
                    $controllersDAO = new \Implant\Core\DAO\ControllersDAO();
                    $dadosToView[\Implant\FrontController::getController()] = $controllersDAO->cadastrar($controller);
                    echo "<script>alert('Cadastrado com Sucesso!');</script>";
                } else
                    echo "<script>alert('Preencha todos os campos obrigatórios corretamente.');</script>";
            }
            catch (Exception $e)
            {
                echo "<script>alert('Erro ao cadastrar. Por favor, tente novamente.');</script>";
            }
            
            \Implant\FrontController::goToAction();
        } else {
            $actionsDAO = new \Implant\Core\DAO\ActionsDAO();
            $dadosToView['actions'] = $actionsDAO->findAll();
            //die(var_dump($dadosToView));
            parent::view($dadosToView);
        }
    }

    public function editar()
    {
        if($id = \Implant\FrontController::getParams('id')) {
            $controllersDAO = new \Implant\Core\DAO\ControllersDAO();
            $controller = $controllersDAO->getById($id);
        } else {
            echo "<script>alert('Faltam Parâmetros.');</script>";
            \Implant\FrontController::goToController();
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){

            try
            {
                $controller->setNome($_POST['nome']);
                $controller->setStatus($_POST['status']);
                $controller->setDtEdit();

                if ($controller->rulesEdit()) {
                    $dadosToView[\Implant\FrontController::getController()] = $controllersDAO->editar($controller);
                    echo "<script>alert('Editado com Sucesso!');</script>";
                } else
                    echo "<script>alert('Preencha todos os campos obrigatórios corretamente.');</script>";
            }
            catch (Exception $e)
            {
                echo "<script>alert('Erro ao editar. Por favor, tente novamente.');</script>";
            }
            \Implant\FrontController::goToController();
        } else {
            $dadosToView[\Implant\FrontController::getController()] = $controller;
            parent::view($dadosToView);
        }
    }
    
    public function excluir()
    {
        try
        {
            if($id = \Implant\FrontController::getParams('id')) {
                $controllersDAO = new \Implant\Core\DAO\ControllersDAO();
                $controller = $controllersDAO->getById($id);
            } else {
                echo "<script>alert('Faltam Parâmetros.');</script>";
                \Implant\FrontController::goToController();
            }
            
            if ($controller->rulesDelete()) {
                $dadosToView[\Implant\FrontController::getController()] = $controllersDAO->excluir($controller);
                echo "<script>alert('Excluído com Sucesso!');</script>";
            } else
                echo "<script>alert('Código Inválido. Por favor, tente novamente.');</script>";
        }
        catch (Exception $e)
        {
            echo "<script>alert('Erro ao excluir. Por favor, tente novamente.');</script>";
        }
        
        \Implant\FrontController::goToController();
    }
}