<?php

namespace Implant\Core\Controller;

class CargosController extends Controller
{
    public function index()
    {
        try
        {
            $cargosDAO = new \Implant\Core\DAO\CargosDAO();
            $dadosToView[\Implant\FrontController::getController()] = $cargosDAO->findAll();
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
                $cargo = new \Implant\Core\Model\Cargos();
                $cargo->setNome($_POST['nome']);
                $cargo->setStatus($_POST['status']);
                $cargo->setDtInsert();
                $cargo->setDtEdit();

                if ($cargo->rulesInsert()) {
                    $cargosDAO = new \Implant\Core\DAO\CargosDAO();
                    $dadosToView[\Implant\FrontController::getController()] = $cargosDAO->cadastrar($cargo);
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
            $cargosDAO = new \Implant\Core\DAO\CargosDAO();
            $cargo = $cargosDAO->getById($id);
        } else {
            echo "<script>alert('Faltam Parâmetros.');</script>";
            \Implant\FrontController::goToController();
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){

            try
            {
                $cargo->setNome($_POST['nome']);
                $cargo->setStatus($_POST['status']);
                $cargo->setDtEdit();

                if ($cargo->rulesEdit()) {
                    $dadosToView[\Implant\FrontController::getController()] = $cargosDAO->editar($cargo);
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
            $dadosToView[\Implant\FrontController::getController()] = $cargo;
            parent::view($dadosToView);
        }
    }
    
    public function excluir()
    {
        try
        {
            if($id = \Implant\FrontController::getParams('id')) {
                $cargosDAO = new \Implant\Core\DAO\CargosDAO();
                $cargo = $cargosDAO->getById($id);
            } else {
                echo "<script>alert('Faltam Parâmetros.');</script>";
                \Implant\FrontController::goToController();
            }
            
            if ($cargo->rulesDelete()) {
                $dadosToView[\Implant\FrontController::getController()] = $cargosDAO->excluir($cargo);
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