<?php
class UzytkownicyModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function sprawdz() {
    if(!$this->session->userdata('zalogowany')) redirect(site_url());
  }

  public function jestZalogowany() {
    if($this->session->userdata('zalogowany')) return true;
    else return false;
  }

  public function dodajUzytkownika() {
    $tab=array(
      'id'=>null,
      'imie'=>$this->input->post('imie'),
      'nazwisko'=>$this->input->post('nazwisko'),
      'login'=>$this->input->post('login'),
      'haslo'=>md5($this->input->post('haslo'))
    );
    if($this->db->insert('uzytkownicy',$tab)) $this->session->set_flashdata('komunikat','Rejestracja przebiegła pomyślnie');
    else $this->session->set_flashdata('komunikat','Błąd, nie udało się zarejestrować');
  }

  public function zaloguj() {
    $tab=array(
      'login'=>$this->input->post('login'),
      'haslo'=>md5($this->input->post('haslo'))
    );
    if(($wynik=$this->db->get_where('uzytkownicy',$tab)->row_array())) {
      $this->session->set_userdata(array(
        'zalogowany'=>true,
        'id'=>$wynik['id'],
        'login'=>$wynik['login'],
        'imie'=>$wynik['imie'],
        'nazwisko'=>$wynik['nazwisko']));
    }
    else $this->session->set_flashdata('komunikat','Złe dane.');
  }

  public function wyloguj() {
    $tab=array('zalogowany','id','login','imie','nazwisko');
    $this->session->unset_userdata($tab);
    redirect(site_url());
  }
}
