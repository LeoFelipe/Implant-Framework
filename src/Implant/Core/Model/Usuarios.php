<?php

namespace Implant\Core\Model;

/**
 * @Entity
 * @Table(name="usuarios")
 */
class Usuarios extends Model
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="usua_id")
     */
    private $id;
    
    /**
     * @ManyToOne(targetEntity="Grupos")
     * @JoinColumn(name="usua_grup_id", referencedColumnName="grup_id")
     */
    private $grupo;
    
    /**
     * @ManyToOne(targetEntity="Setores")
     * @JoinColumn(name="usua_seto_id", referencedColumnName="seto_id")
     */
    private $setor;
    
    /**
     * @ManyToOne(targetEntity="Cargos")
     * @JoinColumn(name="usua_carg_id", referencedColumnName="carg_id")
     */
    private $cargo;
    
    /**
     * @Column(type="string", name="usua_nome")
     */
    private $nome;
    
    /**
     * @Column(type="string", name="usua_cpf")
     */
    private $cpf;
    
    /**
     * @Column(type="string", name="usua_dtNiver")
     */
    private $dtNiver;
    
    /**
     * @Column(type="string", name="usua_email")
     */
    private $email;
    
    /**
     * @Column(type="string", name="usua_login")
     */
    private $login;
    
    /**
     * @Column(type="string", name="usua_senha")
     */
    private $senha;
    private $senhaConfirm;
    private $senhaAtual;
    
    /**
     * @Column(type="integer", name="usua_status")
     */
    private $status;
    
    /**
     * @Column(type="string", name="usua_dtInsert")
     */
    private $dtInsert;
    
    /**
     * @Column(type="string", name="usua_dtEdit")
     */
    private $dtEdit;

    public function getId() {
        return $this->id;
    }

    public function getGrupo() {
        return $this->grupo;
    }
    
    public function getSetor() {
        return $this->setor;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getDtNiver() {
        return implode('/', array_reverse(explode('-', $this->dtNiver)));
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }
    
    public function getSenhaConfirm() {
        return $this->senhaConfirm;
    }
    
    public function getSenhaAtual() {
        return $this->senhaAtual;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDtInsert() {
        return $this->dtInsert;
    }

    public function getDtEdit() {
        return $this->dtEdit;
    }

    public function setGrupo($grupo) {
        $this->grupo = $grupo;
    }
    
    public function setSetor($setor) {
        $this->setor = $setor;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setDtNiver($dtNiver) {
        $this->dtNiver = implode('-', array_reverse(explode('/', $dtNiver)));
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    public function setSenhaConfirm($senhaConfirm) {
        $this->senhaConfirm = $senhaConfirm;
    }
    
    public function setSenhaAtual($senhaAtual) {
        $this->senhaAtual = $senhaAtual;
    }

    public function setStatus($status) {
        $this->status = (int)$status;
    }

    public function setDtInsert()
    {
        $dtInsert = new \DateTime();
        $this->dtInsert = $dtInsert->format('Y-m-d H:i:s');        
    }

    public function setDtEdit()
    {
        $dtEdit = new \DateTime();
        $this->dtEdit = $dtEdit->format('Y-m-d H:i:s');
    }

    public function rulesInsert()
    {
        if (empty($this->grupo) || !is_object($this->grupo) || sizeof($this->grupo) < 1)
            return false;
        
        if (empty($this->setor) || !is_object($this->setor) || sizeof($this->setor) < 1)
            return false;
        
        if (empty($this->cargo) || !is_object($this->cargo) || sizeof($this->cargo) < 1)
            return false;
        
        if (empty($this->nome) || !is_string($this->nome) || strlen($this->nome) < 8)
            return false;
        
        if (empty($this->cpf) || !is_string($this->cpf) || strlen($this->cpf) < 14)
            return false;
        
        if (empty($this->email) || !is_string($this->email) || strlen($this->email) < 14)
            return false;
        
        if (empty($this->login) || !is_string($this->login) || strlen($this->login) < 6)
            return false;
        
        if (empty($this->dtNiver) || !is_string($this->dtNiver) || strlen($this->dtNiver) != 10)
            return false;
        
        if (empty($this->dtInsert) || !is_string($this->dtInsert) || strlen($this->dtInsert) != 19)
            return false;
        
        if (empty($this->dtEdit) || !is_string($this->dtEdit) || strlen($this->dtEdit) != 19)
            return false;
        
        if (!isset($this->status) || !is_int($this->status) || strlen($this->status) != 1)
            return false;
        
        if ($this->chkCpf() || $this->chkEmail() || $this->chkLogin())
            return false;
        
        return true;
    }
    
    public function rulesEdit()
    {
        if (empty($this->grupo) || !is_object($this->grupo) || sizeof($this->grupo) < 1)
            return false;
        
        if (empty($this->setor) || !is_object($this->setor) || sizeof($this->setor) < 1)
            return false;
        
        if (empty($this->cargo) || !is_object($this->cargo) || sizeof($this->cargo) < 1)
            return false;
        
        if (empty($this->nome) || !is_string($this->nome) || strlen($this->nome) < 8)
            return false;
        
        if (empty($this->cpf) || !is_string($this->cpf) || strlen($this->cpf) < 14)
            return false;
        
        if (empty($this->email) || !is_string($this->email) || strlen($this->email) < 14)
            return false;
        
        if (empty($this->login) || !is_string($this->login) || strlen($this->login) < 6)
            return false;
        
        if (empty($this->dtNiver) || !is_string($this->dtNiver) || strlen($this->dtNiver) != 10)
            return false;
        
        if (empty($this->dtEdit) || !is_string($this->dtEdit) || strlen($this->dtEdit) != 19)
            return false;
        
        if (!isset($this->status) || !is_int($this->status) || strlen($this->status) != 1)
            return false;
            
        return true;
    }
    
    public function rulesEditSenha($senha)
    {
        if (empty($this->senha) || !is_string($this->senha) || strlen($this->senha) < 8)
            return false;
        
        if (empty($this->senhaConfirm) || !is_string($this->senhaConfirm) || strlen($this->senhaConfirm) < 8)
            return false;
        
        if ($this->senha !== $this->senhaConfirm)
            return false;
        
        if ($this->senhaAtual) {
            if (!is_string($this->senhaAtual) || strlen($this->senhaAtual) < 8)
                return false;
            
            if ($this->senhaAtual != $senha)
                return false;
        }
        
        return true;
    }
    
    public function rulesDelete()
    {
        if (!isset($this->id) || !is_int($this->id) || strlen($this->id) < 1)
            return false;
            
        return true;
    }
    
    protected function chkCpf()
    {
        $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
        $usuario = $usuariosDAO->findOneBy(array('cpf' => $_POST['cpf']));
        return ($usuario) ? true : false;
    }
    
    protected function chkCpfAjax()
    {
        $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
        $usuario = $usuariosDAO->findOneBy(array('cpf' => $_POST['cpf']));
        echo (empty($usuario)) ? 'true' : 'false';
    }
    
    protected function chkEmail()
    {
        $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
        $usuario = $usuariosDAO->findOneBy(array('email' => $this->email));        
        return ($usuario) ? true : false;
    }
    
    protected function chkLogin()
    {
        $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
        $usuario = $usuariosDAO->findOneBy(array('login' => $this->login));
        return ($usuario) ? true : false;
    }
    
    protected function chkSenhaAtual()
    {
        $usuariosDAO = new \Implant\Core\DAO\UsuariosDAO();
        $usuario = $usuariosDAO->findOneBy(array('senha' => $this->senha));
        return ($usuario) ? true : false;
    }
}