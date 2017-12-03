<?php
class ProfilModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function jestWlascicielem($id) { //dziala
    return $this->db->get_where('aukcje',array('id'=>$id,'idUzytkownika'=>$this->session->userdata('id')))->result_array();
  }

  public function wczytajAukcje() { //dziala
    return $this->db->get_where('aukcje',array('aktywne'=>true,'idUzytkownika'=>$this->session->userdata('id')))->result_array();
  }

  public function wczytajHistorie() { //dziala
    return $this->db->get_where('aukcje',array('aktywne'=>false,'idWygrywajacego'=>$this->session->userdata('id')))->result_array();
  }

  public function usun($id) { //dziala
    $this->db->delete('aukcje',array('id'=>$id));
  }

  public function dodajAukcje() { //dziala
    $zdj=$_FILES['zdjecie'];
    $sciezka='zdjecia/'.$this->input->post('nazwa').'_'.date('YmdHis');
    $tmp=$zdj['tmp_name'];
    $name=$zdj['name'];
    $koniec = pathinfo($name,PATHINFO_EXTENSION);
    if(is_uploaded_file($tmp)) {
      $sciezka=$sciezka.'.'.$koniec;
      if(!move_uploaded_file($tmp,$sciezka)) $sciezka='';
    }
    else $sciezka='';
    $insert=array(
      'idRodzaju'=>$this->input->post('rodzaj'),
      'idUzytkownika'=>$this->session->userdata('id'),
      'idWygrywajacego'=>$this->session->userdata('id'),
      'nazwa'=>$this->input->post('nazwa'),
      'opis'=>$this->input->post('opis'),
      'cena'=>$this->input->post('cena'),
      'minimalnaCena'=>$this->input->post('minimalnaCena'),
      'zmianaCeny'=>$this->input->post('zmianaCeny'),
      'aktywne'=>true,
      'doKiedy'=>$this->input->post('doKiedy').' 22:00:00',
      'zdjecie'=>$sciezka
    );
    return $this->db->insert('aukcje',$insert);
  }
}
