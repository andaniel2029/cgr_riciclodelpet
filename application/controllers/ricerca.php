<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of produzione
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 23-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Ricerca extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ricerca_m', 'ricerca');
        $this->load->model('frontend_m', 'frontend');
        if($this->session->userdata('tipo')!='cliente' || $this->session->userdata('autorizzato') != 'si')
        {
            redirect('/');
        }
        
    }

    public function index() {
        //lingua
        $lang_test = $this->session->userdata('lang');
        $lang = "";
        if ($lang_test == 'en') {
            $lang = 'en';
        } else {
            $lang = 'it';
        }
        // /lingua
        $head_data = array();
        $head_data['titolo'] = 'CGR -' . 'Search results';
        $head_data['meta_tag'] = 'ricerca,risultati';
        $head_data['meta_description'] = 'produzione';
//                   $dati['statica'] = $this->get_statiche_m->page('produzione', $lang);
        $lang = $this->frontend->get_lang_menu();
        $count = 1;
        foreach ($lang as $value) {
            $dati['menu' . $count] = $value;
            $count++;
        }

        $dati['form_header'] = $this->frontend->get_form_header();
        $dati['flags_header'] = $this->frontend->get_flags_header();
//        echo md5('cgr2013');
        $this->load->view('head', $head_data);
        $this->load->view('welcome_header_view', $dati);
        
        $risultati=array();
        if (isset($_POST['ricerca'])) {
            $ris = $this->ricerca->ricerca($this->input->post('ricerca'));
           $risultati['tab']= $ris;  

        } else {
            $risultati['tab'] = 'Nessun risultato';
        }

$this->load->view('ricerca_view',$risultati);

        $this->load->view('footer');
    }

}