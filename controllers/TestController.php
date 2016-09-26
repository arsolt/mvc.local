<?php

/**
 * Created by PhpStorm.
 * User: arsolt
 * Date: 24.09.2016
 * Time: 16:11
 */
class TestController
{
    public $param;
    /**
     * Action для тестовой страницы
     */
    public function actionIndex()
    {
        // Подключаем вид
        require_once(ROOT . '/views/test/index.php');
        return true;
    }
    public function actionOop()
    {
        $this->param = 'oop';
        require_once(ROOT . '/views/test/index.php');
        return true;
    }

}