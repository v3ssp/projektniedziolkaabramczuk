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

  public function wczytajAukcje($id) {
    return $this->db->get_where('aukcje',array('id'=>$id))->row_array();
  }

  public function wczytajWszystkieAukcje($obiekt=false) {
    $this->db->order_by('id','desc');
    if($obiekt) return $this->db->get_where('aukcje',array('idRodzaju'=>$obiekt['id'],'aktywne'=>true))->result_array();
    else return $this->db->get_where('aukcje',array('aktywne'=>true))->result_array();
  }

  public function aktywna($id) {
    return $this->db->get_where('aukcje',array('id'=>$id,'aktywne'=>true))->row_array();
  }

  public function kup($id) { //dziala
    $aukcja=$this->db->get_where('aukcje',array('id'=>$id))->row_array();
    $powiadomienia=array(
      'idUzytkownika'=>$aukcja['idUzytkownika'],
      'idAukcji'=>$id,
      'tresc'=>'Aukcja zakończona'
    );
    $this->db->trans_start();
    $this->db->insert('powiadomienia',$powiadomienia);
    $set=array(
      'idWygrywajacego'=>$this->session->userdata('id'),
      'aktywne'=>false
    );
    $where=array('id'=>$id);
    $this->db->where('idRodzaju!=1 and idRodzaju!=2');
    $this->db->update('aukcje',$set,$where);
    $this->db->trans_complete();
    if($this->db->trans_status()) {
      $this->session->set_flashdata('komunikat','Udało Ci się wygrać aukcję. Skontaktuj się ze sprzedającym w celu ustalenia dalszych działań.');
      return true;
    }
    else {
      $this->session->set_flashdata('komunikat','Nie udało się wygrać aukcji bądź wystąpił błąd. Spróbuj ponownie.');
      return false;
    }
  }

  public function podbij($id) { //dziala
    $aukcja=$this->db->get_where('aukcje',array('id'=>$id))->row_array();
    $powiadomienia=array(
      array(
        'idUzytkownika'=>$aukcja['idUzytkownika'],
        'idAukcji'=>$id,
        'tresc'=>'Zmiana ceny na aukcji'
      ),
      array(
        'idUzytkownika'=>$aukcja['idWygrywajacego'],
        'idAukcji'=>$id,
        'tresc'=>'Zostałeś przebity'
      )
    );
    $this->db->trans_start();
    $this->db->insert_batch('powiadomienia',$powiadomienia);
    $set=array(
      'idWygrywajacego'=>$this->session->userdata('id'),
      'cena'=>$this->input->post('cena')
    );
    $where=array('id'=>$id);
    $this->db->where("idRodzaju!='3'");
    $this->db->update('aukcje',$set,$where);
    $this->db->trans_complete();
    if($this->db->trans_status()) {
      $this->session->set_flashdata('komunikat','Podbito aukcję.');
      return true;
    }
    else {
      $this->session->set_flashdata('komunikat','Nie udało się podbić aukcji. Spróbuj ponownie.');
      return false;
    }
  }

  public function napiszWiadomosc($id) { //dziala
    $tab=array(
      'idNadawcy'=>$this->session->userdata('id'),
      'idOdbiorcy'=>$id,
      'tresc'=>$this->input->post('wiadomosc'),
      'data'=>date('Y-m-d H:i:s')
    );

    if($this->db->insert('wiadomosci',$tab)) $this->session->set_flashdata('komunikat','Wiadomość wysłana.');
    else $this->session->set_flashdata('komunikat','Nie udało się wysłać wiadomości. Spróbuj ponownie.');
  }
}
