<?php

namespace Implant\Core\Controller;

class GruposController extends Controller
{
    public function index()
    {
        try
        {
            $gruposDAO = new \Implant\Core\DAO\GruposDAO();
            $dadosToView[\Implant\FrontController::getController()] = $gruposDAO->findAll();
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
                $grupo = new \Implant\Core\Model\Grupos();
                $grupo->setNome($_POST['nome']);
                $grupo->setStatus($_POST['status']);
                $grupo->setDtInsert();
                $grupo->setDtEdit();

                if ($grupo->rulesInsert()) {
                    $gruposDAO = new \Implant\Core\DAO\GruposDAO();
                    $dadosToView[\Implant\FrontController::getController()] = $gruposDAO->cadastrar($grupo);
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
            $gruposDAO = new \Implant\Core\DAO\GruposDAO();
            $grupo = $gruposDAO->getById($id);
        } else {
            echo "<script>alert('Faltam Parâmetros.');</script>";
            \Implant\FrontController::goToController();
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){

            try
            {
                $grupo->setNome($_POST['nome']);
                $grupo->setStatus($_POST['status']);
                $grupo->setDtEdit();

                if ($grupo->rulesEdit()) {
                    $dadosToView[\Implant\FrontController::getController()] = $gruposDAO->editar($grupo);
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
            $dadosToView[\Implant\FrontController::getController()] = $grupo;
            parent::view($dadosToView);
        }
    }
    
    public function excluir()
    {
        try
        {
            if($id = \Implant\FrontController::getParams('id')) {
                $gruposDAO = new \Implant\Core\DAO\GruposDAO();
                $grupo = $gruposDAO->getById($id);
            } else {
                echo "<script>alert('Faltam Parâmetros.');</script>";
                \Implant\FrontController::goToController();
            }
            
            if ($grupo->rulesDelete()) {
                $dadosToView[\Implant\FrontController::getController()] = $gruposDAO->excluir($grupo);
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