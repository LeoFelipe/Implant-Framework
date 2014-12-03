<?php

namespace Implant\Core\Controller;

class SetoresController extends Controller
{
    public function index()
    {
        try
        {
            $setoresDAO = new \Implant\Core\DAO\SetoresDAO();
            $dadosToView[\Implant\FrontController::getController()] = $setoresDAO->findAll();
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
                $setor = new \Implant\Core\Model\Setores();
                $setor->setNome($_POST['nome']);
                $setor->setStatus($_POST['status']);
                $setor->setDtInsert();
                $setor->setDtEdit();

                if ($setor->rulesInsert()) {
                    $setoresDAO = new \Implant\Core\DAO\SetoresDAO();
                    $dadosToView[\Implant\FrontController::getController()] = $setoresDAO->cadastrar($setor);
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
            $setoresDAO = new \Implant\Core\DAO\SetoresDAO();
            $setor = $setoresDAO->getById($id);
        } else {
            echo "<script>alert('Faltam Parâmetros.');</script>";
            \Implant\FrontController::goToController();
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){

            try
            {
                $setor->setNome($_POST['nome']);
                $setor->setStatus($_POST['status']);
                $setor->setDtEdit();

                if ($setor->rulesEdit()) {
                    $dadosToView[\Implant\FrontController::getController()] = $setoresDAO->editar($setor);
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
            $dadosToView[\Implant\FrontController::getController()] = $setor;
            parent::view($dadosToView);
        }
    }
    
    public function excluir()
    {
        try
        {
            if($id = \Implant\FrontController::getParams('id')) {
                $setoresDAO = new \Implant\Core\DAO\SetoresDAO();
                $setor = $setoresDAO->getById($id);
            } else {
                echo "<script>alert('Faltam Parâmetros.');</script>";
                \Implant\FrontController::goToController();
            }
            
            if ($setor->rulesDelete()) {
                $dadosToView[\Implant\FrontController::getController()] = $setoresDAO->excluir($setor);
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