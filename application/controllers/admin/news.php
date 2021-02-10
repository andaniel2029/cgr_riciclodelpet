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
 * @copyright (c) 19-giu-2013, Diego Bellati diego@ranaridens.com
 */
class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login = $this->session->userdata('auth');


        if ($login != 'si') {
            redirect('errors/error_404');
        }
        $this->load->model('news_m', 'model');
        $this->load->model('gallery_m', 'gallery');
    }

    public function index() {

        $dati['form_inserimento'] = $this->model->form_inserimento();
        $dati['all_news'] = $this->model->all_news();
        $dati['anteprime'] = $this->gallery->url() . br() . $this->gallery->anteprime();

        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/news_v', $dati);
        $this->load->view('admin/admin_footer_view');
    }

    public function inserisci() {
        $titolo = $this->input->post('titolo');
        $contenuto = $this->input->post('contenuto');
        $now = time();

        $sql = "INSERT INTO news (titolo,descrizione,inserimento)VALUES(?,?,?)";
        $this->db->query($sql, array($titolo, $contenuto, $now));
        redirect('admin/news');
    }

    public function elimina($id) {
        $id = (int) $id;
        $sql = "DELETE FROM news WHERE id=?";
        $this->db->query($sql, array($id));

        redirect('admin/news');
    }

    public function pubblicato() {
        if (!$this->input->is_ajax_request()) {
            die('Restricted');
        }
        $id = (int) $this->input->post('id');
        if ($id == 0) {
            die('Restricted');
        }
        $attivo = htmlspecialchars(trim($this->input->post('attivo')));

        if ($attivo == 0) {
            $attivo = 1;
        } else {
            $attivo = 0;
        }
        $sql = "UPDATE news SET attivo=? WHERE id =?";
        $this->db->query($sql, array($attivo, $id));

        echo $attivo;
    }

    public function modifica($id) {
        if (!is_numeric($id)) {
            die();
        }

        $sql = "SELECT * FROM news WHERE id = ?";
        $ris = $this->db->query($sql, array($id))->row_array();

        $dati['form_inserimento'] = $this->model->form_inserimento($ris);
        $dati['all_news'] = $this->model->all_news();
        $dati['anteprime'] = $this->gallery->url() . br() . $this->gallery->anteprime();

        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/news_v', $dati);
        $this->load->view('admin/admin_footer_view');
    }

    public function salva_modifica() {
        $titolo = $this->input->post('titolo');
        $contenuto = $this->input->post('contenuto');
        $id=$this->input->post('id');
        

        $sql = "UPDATE  news SET titolo=?,descrizione= ? WHERE id = ?";
        $this->db->query($sql, array($titolo,$contenuto,$id));
        redirect('admin/news');
    }

}

