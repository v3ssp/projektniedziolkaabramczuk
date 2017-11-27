<?php
class Rejestracja extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model('uzytkownicyModel');
  }

  public function index() {
    if($this->uzytkownicyModel->jestZalogowany()) redirect(site_url());
    $this->form_validation->set_rules('imie','Imie','trim|required|alpha');
    $this->form_validation->set_rules('nazwisko','Nazwisko','trim|required|alpha');
    $this->form_validation->set_rules('login','Login','trim|required|is_unique[uzytkownicy.login]');
    $this->form_validation->set_rules('haslo','Hasło','trim|required');
    $this->form_validation->set_rules('powtorzHaslo','Powtórz hasło','trim|required|matches[haslo]');
    if($this->form_validation->run()) {
      $this->uzytkownicyModel->dodajUzytkownika();
      $data['tytul']='Status rejestracji';
      $this->load->view('szablon/start',$data);
      $this->load->view('szablon/menu');
      $this->load->view('szablon/komunikat');
      $this->load->view('szablon/koniec');
    }
    else {
      $data['tytul']='Rejestracja';
      $this->load->view('szablon/start',$data);
      $this->load->view('szablon/menu');
      $this->load->view('rejestracja/index');
      $this->load->view('szablon/koniec');
    }
  }
}
