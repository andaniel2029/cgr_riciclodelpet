<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fornitori
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 23-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Fornitori extends CI_Controller {

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
            
        $head_data=array();
        $head_data['titolo']='CGR -'.'Fornitori';
        $head_data['meta_tag']='fornitori';
        $head_data['meta_description']='fornitori';
//                   $dati['statica'] = $this->get_statiche_m->page('fornitori', $lang);
        $dati['form_header']=$this->frontend->get_form_header(); 
        $dati['flags_header']=$this->frontend->get_flags_header(); 
                $lang=$this->frontend->get_lang_menu(); 
        $count=1;
        foreach ($lang as  $value) {
            $dati['menu'.$count]=$value;
            $count++;

        }
//        echo md5('cgr2013');
                $this->load->view('head',$head_data);
		$this->load->view('fornitori_header_view',$dati);
                        if($lang_test=='en')
        {
     
  $this->load->view('fornitori_view_1');
        }
        else
        {
$this->load->view('fornitori_view');
            
        }
		

		$this->load->view('footer');
    }

}

