<?php

//*** DEFINE TIMEZONE ***\\
date_default_timezone_set('America/Recife');

//*** CHARSET PHP ***\\
header('Content-type: text/html; charset=utf-8');

//*** INFORMAÇÕES SOBRE O SISTEMA ***\\
$mesesDoAnoPorExtenso = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
define('DATENOW', date('d')." de ".$mesesDoAnoPorExtenso[date('m')-1]." de ".date('Y'));
define('SYSNAME', '.:: Implant! ::.');
define('SYSDESC', 'Implant! Framework');
define('SYSICO', 'public/img/implant.ico');
//define('SESSIONTIME', '5000'); //em segundos

//*** DIRETÓRIOS ***\\
/* DIRECTORY SEPARATOR */
//define('DS', DIRECTORY_SEPARATOR);
define('DS', '/');

/* PATH ROOT */
define('ROOT', dirname(htmlspecialchars($_SERVER['SCRIPT_NAME'], ENT_QUOTES, "utf-8")) . DS);

/* PATH DATABASE CONFIG */
define('DBCONFIG', 'src/Implant/DBConfig/');

/* CORE */
define('CORECONTROLLER', ROOT . 'src/Implant/Core/Controller/');
define('COREMODEL', ROOT . 'src/Implant/Core/Model/');
define('HELPER', ROOT . 'src/Implant/Core/Helper/');

/* APP */
define('APPCONTROLLER', ROOT . 'src/Implant/App/Controller/');
define('APPMODEL', ROOT . 'src/Implant/App/Model/');

/* PUBLIC */
define('TEMPLATE', 'public/template/');
define('CSS', 'public/css/');
define('JS', 'public/js/');
define('IMG', 'public/img/');
define('FILES', 'public/files/');
define('VIEW', 'public/views/');

/* FW's & LIBS DE TERCEIROS */
define('JQUERY', ROOT . 'public/libs/jquery-2.1.0/jquery.min.js');
define('JQUERYUI', ROOT . 'public/libs/jquery-ui-1.10.4/js/jquery-ui.min.js');
define('JQUERYVALIDATION', ROOT . 'public/libs/jquery-validation/jquery.validate.min.js');
define('TBJS', ROOT . 'public/libs/bootstrap-3.1.1/js/bootstrap.min.js');
define('TBCSS', ROOT . 'public/libs/bootstrap-3.1.1/css/bootstrap.min.css');
define('JQDATATABLE', ROOT . 'public/libs/datatables/media/js/jquery.dataTables.min.js');
define('TBDATATABLEJS', ROOT . 'public/libs/datatables/media/js/dataTables.bootstrap.js');
define('TBDATATABLECSS', ROOT . 'public/libs/datatables/media/css/dataTables.bootstrap.css');
define('TABLETOOLSJS', ROOT . 'public/libs/datatables/extensions/TableTools/js/dataTables.tableTools.min.js');
define('TABLETOOLSCSS', ROOT . 'public/libs/datatables/extensions/TableTools/css/dataTables.tableTools.min.css');

/* AUTOLOAD & BOOTSTRAP */
require_once('vendor/autoload.php');
require_once('bootstrap.php');