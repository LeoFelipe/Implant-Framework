<?php

namespace Implant\Core\Controller;

class ActionsController extends Controller
{
    public function index()
    {
        try
        {
            $actionsDAO = new \Implant\Core\DAO\ActionsDAO();
            $dadosToView[\Implant\FrontController::getController()] = $actionsDAO->findAll();
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
                $action = new \Implant\Core\Model\Actions();
                $action->setNome($_POST['nome']);
                $action->setStatus($_POST['status']);
                $action->setDtInsert();
                $action->setDtEdit();

                if ($action->rulesInsert()) {
                    $actionsDAO = new \Implant\Core\DAO\ActionsDAO();
                    $dadosToView[\Implant\FrontController::getController()] = $actionsDAO->cadastrar($action);
                    echo "<script>alert('Cadastrado com Sucesso!');</script>";
                } else
                    echo "<script>alert('Preencha todos os campos obrigatórios corretamente.');</script>";
            }
            catch (Exception $e)
            {
                echo "<script>alert('Erro ao cadastrar. Por favor, tente novamente.');</script>";
            }
            
            \Implant\FrontController::goToAction();
        } else
            parent::view();
    }

    public function editar()
    {
        if($id = \Implant\FrontController::getParams('id')) {
            $actionsDAO = new \Implant\Core\DAO\ActionsDAO();
            $action = $actionsDAO->getById($id);
        } else {
            echo "<script>alert('Faltam Parâmetros.');</script>";
            \Implant\FrontController::goToController();
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){
            
            try
            {
                $action->setNome($_POST['nome']);
                $action->setStatus($_POST['status']);
                $action->setDtEdit();
                
                if ($action->rulesEdit()) {
                    $dadosToView[\Implant\FrontController::getController()] = $actionsDAO->editar($action);
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
            $dadosToView[\Implant\FrontController::getController()] = $action;
            parent::view($dadosToView);
        }
    }
    
    public function excluir()
    {
        try
        {
            if($id = \Implant\FrontController::getParams('id')) {
                $actionsDAO = new \Implant\Core\DAO\ActionsDAO();
                $action = $actionsDAO->getById($id);
            } else {
                echo "<script>alert('Faltam Parâmetros.');</script>";
                \Implant\FrontController::goToController();
            }
            
            if ($action->rulesDelete()) {
                $dadosToView[\Implant\FrontController::getController()] = $actionsDAO->excluir($action);
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