<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Common\Controller\HomebaseController; 

/**
 * 首页
 */
class DmController extends HomebaseController {
	

  
  	//动漫
  	public function index(){
		session_start();
      	$data = [];
      	if(!empty($_SESSION[session_id().'_dm'])){
        	$data = $_SESSION[session_id().'_dm'];
        }
      	$this->assign('data',$data);
        $this->display();
    }
    public function category(){
    	session_start();
      	$data = [];
      	if(!empty($_SESSION[session_id().'_dm'])){
        	$data = $_SESSION[session_id().'_dm'];
        }
      	$this->assign('data',$data);
      	$this->display();
    }
  	public function category2(){
    	session_start();
      	$data = [];
      	if(!empty($_SESSION[session_id().'_dm'])){
        	$data = $_SESSION[session_id().'_dm'];
        }
      	$this->assign('data',$data);
      	$this->display();
    }
  	public function login(){
      session_start();
      $User=M("user_dm");
      if($_POST){
      	$username = I('username');
        $password = I('password');
        if(!empty($username)){
        	$data['name'] = $username;
        }else{
        	echo 1;
          	exit;
        }
        if(!empty($password)){
        	$data['password'] = md5($password);
        }else{
        	echo 2;
          	exit;
        }
        $re = $User->where($data)->find();
        if($re){
        	$_SESSION[session_id().'_dm'] = $re;
          	echo 4;
            exit;
        }else{
        	echo 3;
          	exit;
        }
      }
      	
      
        $this->display();
    }
  	public function register(){
    	$this->display();
    }
  //注册
  public function zc(){
  	  $username = I('username');
      $password = I('password');
      $password2 = I('password2');
      if($password == $password2){
      	$data['password'] = md5($password);
      }else{
      	echo 1; 
        exit;
      }
      if(!empty($username)){
      	$data['name'] = $username;
      }else{
      	echo 2;
        exit;
      }
    
   	  $User=M("user_dm");
      $userid=$User->add($data);
      if($userid){
      	echo $userid;
      }
  }
  
  public function detail(){
    session_start();
    $datas = [];
    if(!empty($_SESSION[session_id().'_dm'])){
      $datas = $_SESSION[session_id().'_dm'];
    }
    $this->assign('datas',$datas);
    //dm 图片名称  types 图片飞行 1收费 2免费  ml 图片所在文件夹  1=img1  2=img2
    $data['name'] = $_GET['dm'];
    $data['types']= $_GET['types'];
    $data['ml']= $_GET['ml'];
    $this->assign('data',$data);
    $this->display();
  }
  
  
}


