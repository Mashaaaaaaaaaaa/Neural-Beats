<?php

    class ModelKomentar extends CI_Model{
        public $komentar;

        public function __construct($zaMuziku, $idKomentara) {
                parent::__construct();
                $this->komentar=NULL;
        }
        
        public function sacuvajKomentar($idKomentara,$zaMuziku){
            $this->db->set("idKomentatra",$idKomentara);
            $this->db->set("ZaMuziku", $zaMuziku);
            $this->db->insert("Komentar");
        }
        
         public function dohvatiKomentar($idK){
            $rezultat = $this->db->where('idKomentara',$idK)->get('Komentar');
            $komentar = $rezultat->row();
            if ($komentar!=NULL) {
                $this->komentar=$komentar;
                return TRUE;
            } else {
                return FALSE;
            }    
        }
        
        public function obrisiKomentar($id=NULL){
            if($id!=NULL){
                $this->db->where("idKomentara",$id);
                $this->db->delete("Komentar");
            }        
        }
        
        public function dohvatiKomentareKorisnika($idK){
            $this->db->select("P.*");
            $this->where("K.idKomentara=P.idPoruke");
            $this->where("P.Posiljalac",$idK);
            $this->from("Komentar K, Poruka P");
            $this->db->order_by("P.Vreme", "desc");
            return $upit=$this->db->get();
        }
        
        public function dohvatiKomentareZaMuziku($idM){
            $this->db->select("P.*");
            $this->where("K.idKomentara=P.idPoruke");
            $this->where("K.zaMuziku",$idM);
            $this->from("Komentar K, Poruka P");
            $this->db->order_by("P.Vreme", "desc");
            return $upit=$this->db->get();
        }
        
        
    }
