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
		print_r("attempting to open session");
		$dnode=new DNode\DNode();
		$dnode->connect(7070, function($remote,$connection) {
			$remote->open_session(function($sid) use ($connection){
				echo $sid;
				$connection->end();
			});
		});
		
	}
	public function set_parameter(){
		print("attempting to set parameter");
		$id=$this->$input->$post("id");
		$value=$this->$input->$post("value");
		$sid=$this->$input->$post("sid");
		$dnode=new DNode\DNode();
		$dnode->connect(7070, function($remote,$connection) {
			$remote->set_parameter($id, $value, $sid);
			$connection->end();
		});
	}
	public function generate(){
		print("attempting to generate");
		$sid=$this->$input->$post("sid");
		$dnode=new DNode\DNode();
		$dnode->connect(7070, function($remote,$connection) {
			$remote->generate($session_id, function($arr) use ($connection){
				echo $arr;
				$connection->end();
			});
		});
	}
	public function close_session(){
		print("attempting to close session");
		$sid=$this->$input->$post("sid");
		$dnode=new DNode\DNode();
		$dnode->connect(7070, function($remote,$connection) {
			$remote->close_session($session_id);
			$connection->end();
		});
	}
}
