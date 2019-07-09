<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
Kontroler za generator muzike
Autor - Marija Jovanovic, 2015/0231
 */
require(__DIR__.'/../../vendor/autoload.php');
class Generator_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }


	
	public function open_session(){
		$model=`node ../dnode-server/node-wrapper.js open`;
		$_SESSION['model']=json_decode($model);
		echo $model;
	}
	public function set_parameter(){
		//$id=$this->$input->$post("id");
		//$value=$this->$input->$post("value");
		$id=null;
		if (isset($_POST["id"])) $id=$_POST["id"]; else $id=0;
		$value=null;
		if (isset($_POST["value"])) $value=$_POST["value"]; else $value=0.5;
		if(isset($_SESSION['model'])){
			$_SESSION['model']->parameters[$id]=floatval($value);
			//$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			//$filename='model-'.substr(str_shuffle($permitted_chars), 0, 16).'.json';
			//file_put_contents('../dnode_server/'.$filename,$_SESSION['model']);
			//$model=shell_exec("node ../dnode-server/node-wrapper.js set ".$filename." ".$id." ".$value);
			//$_SESSION['model']=$model;
			//unlink('../dnode-server/'.$filename) or die("Couldn't delete file");
		}
	}
	public function generate(){
		if(isset($_SESSION['model'])){
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$filename='model-'.substr(str_shuffle($permitted_chars), 0, 16).'.json';
			file_put_contents('../dnode-server/'.$filename,json_encode($_SESSION['model']));
			$output=explode("\n",shell_exec("node ../dnode-server/node-wrapper.js generate ".$filename));
			unlink('../dnode-server/'.$filename) or die("Couldn't delete file");
			$model=$output[0];
			$_SESSION['model']=json_decode($model);
			if(isset($output[1]))$result=$output[1]; else $result=$output[0];
			echo $result;
		}
	}
}
