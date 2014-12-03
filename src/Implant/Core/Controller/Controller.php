<?php

namespace Implant\Core\Controller;

class Controller
{

//    public function init()
//    {
//        $this->setLoginControllerAction($this->redirect->getCurrentController(), $this->getCurrentAction())
//             ->checkLogin();
//
//        AuthHelper::setLoginControllerAction();
//    }
    
    protected function view(Array $dadosToView = null)
    {
        if (is_array($dadosToView) && count($dadosToView) > 0)
            extract($dadosToView, EXTR_PREFIX_ALL, 'view');
        
        if (\Implant\FrontController::getController() !== 'login')
            return require_once(TEMPLATE . 'AdminLTE-master/index.phtml');
        else
            return require_once(VIEW . \Implant\FrontController::getController() . DS . \Implant\FrontController::getAction() . '.phtml');
    }
}