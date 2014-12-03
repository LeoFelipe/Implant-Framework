<?php

namespace Implant\Core\Helper;

abstract class Routers
{
    private static $url, $explode;
    protected static $controllerClass, $controller, $action, $params, $paramString, $namespaceControllerClass;

    protected static function init()
    {
        self::setURL();
        self::setExplode();
        self::setController();
        self::setControllerClass();
        self::setNamespaceControllerClass();
        self::setAction();
        self::setParams();
    }

    private static function setURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : 'index' . DS . 'index';
        self::$url = $url;
    }

    private static function setExplode()
    {
        self::$explode = explode(DS, self::$url);
    }

    private static function setController()
    {
        $controle = (!isset(self::$explode[0]) || self::$explode[0] == null || self::$explode[0] == 'index') ? 'index' : self::$explode[0];
        self::$controller = $controle;
    }

    private static function setControllerClass()
    {
        self::$controllerClass = ucwords(self::$controller) . 'Controller';
    }

    private static function setNamespaceControllerClass()
    {
        if(in_array(self::$controller, array('index', 'grupos', 'usuarios', 'controllers', 'actions', 'setores', 'cargos')))
            self::$namespaceControllerClass = '\Implant\Core\Controller\\' . self::$controllerClass;
        else
            self::$namespaceControllerClass = '\Implant\App\Controller\\' . self::$controllerClass;

    }

    private static function setAction()
    {
        $acao = (!isset(self::$explode[1]) || self::$explode[1] == null || self::$explode[1] == 'index') ? 'index' : self::$explode[1];
        self::$action = $acao;
    }

    private static function setParams()
    {
        unset(self::$explode[0], self::$explode[1]);
        
        if (end(self::$explode) == null)
            array_pop (self::$explode);

        if (count(self::$explode) % 2 == 0) {

            if (!empty(self::$explode)) {

                $i = 0;
                foreach (self::$explode as $value) {
                    if ($i % 2 == 0)
                        $exp_idx[] = $value;
                    else
                        $exp_val[] = $value;

                    $i++;
                }
            } else {
                $exp_idx = array();
                $exp_val = array();
            }

            if (count($exp_idx) == count($exp_val) && !empty($exp_idx) && !empty($exp_val))
                self::$params = array_combine($exp_idx, $exp_val);
            else
                self::$params = array();
            
            self::$paramString = implode('/', self::$explode);

        } else {
            echo "<script>alert('Parâmetros incorretos!');</script>";
            \Implant\FrontController::goToHome();
        }
    }

    protected static function go($caminho)
    {
        echo "<script>window.location = '" . ROOT . $caminho . "'</script>";
    }
}