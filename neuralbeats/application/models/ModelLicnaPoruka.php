<?php
    //2016/0262 Djordje Arsic 
    class Licna_Poruka extends CI_Model{
        public $licnapruka;
       
         public function dohvatiLicnuPoruku($idL){
            $rezultat = $this->db->where('idKomentara',$idL)->get('Licna_poruka');
            $licnaporuka = $rezultat->row();
            if ($licanaporuka!=NULL) {
                $this->licnaporuka=$licnaporuka;
                return TRUE;
            } else {
                return FALSE;
            }    
        }
        
        
        public function __construct($idLicnePoruke, $Primalac) {
            parent::
            $this->licnaporuka=NULL;
        }

        public function sacuvajLicnuPoruku($idLicnePoruke, $primalac){
            $this->db->set("idLicnePoruke",$idLicnePoruke);
            $this->db->set("Primalac", $primalac);
            $this->db->insert("Komentar");
        }
        
        public function dohvatiLicnePorukezaKorisnika($idK){
            $this->where("L.idLicne_Poruke=P.idPoruke");
            $this->where("L.Prialac",$idK);
            $this->from("Licna_poruka L, Poruka P");
            $this->db->order_by("P.Vreme", "desc");
            $this->db->select("P.*");
            return $upit=$this->db->get();  
        }
        
        public function dohvatiLicnePorukeodKorisnika($idK){
            $this->where("L.idLicne_Poruke=P.idPoruke");
            $this->where("P.Posiljalac",$idK);
            $this->from("Licna_poruka L, Poruka P");
            $this->db->select("P.*");
            $this->db->order_by("P.Vreme", "desc");
            return $upit=$this->db->get();  
        }
        
        public function obrisiLicnuPoruku($id){
            if($id!=NULL){
                $this->db->where("idKomentara",$id);
                $this->db->delete("Komentar");
            }   
        }
    }



