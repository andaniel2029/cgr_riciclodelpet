<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clienti
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 23-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Clienti extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('frontend_m', 'frontend');
//        $this->load->model('get_statiche_m', 'get_statiche_m');
    }

    /**
     * 
     */
    public function index() {
        //lingua
        $lang_test = $this->session->userdata('lang');
        $lang="";
        if ($lang_test == 'en') {
            $lang = 'en';
        }
        else{
            $lang = 'it';
        }
        // /lingua

        $head_data = array();
        $head_data['titolo'] = 'CGR -' . 'Clienti';
        $head_data['meta_tag'] = 'clienti';
        $head_data['meta_description'] = 'clienti';

        $dati['form_header'] = $this->frontend->get_form_header();
        $dati['flags_header'] = $this->frontend->get_flags_header();
//        $dati['statica'] = $this->statiche_m->page('clienti', $lang);
//        $dati['statica'] = $this->get_statiche_m->page('clienti', $lang);
        $lang = $this->frontend->get_lang_menu();
        $count = 1;
        foreach ($lang as $value) {
            $dati['menu' . $count] = $value;
            $count++;
        }
//        echo md5('cgr2013');
        $this->load->view('head', $head_data);
        $this->load->view('clienti_header_view', $dati);
                if ($lang_test == 'en') {

      $this->load->view('clienti_view_1');
        } else {
    $this->load->view('clienti_view');
        }
    

        $this->load->view('footer');
    }
    
    
    
    
    
    
    
    
    public function inserisci() {
  
        $this->load->model('clienti_m', 'model');

        if (!$this->input->is_ajax_request()) {
            die();
        }



   $tipo = htmlspecialchars(trim($this->input->post('tipo')));
   $categoria = htmlspecialchars(trim($this->input->post('categoria')));
   $privacy = htmlspecialchars(trim($this->input->post('privacy')));
  $rag_soc = htmlspecialchars(trim($this->input->post('rag_soc')));
  $indirizzo = htmlspecialchars(trim($this->input->post('indirizzo')));
  $citta = htmlspecialchars(trim($this->input->post('citta')));
  $provincia = htmlspecialchars(trim($this->input->post('provincia')));
  $nazione = htmlspecialchars(trim($this->input->post('nazione')));
   $piva = htmlspecialchars(trim($this->input->post('piva')));
   $telefono = htmlspecialchars(trim($this->input->post('telefono')));
  $web = htmlspecialchars(trim($this->input->post('web')));
   $nome = htmlspecialchars(trim($this->input->post('nome')));
   $cognome = htmlspecialchars(trim($this->input->post('cognome')));
   $email = htmlspecialchars(trim($this->input->post('email')));
   $password = htmlspecialchars(trim($this->input->post('password')));
   $password2 = htmlspecialchars(trim($this->input->post('password2')));


        echo $this->model->inserisci_cliente(
                                    $tipo,
                    $categoria,
                    $privacy,
                   $rag_soc,
                   $indirizzo,
                   $citta,
                   $provincia,
                   $nazione,
                    $piva,
                    $telefono,
                   $web,
                    $nome,
                    $cognome,
                    $email,
                    $password,
                    $password2);

                
        }


}

