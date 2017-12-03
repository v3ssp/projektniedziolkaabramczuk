<?php
class Profil extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('aukcjeModel');
    $this->load->model('profilModel');
    $this->load->model('uzytkownicyModel');
  }

  public function index() {
    $this->uzytkownicyModel->sprawdz();
    $data['tytul']='Mój profil';
    $this->load->view('szablon/start',$data);
    $this->load->view('szablon/menu');
    $this->load->view('profil/index');
    $this->load->view('szablon/koniec');
  }

  public function wyloguj() {
    $this->uzytkownicyModel->wyloguj();
    redirect(site_url());
  }
  //Monia

  public function usun($id=false) { //dziala
    if(!$id) show_404();
    $this->uzytkownicyModel->sprawdz();
    if(!$this->profilModel->jestWlascicielem($id)) redirect('profil');
    $this->profilModel->usun($id);
    redirect('profil/aukcje');
  }

  public function dodaj() { //dziala
    $this->uzytkownicyModel->sprawdz();
    $this->form_validation->set_rules('nazwa','Nazwa','trim|required');
    $this->form_validation->set_rules('rodzaj','Rodzaj','required');
    $this->form_validation->set_rules('opis','Opi"','trim|required');
    $this->form_validation->set_rules('cena','Cena','trim|required|greater_than_equal_to[0.01]');
    $this->form_validation->set_rules('minimalnaCena','Cena','trim|required|greater_than_equal_to[0.01]');
    $this->form_validation->set_rules('zmianaCeny','Cena','trim|required|greater_than_equal_to[0.01]');
    $this->form_validation->set_rules('doKiedy','Do kiedy','trim|required');
    $data['tytul']='Dodaj aukcję';
    if($this->form_validation->run()) {
      if($this->profilModel->dodajAukcje()) redirect('profil/aukcje');
      else redirect('profil/dodaj');
    }
    else {
      $data['rodzaje']=$this->aukcjeModel->wczytajRodzaje();
      $this->load->view('szablon/start',$data);
      $this->load->view('szablon/menu');
      $this->load->view('profil/dodaj');
      $this->load->view('szablon/koniec');
    }
  }

  public function aukcje() { //dziala
    $this->uzytkownicyModel->sprawdz();
    $data['aukcje']=$this->profilModel->wczytajAukcje();
    $data['tytul']='Moje aukcje';
    $data['usuwanie']=true;
    $this->load->view('szablon/start',$data);
    $this->load->view('szablon/menu');
    $this->load->view('profil/lista');
    $this->load->view('szablon/koniec');
  }

  public function historia() { //dziala
    $this->uzytkownicyModel->sprawdz();
    $data['aukcje']=$this->profilModel->wczytajHistorie();
    $data['tytul']='Historia';
    $data['usuwanie']=false;
    $this->load->view('szablon/start',$data);
    $this->load->view('szablon/menu');
    $this->load->view('profil/lista');
    $this->load->view('szablon/koniec');
  }
}
