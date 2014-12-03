<?php

namespace Implant;

class FrontController extends \Implant\Core\Helper\Routers
{
    public static function run()
    {
        parent::init();
        
        $controller = new parent::$namespaceControllerClass();
        
        if (!method_exists($controller, parent::$action))
            self::goToHttp500PageError();

        $action = parent::$action;
        $controller->$action();
    }

    public static function getController()
    {
        return parent::$controller;
    }

    public static function getAction()
    {
        return parent::$action;
    }

    public static function getControllerAction()
    {
        return (parent::$controller . DS . parent::$action);
    }
    
    public static function getControllerActionParams()
    {
        return (parent::$controller . DS . parent::$action . DS . parent::$paramString);
    }

    public static function getParams($param = null)
    {
        if (parent::$params != '' && $param != null)
            if (array_key_exists($param, parent::$params))
                return parent::$params[$param];
            else
                return false;
        else
            return parent::$params;
    }

    public static function goToController($controller = null)
    {
        if (is_null($controller))
            parent::go(self::getController());
        else
            parent::go($controller);
    }

    public static function goToAction($action = null)
    {
        if (is_null($action))
            parent::go(self::getController() . DS . self::getAction());
        else
            parent::go(self::getController() . DS . $action);
    }
    
    public static function goToControllerAction($controller = null, $action = null)
    {
        if (is_null($controller))
            if (is_null($action))
                parent::go(self::getController() . DS . self::getAction());
            else
                parent::go(self::getController() . DS . $action);
        else
            if (is_null($action))
                parent::go($controller . DS . self::getAction());
            else
                parent::go($controller . DS . $action);
    }
    
    public static function goToControllerActionParam($controller = null, $action = null, $param = null)
    {
        if (is_null($controller))
            if (is_null($action))
                parent::go(self::getController() . DS . self::getAction() . DS . parent::$paramString);
            else
                parent::go(self::getController() . DS . $action . DS . parent::$paramString);
        else
            if (is_null($action))
                parent::go($controller . DS . self::getAction() . DS . parent::$paramString);
            else
                parent::go($controller . DS . $action . DS . parent::$paramString);
    }

    public static function goToHome()
    {
        parent::go('index/index');
    }

    public static function goToHttp404PageError()
    {
        parent::go('index/http404PageError');
    }

    public static function goToHttp500PageError()
    {
        parent::go('index/http500PageError');
    }

    public static function goToUrl($url)
    {
        header("Location: ".$url);
    }
}