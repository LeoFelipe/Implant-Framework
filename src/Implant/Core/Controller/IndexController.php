<?php
namespace Implant\Core\Controller;

class IndexController extends Controller
{
    public function index()
    {
        parent::view();
    }

    public function http404PageError()
    {
        parent::view();
    }

    public function http500PageError()
    {
        parent::view();
    }
}