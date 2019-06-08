<?php
	//2016/0262 Djordje Arsic 
    class Muzika extends CI_Model{
        public $muzika;
        
        public function __get($placeholder) {
            return $this->$placeholder;
        }
        
        public function __construct($idMuzike, $autor, $naslov, $opis, $vreme) {
            parent::_construnct();
            $this->muzika=NULL;
        }
        
        public function  pretraga($info){
            $this->db->like("naslov", $info);
            $this->db->or_like("autor", $info);
            $this->db->or_like("opis", $info);
            $this->db->from("Muzika");
            $this->db->order_by("Vreme");
            return $this->db->get();
        }
        
        
        public function  dohvatiMuziku($idM){
            $rezultat = $this->db->where('idMuzike',$idM)->get('Muzika');
            $muzika = $rezultat->row();
            if ($muzika!=NULL) {
                $this->muzika=$muzika;
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
        public function sacuvajMuziku(){
            $this->db->set('Autor', $autor);
            $this->db->set('Naslov', $naslov);
            $this->db->set('Opis', $opis);
            $this->db->set('Vreme', $vreme);
            $this->db->insert("Muzika");
        }
        
        public function ukoniMuziku($idM){
            $this->db->where("idMuzike", $idM);
            $this->db->delete("Muzika");
        }
        
        public  function izmenaKorisnika($id, $opis=NULL, $naslov=NULL){
            $konekcija= BP_PHP::getInstanca();
            if($id!=NULL){
                if($naslov!=NULL){
                   $this->db->set('Naslov', $naslov);
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

