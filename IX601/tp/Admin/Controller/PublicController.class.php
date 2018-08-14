<?php
/**
 * Created by PhpStorm.
 * User: Why
 * Date: 2017-02-15
 * Time: 13:57
 */
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function login(){
        $this -> display();
        //echo $this -> fetch();
    }
    public function test(){
        $this -> display();
        //echo $this -> fetch();
    }
}