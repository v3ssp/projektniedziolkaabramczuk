<?php
class Wiadomosci extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model('uzytkownicyModel');
    $this->load->model('wiadomosciModel');
  }

  public function index() {
    $this->uzytkownicyModel->sprawdz();
    $data['rozmowy']=$this->wiadomosciModel->wczytajRozmowy();
    $data['wiadomosci']=false;
    $data['id']=false;
    $data['tytul']='Wiadomości';
    $this->load->view('szablon/start',$data);
    $this->load->view('szablon/menu');
    $this->load->view('wiadomosci/index');
    $this->load->view('szablon/komunikat');
    $this->load->view('szablon/koniec');
  }

  public function rozmowa($id=false) {
    if(!$id) show_404();
    $this->uzytkownicyModel->sprawdz();
    $this->form_validation->set_rules('wiadomosc','Wiadomość','trim|required');
    if($this->form_validation->run()) {
      $this->wiadomosciModel->wyslijWiadomosc($id);
      redirect('wiadomosci/rozmowa/'.$id);
    }
    $data['rozmowy']=$this->wiadomosciModel->wczytajRozmowy();
    $data['wiadomosci']=$this->wiadomosciModel->wczytajWiadomosci($id);
    $data['id']=$id;
    $data['tytul']='Rozmowa';
    if(!$data['wiadomosci']) {
      $this->load->view('szablon/start',$data);
      $this->load->view('szablon/menu');
      $this->load->view('wiadomosci/brak');
      $this->load->view('szablon/koniec');
    }
    else {
      $this->load->view('szablon/start',$data);
      $this->load->view('szablon/menu');
      $this->load->view('wiadomosci/index');
      $this->load->view('szablon/komunikat');
      $this->load->view('szablon/koniec');
    }
  }
}
