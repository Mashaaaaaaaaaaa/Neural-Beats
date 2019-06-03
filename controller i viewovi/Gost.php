<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gost
 *
 * @author janke
 */
class Gost extends CI_Controller{
    public function view($page = 'home'){
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }
            
            $data['title'] = ucfirst($page);
            
            $this->load->view('templates/header_gost');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
    }
}