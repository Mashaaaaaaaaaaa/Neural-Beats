<?php
    //2016/0262 Djordje Arsic, Janko Kitanovic
    class ModelKorisnik extends CI_Model{
        public $korisnik;
        
        
        public function __construct() {
            parent::__construct();
        }
        
        public function __toString() {
            return $this->korisnik;
        }
        
        public function dohvatiKorisnika($username){
        $result=$this->db->where('Username',$username)
                    ->get('korisnik');
        $this->korisnik=$result->row();
        if($this->korisnik==NULL){
            return false;
        }
        return true;
        }
        
        /*public function daLiJeAdmin($username){
        $result=$this->db->where('username',$username)
                    ->get('autor');
        $this->autor=$result->row();
        if($this->autor==NULL){
            return false;
        }
        return true;
        }*/
        
        public function proveriPassword($lozinka){
            return $this->korisnik->Password==$lozinka;
        }
        
        /*public function dohvatiSveKorisnike(){
            return $this->db->get('Korisnik')->result();
        }*/
        
        /*public function sacuvajKorisnika($pasword_hash=NULL, $username=NULL, $email=NULL, $admin=NULL, $opis=NULL){
           $this->db->set('Pasword_hash', $pasword_hash);
            $this->db->set('Username', $username);
            $this->db->set('Email', $email);
            $this->db->set('Administrator', $admin);
            $this->db->set('Opis', $opis);
            $this->db->insert("Korisnik");
        }*/
        
        /*public  function ukloniKorisnika($username){
            $this->db->where('Username', $username);
            $this->db->delete("Korisnik");
        }*/
        
        /*public  function izmenaKorisnika($id,$password_hash=NULL, $admin=NULL, $opis=NULL){
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
        }*/
    }   
    
?>

