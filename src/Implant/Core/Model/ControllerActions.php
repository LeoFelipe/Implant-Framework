<?php

namespace Implant\Core\Model;

/**
 * @Entity
 * @Table(name="controller_actions")
 */
class ControllerActions extends Model
{
    /**
     * @Id
     * @Column(type="integer", name="coac_id")
     */
    private $id;
    
    /** 
     * @Id()
     * @ManyToOne(targetEntity="Implant\Core\Model\Controllers", inversedBy="controller_actions") 
     * @JoinColumn(name="cont_id", referencedColumnName="id", nullable=false) 
     */
    protected $controller;

    /** 
     * @Id()
     * @ManyToOne(targetEntity="Implant\Core\Model\Actions", inversedBy="controller_actions") 
     * @JoinColumn(name="acti_id", referencedColumnName="id", nullable=false) 
     */
    protected $action;
    
    /**
     * @Column(type="integer", name="coac_onNavTab")
     */
    private $onNavTab;
    
    /**
     * @Column(type="string", name="coac_dtInsert")
     */
    private $dtInsert;
    
    /**
     * @Column(type="string", name="coac_dtEdit")
     */
    private $dtEdit;
}