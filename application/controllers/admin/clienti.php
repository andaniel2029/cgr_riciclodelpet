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
 * @copyright (c) 19-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Clienti extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login = $this->session->userdata('auth');
        if ($login != 'si') {
            redirect('errors/error_404');
        }
        $this->load->model('clienti_m', 'model');
    }

    /**
     * 
     */
    public function index() {
        $dati = array();

        $dati['elenco'] = $this->model->elenco_clienti('cliente');



        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/clienti_v', $dati);
        $this->load->view('admin/admin_footer_view');
    }

    public function aggiungi_cliente() {
        $dati = array();
        $dati['aggiungi'] = $this->model->aggiungi_clienti_form_admin();

        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/clienti_aggiungi_view', $dati);
        $this->load->view('admin/admin_footer_view');
    }

    public function inserisci() {
        $this->load->model('clienti_m', 'model');

       


        $tipo = htmlspecialchars(trim($this->input->post('tipo')));
        $categoria = htmlspecialchars(trim($this->input->post('categoria')));
 
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


        echo $this->model->inserisci_cliente_admin(
                $tipo, $categoria,  $rag_soc, $indirizzo, $citta, $provincia, $nazione, $piva, $telefono, $web, $nome, $cognome, $email, $password, $password2);
   
        }

    public function modifica($id) {
        if (!is_numeric($id)) {
            die();
        }
        $dati['form_modifica'] = $this->model->modifica_clienti_form($id);
        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/clienti_modifica_view', $dati);
        $this->load->view('admin/admin_footer_view');
    }

    public function ricevi_modifica() {
        $this->load->model('clienti_m', 'model');

       


        $tipo = trim($this->input->post('tipo'));
        $categoria = trim($this->input->post('categoria'));
 
        $rag_soc = trim($this->input->post('rag_soc'));
        $indirizzo = trim($this->input->post('indirizzo'));
        $citta = trim($this->input->post('citta'));
        $provincia = trim($this->input->post('provincia'));
        $nazione = trim($this->input->post('nazione'));
        $piva = trim($this->input->post('piva'));
        $telefono = trim($this->input->post('telefono'));
        $web = trim($this->input->post('web'));
        $nome = trim($this->input->post('nome'));
        $cognome = trim($this->input->post('cognome'));
        $email = trim($this->input->post('email'));
        $password = trim($this->input->post('password'));
        $password2 = trim($this->input->post('password2'));
        $id = trim($this->input->post('id'));

        echo $this->model->modifica_cliente_admin(
                $tipo, $categoria,  $rag_soc, $indirizzo, $citta, $provincia, $nazione, $piva, $telefono, $web, $nome, $cognome, $email, $password, $password2,$id);
   
    }

    public function elimina($id) {
        if (!is_numeric($id))
            die('restricted');

        $sql = "DELETE FROM anagrafica WHERE id=?";
        $this->db->query($sql, $id);
        redirect('admin/clienti');
    }

}

