<?php
	//2016/0262 Djordje Arsic 
    class Prati{
        public $prati;
    
        public function __get($placeholder){
            return  $this->$placeholder;
        }
        
        public function __construct($Prati, $Pracen) {
            $this->Prati = $Prati;
            $this->Pracen = $Pracen;
        }
        public function dohvatiSvePratioce($idP){
            $this->db->where("K.idKorisnika=P.Prati");
            $this->db->where("P.Pracen",$idP);
            $this->db->from("Korisnik K, Prati P");
            $this->db->select("K.*");
            return $this->db->get();
        }
        public function dohvatiSveKojePrati($username){
            $this->db->where("K.idKorisnika=P.Pracen");
            $this->db->where("P.Prati",$idP);
            $this->db->from("Korisnik K, Prati P");
            $this->db->select("K.*");
            return $this->db->get();
        }
        public function ukoniPracenje($korisnik_prati, $korisnik_pracen){
             $this->db->where("Prati", $korisnik_prati);
             $this->db->where("Pracen", $korisnik_pracen);
             $this->db->delete("Prati");
        }
        public function dodajPracenje( $korisnik_prati, $korisnik_pracen){
             $this->db->set("Prati", $korisnik_prati);
             $this->db->set("Pracen", $korisnik_pracen);
             $this->db->insert("Prati");
        }
        
        public function daLiPrati($prati, $pracen){
            if(($prati==$this->prati->Prati)&&($thi->prati->$Pracen==$pracen)){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        
        
        public function dohvatiPrati($prati, $pracen){
            $this->db->where('Prati',$idP);
            $this->db->where('Pracen',$idP);
            $rezultat = $this->db->get('Korisnik');
            $pracenje = $rezultat->row();
            if ($pracenje!=NULL) {
                $this->prati=$pracenje;
                return TRUE;
            } else {
                return FALSE;
            }    
        }
    }
?>

