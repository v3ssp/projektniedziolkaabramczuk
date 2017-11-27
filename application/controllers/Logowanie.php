<?php
class Logowanie extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('uzytkownicyModel');
  }

  public function index() {
    if($this->uzytkownicyModel->jestZalogowany()) redirect(site_url());
    $this->form_validation->set_rules('login','Login','trim|required');
    $this->form_validation->set_rules('haslo','Hasło','trim|required');
    if($this->form_validation->run()) $this->uzytkownicyModel->zaloguj();
    $data['tytul']='Logowanie';
    $this->load->view('szablon/start',$data);
    $this->load->view('szablon/menu');
    $this->load->view('logowanie/index');
    $this->load->view('szablon/komunikat');
    $this->load->view('szablon/koniec');
  }
}
