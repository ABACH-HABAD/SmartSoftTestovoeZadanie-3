<?php

namespace Layout;

include __DIR__.'/../Classes/Model.php';

use Classes\Model;

abstract class AbstractMain
{
    protected static $model;

    public function __construct()
    {
        self::$model = new Model();
    }

    public static function GetModel() : Model
    {
        return self::$model;
    }

    public function View() : void
    {
        $this->Header();
        $this->Layout();
        $this->Footer();
    }

    protected function Header() : void
    {
        require_once(__DIR__."/../HTML/header.html");
    }

    protected abstract function Layout() : void;

    protected function Footer() : void
    {
        require_once (__DIR__."/../HTML/footer.html");
    }
}

?>