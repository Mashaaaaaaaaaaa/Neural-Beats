<?php
//Janko Kitanovic
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
        
        if($this->session->has_userdata('korisnik')){
            redirect('Korisnik');
        }        
    }

    public function view($page = 'home', $data = null) {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }
        $data['controller']='Gost';
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

    /*public function login() {
        $this->load->view('login');
    }*/
    public function login($poruka=null){
        $podaci=[];
        if($poruka!=null){
            $podaci['poruka']=$poruka;
        }
        $this->view('login',$podaci);      
    }    

    public function ulogujse() {
      $this->load->model('ModelKorisnik');
      
      $this->form_validation->
              set_rules('username', 'Username', 'required');
        $this->form_validation->
                set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            if ($this->ModelKorisnik->dohvatiKorisnika
                    ($this->input->post('username'))) {
                if ($this->ModelKorisnik->proveriPassword
                        ($this->input->post('password'))) {
                    $this->session->set_userdata
                            ('korisnik', $this->ModelKorisnik->korisnik);
                    redirect('Korisnik/view');
                } else{
                    $this->login('Neispravan password');
                }
            }
            else {
                $this->login('Neispravan username');
            }
        }
    }
    
    
    public function registrujse(){
        
    }

}
