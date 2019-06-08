<?php
   //2016/0262 Djordje Arsic 
    class ModelBlokiranje extends CI_Model{
        public $blokiranje;
        
        public function __construct() {
            parent::_construnct();
            $this->blokiranje = NULL;
        }
           
        public function daLiImaBlokiranja($blokirao=NULL, $blokiran=NULL){
            if($blokirao!=NULL && $blokiran!=NULL){
                $this->db->where('Blokirao',$blokirao);
                $this->db->where('Blokiran',$blokiran);
                $upit=$this->db->get('Blokiranje');
                $rezultat=$upit->result();
                if($rezultat==NUlL){
                    return TRUE;
                }
                else{
                    return FALSE;
                }
            }
                return NULL;
             
        }
        
        public function dodajBlokiranje($blokira,$blokiran){
            if($blokira!=NULL && $blokiran!=NULL){
                    $this->db->set("Blokirao", $blokira);
                    $this->db->set("Blokiran", $blokiran);
                    $this->db->insert("Blokiranje");
            }
        }
        public function ukoniBlokirao($blokirao, $blokiran){
            $this->db->where("Blokiran",$blokirao);
            $this->db->where("Blokirao",$blokiran);
            $this->db->delete("Blokiranje");
        }
    }
?>