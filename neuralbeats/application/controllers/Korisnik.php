<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Korisnik
 *
 * @author janke
 */
class Korisnik extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function view($page = 'home') {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page);


        $this->load->view('templates/header_korisnik');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }
    
    public function logout(){
        redirect('gost');
    }

}
