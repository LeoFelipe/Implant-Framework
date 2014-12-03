<?php
switch (Implant\FrontController::getController())
{
    case 'index':
        switch (Implant\FrontController::getAction())
        {
            case 'index':
                $pageTitle = 'Home';
                $pageSubTitle = 'Página Inicial';
            break;
            case 'http404PageError':
                $pageTitle = '404 Page Error';
                $pageSubTitle = 'Endereço não localizado';
            break;
            case 'http500PageError':
                $pageTitle = '500 Page Error';
                $pageSubTitle = 'Um erro foi encontrado';
            break;
        }
    break;
    default:
        $pageTitle = ucfirst(Implant\FrontController::getController());
        $pageSubTitle = ucfirst(Implant\FrontController::getAction());
        $pageSubTitle = '';
    break;
}

echo "{$pageTitle} <small>{$pageSubTitle}</small>";