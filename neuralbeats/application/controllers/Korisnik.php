<?php
//Janko Kitanovic
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
        $this->load->model('ModelKorisnik');
        
        if(!$this->session->has_userdata('korisnik')){
            redirect('');            
        }        
    }

    /*public function view($page = 'home') {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page);


        $this->load->view('templates/header_korisnik');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }*/
            
    public function view($page='home', $data=null){
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        } 
        $data['controller']='Korisnik';
        $this->load->view('templates/header_korisnik',
                ['korisnik'=>$this->session->userdata('korisnik')]);     
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
    }    
    
    public function logout(){
        $this->session->unset_userdata('korisnik');        
        redirect('');
    }

}
