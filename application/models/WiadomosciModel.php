<?php
class WiadomosciModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function wczytajRozmowy() {
    $id=$this->session->userdata('id');
    $this->db->where("idNadawcy='$id' or idOdbiorcy='$id'");
    $wiadomosci=$this->db->get('wiadomosci')->result_array();
    foreach($wiadomosci as $a) {
      if($a['idNadawcy']==$this->session->userdata('id')) $rozmowy[]=$a['idOdbiorcy'];
      else $rozmowy[]=$a['idNadawcy'];
    }
    $rozmowy=array_unique($rozmowy, SORT_REGULAR);
    if($rozmowy) {
      $this->db->where_in('id',$rozmowy);
      return $this->db->get('uzytkownicy')->result_array();
    }
    else return false;
  }

  public function wczytajWiadomosci($id) {
    $idU=$this->session->userdata('id');
    $this->db->order_by('data','desc');
    $this->db->where("(idNadawcy='$id' and idOdbiorcy='$idU') or (idNadawcy='$idU' and idOdbiorcy='$id')");
    return $this->db->get('wiadomosci')->result_array();
  }

  public function wyslijWiadomosc($id) {
    $insert=array(
      'idNadawcy'=>$this->session->userdata('id'),
      'idOdbiorcy'=>$id,
      'tresc'=>$this->input->post('wiadomosc')
    );
    if($this->db->insert('wiadomosci',$insert))   $this->session->set_flashdata('komunikat','Wysłano wiadomość');
    else $this->session->set_flashdata('komunikat','Nie udało się wysłać wiadomości');
  }
}
