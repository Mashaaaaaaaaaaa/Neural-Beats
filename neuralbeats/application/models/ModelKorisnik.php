<?php
    
    class ModelKorisnik extends CI_Model{
        private $korisnik;
        
        
        public function __construct($password_hash, $username, $email, $admin, $opis) {
            $parent::__construct();
            $korisnik=null;
        }
        
        public function dohvatiKorisnika($idP){
            $rezultat = $this->db->where('Username',$username)->get('Korisnik');
            $korisnik = $rezultat->row();
            if ($korisnik!=NULL) {
                $this->korisnik=$korisnik;
                return TRUE;
            } else {
                return FALSE;
            }    
        }
        
        public function daLiJeAdmin(){
            if(this!=null){
                if ($this->korisnik->Administrator & 1) {
                    return TRUE;
                } 
                else {
                    return FALSE;
                }
            }
        }
        
        public function proveriPassword($password_hash=NULL){
            if(this!=null){
                if ($this->korisnik->Pasword_hash== $pasword_hash) {
                    return TRUE;
                } 
                else {
                    return FALSE;
                }
            }
        }
        
        public function dohvatiSveKorisnike(){
            return $this->db->get('Korisnik')->result();
        }
        
        public function sacuvajKorisnika($pasword_hash=NULL, $username=NULL, $email=NULL, $admin=NULL, $opis=NULL){
           $this->db->set('Pasword_hash', $pasword_hash);
            $this->db->set('Username', $username);
            $this->db->set('Email', $email);
            $this->db->set('Administrator', $admin);
            $this->db->set('Opis', $opis);
            $this->db->insert("Korisnik");
        }
        
        public  function ukloniKorisnika($username){
            $this->db->where('Username', $username);
            $this->db->delete("Korisnik");
        }
        
        public  function izmenaKorisnika($id,$password_hash=NULL, $admin=NULL, $opis=NULL){
            $konekcija= BP_PHP::getInstanca();
            if($id!=NULL){
                if($password_hash!=NULL){
                    $this->db->set('Pasword_hash', $pasword_hash);   
                }
                if($admin!=NULL){
                   $this->db->set('Admin', $admin);
                }
                if($opis!=NULL){
                   $this->db->set('Opis', $opis);
                }
                $this->db->where("idKorisnika",$id);
                $this->db->update("Korisnik");
            }  
        }
    }   
    
?>

