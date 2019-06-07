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
class Gost extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function view($page = 'home') {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page);

        if ($page == 'login' || $page == 'register') {
            $this->load->view('templates/header_signin');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header_gost');
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer');
        }
    }

    public function login() {
        $this->view('login');
    }

    public function ulogujse() {
      /*  $this->form_validation->
                set_rules('korime', "Korisnicko ime", "required");
        $this->form_validation->
                set_rules('lozinka', "Lozinka", "required");
        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            if ($this->Autor->dohvatiAutora
                            ($this->input->post('korime'))) {
                if ($this->Autor->proveriPassword
                                ($this->input->post('lozinka'))) {
                    $this->session->set_userdata
                            ('autor', $this->Autor->autor);
                    redirect('Korisnik');
                } else
                    $this->login('Neisravan password');
            }
            else {
                $this->login('Neispravan username');
            }
        }*/
     redirect('korisnik');
    }
    public function registrujse(){
        
    }

}
