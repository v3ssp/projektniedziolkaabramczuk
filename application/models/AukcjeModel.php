<?php
class AukcjeModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function wczytajRodzaje() {
    return $this->db->get('rodzaje')->result_array();
  }

  public function wczytajRodzaj($nazwa=false) {
    return $this->db->get_where('rodzaje',array('nazwa'=>"$nazwa"))->row_array();
  }

  public function wczytajWszystkieAukcje($obiekt=false) {
    $this->db->order_by('id','desc');
    if($obiekt) return $this->db->get_where('aukcje',array('idRodzaju'=>$obiekt['id'],'aktywne'=>true))->result_array();
    else return $this->db->get_where('aukcje',array('aktywne'=>true))->result_array();
  }

  public function wczytajAukcje($id) {
    return $this->db->get_where('aukcje',array('id'=>$id))->row_array();
  }
}
