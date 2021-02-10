<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 23-giu-2013, Diego Bellati diego@ranaridens.com
 */
class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend_m', 'frontend');
    }

    /**
     * crea l'elenco delle news
     */
    public function index() {

//        $this->load->library('email');
//        
//         $config = Array(
//    'protocol' => 'smtp',
//    'smtp_host' => 'smtps.cgr-riciclodelpet.it',
//    'smtp_port' => 465,
//    'smtp_crypto' => 'ssl',
//    'smtp_user' => 'noreply@cgr-riciclodelpet.it',
//    'smtp_pass' => '[9yw1wMA',
//    'mailtype'  => 'html', 
//    'charset'   => 'iso-8859-1'
//);  
//
//        $this->email->from('noreply@cgr-riciclodelpet.it', 'Website automatic');
//        $this->email->to('diego@ranaridens.com');
//        $this->email->subject('Email Test');
//        $this->email->message('Testing the email class.');
//        $this->email->send();
//        $this->email->clear();
//                $this->email->from('noreply@cgr-riciclodelpet.it', 'Website automatic');
//        $this->email->to('bdtech@ranaridens.com');
//        $this->email->subject('Email Test');
//        $this->email->message('Testing the email class.');
//        $this->email->send();
//        
//
//        echo $this->email->print_debugger();


        $lang_test = $this->session->userdata('lang');

        $head_data = array();
        $head_data['titolo'] = 'CGR -' . 'News';
        $head_data['meta_tag'] = 'news';
        $head_data['meta_description'] = 'news';

        $dati['form_header'] = $this->frontend->get_form_header();
        $dati['flags_header'] = $this->frontend->get_flags_header();
        $dati['news'] = $this->frontend->get_news(0);
        $lang = $this->frontend->get_lang_menu();
        $count = 1;
        foreach ($lang as $value) {
            $dati['menu' . $count] = $value;
            $count++;
        }
//        echo md5('cgr2013');
        $this->load->view('head', $head_data);
        $this->load->view('news_header_view', $dati);
        if ($lang_test == 'en') {

            $this->load->view('news_view_1');
        } else {
            $this->load->view('news_view');
        }


        $this->load->view('footer');
    }

    /**
     * 
     * @param type $id
     * visualizza il contenuto di una news
     */
    public function get_full_news($id) {



        $head_data = array();
        $head_data['titolo'] = 'CGR -' . 'News';
        $head_data['meta_tag'] = 'news';
        $head_data['meta_description'] = 'news';

        $dati['form_header'] = $this->frontend->get_form_header();
        $dati['flags_header'] = $this->frontend->get_flags_header();
        $dati['news'] = $this->frontend->read_news($id);
        $lang = $this->frontend->get_lang_menu();
        $count = 1;
        foreach ($lang as $value) {
            $dati['menu' . $count] = $value;
            $count++;
        }
//        echo md5('cgr2013');
        $this->load->view('head', $head_data);
        $this->load->view('news_header_view', $dati);
        $this->load->view('news_view');

        $this->load->view('footer');
    }

}

