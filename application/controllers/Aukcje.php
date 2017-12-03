<?php
class Aukcje extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('uzytkownicyModel');

    $this->load->model('aukcjeModel');
  }

  public function index($nazwa=false) {
    $data['rodzaj']=$this->aukcjeModel->wczytajRodzaj($nazwa);
    $data['tytul']='Aukcje';
    if($data['rodzaj']) $data['tytul'].=' - '.ucfirst($nazwa);
    else $data['tytul']='Aukcje';
    $data['aukcje']=$this->aukcjeModel->wczytajWszystkieAukcje($data['rodzaj']);
    $this->load->view('szablon/start',$data);
    $this->load->view('szablon/menu');
    $this->load->view('aukcje/index');
    $this->load->view('szablon/koniec');
  }

  //Monia

  public function szczegoly($id=false) { //dziala
    if(!$id) show_404();
    if(!($data['aukcja']=$this->aukcjeModel->wczytajAukcje($id))) show_404();
    $data['tytul']=$data['aukcja']['nazwa'];
    $data['sprzedajacy']=$this->db->get_where('uzytkownicy',array('id'=>$data['aukcja']['idUzytkownika']))->row_array();
    if($this->input->post('kup')) {
      if($this->aukcjeModel->aktywna($id)) {
        if($this->aukcjeModel->kup($id)) redirect('aukcje/szczegoly/'.$id);
      }
    }
    elseif($this->input->post('podbij')) {
      if($this->aukcjeModel->aktywna($id)) {
        if($this->aukcjeModel->podbij($id)) redirect('aukcje/szczegoly/'.$id);
      }
    }
    elseif($this->input->post('napisz')) {
      if($this->input->post('wiadomosc')!='') {
        $this->aukcjeModel->napiszWiadomosc($data['sprzedajacy']['id']);
      }
      else $this->session->set_flashdata('komunikat','Wiadomość nie może być pusta');
    }
    $this->load->view('szablon/start',$data);
    $this->load->view('szablon/menu');
    $this->load->view('aukcje/szczegoly');
    $this->load->view('szablon/komunikat');
    $this->load->view('szablon/koniec');
  }
}
