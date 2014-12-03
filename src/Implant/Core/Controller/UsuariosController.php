<?php

namespace Implant\Core\Controller;

class UsuariosController extends Controller
{
    public function index()
    {
        try
        {
            $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
            $dadosToView[\Implant\FrontController::getController()] = $usuariosDAO->findAll();
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
                $gruposDAO = new \Implant\Core\DAO\GruposDAO();
                $setoresDAO = new \Implant\Core\DAO\SetoresDAO();
                $cargosDAO = new \Implant\Core\DAO\CargosDAO();
                $grupo = $gruposDAO->getById((int)$_POST['grupo']);
                $setor = $setoresDAO->getById((int)$_POST['setor']);
                $cargo = $cargosDAO->getById((int)$_POST['cargo']);
                
                $usuario = new \Implant\Core\Model\Usuarios();
                $usuario->setGrupo($grupo);
                $usuario->setSetor($setor);
                $usuario->setCargo($cargo);
                $usuario->setLogin($_POST['login']);
                $usuario->setNome($_POST['nome']);
                $usuario->setCpf($_POST['cpf']);
                $usuario->setEmail($_POST['email']);
                $usuario->setDtNiver($_POST['dtNiver']);
                $usuario->setStatus($_POST['status']);
                $usuario->setDtInsert();
                $usuario->setDtEdit();
                
                if ($usuario->rulesInsert()) {
                    $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
                    $dadosToView[\Implant\FrontController::getController()] = $usuariosDAO->cadastrar($usuario);
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
            $gruposDAO = new \Implant\Core\DAO\GruposDAO();
            $setoresDAO = new \Implant\Core\DAO\SetoresDAO();
            $cargosDAO = new \Implant\Core\DAO\CargosDAO();
            $dadosToView[\Implant\FrontController::getController()]['grupos'] = $gruposDAO->findBy(array('nome' => 'ASC'));
            $dadosToView[\Implant\FrontController::getController()]['setores'] = $setoresDAO->findBy(array('nome' => 'ASC'));
            $dadosToView[\Implant\FrontController::getController()]['cargos'] = $cargosDAO->findBy(array('nome' => 'ASC'));
            parent::view($dadosToView);
        }
    }

    public function editar()
    {
        if($id = (int)\Implant\FrontController::getParams('id')) {
            $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
            $usuario = $usuariosDAO->getById($id);
        } else {
            echo "<script>alert('Faltam Parâmetros.');</script>";
            \Implant\FrontController::goToController();
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){

            try
            {
                $gruposDAO = new \Implant\Core\DAO\GruposDAO();
                $setoresDAO = new \Implant\Core\DAO\SetoresDAO();
                $cargosDAO = new \Implant\Core\DAO\CargosDAO();
                $grupo = $gruposDAO->getById((int)$_POST['grupo']);
                $setor = $setoresDAO->getById((int)$_POST['setor']);
                $cargo = $cargosDAO->getById((int)$_POST['cargo']);

                $usuario->setGrupo($grupo);
                $usuario->setSetor($setor);
                $usuario->setCargo($cargo);
                $usuario->setLogin($_POST['login']);
                $usuario->setNome($_POST['nome']);
                $usuario->setCpf($_POST['cpf']);
                $usuario->setEmail($_POST['email']);
                $usuario->setDtNiver($_POST['dtNiver']);
                $usuario->setStatus($_POST['status']);
                $usuario->setDtEdit();
                
                if ($usuario->rulesEdit()) {
                    $dadosToView[\Implant\FrontController::getController()] = $usuariosDAO->editar($usuario);
                    echo "<script>alert('Editado com Sucesso!');</script>";
                    \Implant\FrontController::goToController();
                } else
                    echo "<script>alert('Preencha todos os campos obrigatórios corretamente.');</script>";
            }
            catch (Exception $e)
            {
                echo "<script>alert('Erro ao editar. Por favor, tente novamente.');</script>";
            }
            \Implant\FrontController::goToControllerActionParam();
        } else {
            $gruposDAO = new \Implant\Core\DAO\GruposDAO();
            $setoresDAO = new \Implant\Core\DAO\SetoresDAO();
            $cargosDAO = new \Implant\Core\DAO\CargosDAO();
            
            $dadosToView[\Implant\FrontController::getController()]['usuarios'] = $usuario;
            $dadosToView[\Implant\FrontController::getController()]['grupos'] = $gruposDAO->findBy(array('nome' => 'ASC'));
            $dadosToView[\Implant\FrontController::getController()]['setores'] = $setoresDAO->findBy(array('nome' => 'ASC'));
            $dadosToView[\Implant\FrontController::getController()]['cargos'] = $cargosDAO->findBy(array('nome' => 'ASC'));
            parent::view($dadosToView);
        }
    }
    
    public function editarSenha()
    {
        if($id = (int)\Implant\FrontController::getParams('id')) {
            $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
            $usuario = $usuariosDAO->getById($id);
        } else {
            echo "<script>alert('Faltam Parâmetros.');</script>";
            \Implant\FrontController::goToController();
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){
            
            try
            {
                
                $senha = $usuario->getSenha();
                $usuario->setSenha($_POST['novaSenha']);
                $usuario->setSenhaConfirm($_POST['novaSenhaConfirm']);
                $usuario->setSenhaAtual($_POST['senhaAtual']);
                $usuario->setDtEdit();
                
                if ($usuario->rulesEditSenha($senha)) {
                    $dadosToView[\Implant\FrontController::getController()] = $usuariosDAO->editar($usuario);
                    echo "<script>alert('Editado com Sucesso!');</script>";
                    \Implant\FrontController::goToController();
                } else
                    echo "<script>alert('Preencha todos os campos obrigatórios corretamente.');</script>";
            }
            catch (Exception $e)
            {
                echo "<script>alert('Erro ao editar. Por favor, tente novamente.');</script>";
            }
            \Implant\FrontController::goToControllerActionParam();
        } else {
            $dadosToView[\Implant\FrontController::getController()] = $usuario;
            parent::view($dadosToView);
        }
    }
    
    public function excluir()
    {
        try
        {
            if($id = \Implant\FrontController::getParams('id')) {
                $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
                $usuario = $usuariosDAO->getById($id);
            } else {
                echo "<script>alert('Faltam Parâmetros.');</script>";
                \Implant\FrontController::goToController();
            }
            
            if ($usuario->rulesDelete()) {
                $dadosToView[\Implant\FrontController::getController()] = $usuariosDAO->excluir($usuario);
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
    
    public function chkCpfAjax()
    {
        $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
        if($id = (int)$_POST['id']) {
            $usuario = $usuariosDAO->getById($id);
            $usuario->setCpf($_POST['cpf']);
            $retorno = $usuariosDAO->queryChkCpf($usuario);
        } else {
            $usuario = new \Implant\Core\Model\Usuarios();
            $usuario->setCpf($_POST['cpf']);
            $retorno = $usuariosDAO->findOneBy(array('cpf' => $usuario->getCpf()));
        }
        echo (empty($retorno)) ? 'true' : 'false';
    }
    
    public function chkEmailAjax()
    {
        $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
        if($id = (int)$_POST['id']) {
            $usuario = $usuariosDAO->getById($id);
            $usuario->setEmail($_POST['email']);
            $retorno = $usuariosDAO->queryChkEmail($usuario);
        } else {
            $usuario = new \Implant\Core\Model\Usuarios();
            $usuario->setLogin($_POST['email']);
            $retorno = $usuariosDAO->findOneBy(array('email' => $usuario->getEmail()));
        }
        echo (empty($retorno)) ? 'true' : 'false';
    }
    
    public function chkLoginAjax()
    {
        $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
        if($id = (int)$_POST['id']) {
            $usuario = $usuariosDAO->getById($id);
            $usuario->setLogin($_POST['login']);
            $retorno = $usuariosDAO->queryChkLogin($usuario);
        } else {
            $usuario = new \Implant\Core\Model\Usuarios();
            $usuario->setLogin($_POST['login']);
            $retorno = $usuariosDAO->findOneBy(array('login' => $usuario->getLogin()));
        }
        echo (empty($retorno)) ? 'true' : 'false';
    }
}