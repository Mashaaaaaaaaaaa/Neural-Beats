<?php
	//2016/0262 Djordje Arsic 
    class Poruka{
        public $poruka;
        
        public function __construct($idPoruke, $posiljalac, $sadrzaj, $vreme, $tip) {
            parent::__construct();
            $this->poruka=NULL;
        }
        
        public function sacuvajPoruku($poruka){
                    $this->db->set("Posiljalac", $blokira);
                    $this->db->set("Sadrzaj", $blokira);
                    $this->db->set("Vreme", $blokiran);
                    $this->db->insert("Poruka");
        }
        
         public function obrisiPoruku($id){
           $this->db->set("idPoruka", $id);
           $this->db->delete("Poruka");
        }
        
        public function dohvatiSadrzajPoruke($id){
            $this->db->where("idPoruke",$id);
            $this->db->where("Poruka");
            $this->db->select("Sadrzaj");
            return $this->db->get();
        }
        
        public function dohvatiPoruku($idP){
            $rezultat = $this->db->where('idPoruke',$idP)->get('Korisnik');
            $poruka = $rezultat->row();
            if ($poruka!=NULL) {
                $this->poruka=$poruka;
                return TRUE;
            } else {
                return FALSE;
            }    
        }
    }
?>

