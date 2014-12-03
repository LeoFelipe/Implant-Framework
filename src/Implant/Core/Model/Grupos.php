<?php

namespace Implant\Core\Model;

/**
 * @Entity
 * @Table(name="grupos")
 */
class Grupos extends Model
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="grup_id")
     */
    private $id;
    
    /**
     * @Column(type="string", name="grup_nome")
     */
    private $nome;
    
    /**
     * @Column(type="integer", name="grup_status")
     */
    private $status;
    
    /**
     * @Column(type="string", name="grup_dtInsert")
     */
    private $dtInsert;
    
    /**
     * @Column(type="string", name="grup_dtEdit")
     */
    private $dtEdit;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }
    
    public function getStatus()
    {
        return $this->status;
    }

    public function getDtInsert()
    {
        return $this->dtInsert;
    }

    public function getDtEdit()
    {
        return $this->dtEdit;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setStatus($status)
    {
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
        if (empty($this->nome) || !is_string($this->nome) || strlen($this->nome) < 3)
            return false;
        
        if (empty($this->dtInsert) || !is_string($this->dtInsert) || strlen($this->dtInsert) != 19)
            return false;
        
        if (empty($this->dtEdit) || !is_string($this->dtEdit) || strlen($this->dtEdit) != 19)
            return false;
        
        if (!isset($this->status) || !is_int($this->status) || strlen($this->status) != 1)
            return false;
            
        return true;
    }
    
    public function rulesEdit()
    {
        if (empty($this->nome) || !is_string($this->nome) || strlen($this->nome) < 3)
            return false;
                
        if (empty($this->dtEdit) || !is_string($this->dtEdit) || strlen($this->dtEdit) != 19)
            return false;
        
        if (!isset($this->status) || !is_int($this->status) || strlen($this->status) != 1)
            return false;
            
        return true;
    }
    
    public function rulesDelete()
    {
        if (!isset($this->id) || !is_int($this->id) || strlen($this->id) < 1)
            return false;
            
        return true;
    }
}