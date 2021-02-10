<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of statiche
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 15-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Statiche extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('statiche_m', 'model');
                $login = $this->session->userdata('auth');

        
        if ($login != 'si') {
            redirect('errors/error_404');

        }
    }

    /**
     * 
     */
    public function index() {

        $dati['form'] = $this->model->form();
        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/statiche_v', $dati);
        $this->load->view('admin/admin_footer_view');
    }

    public function modifica() {
        if (!$this->input->is_ajax_request()) {
            redirect('errors/error_404');
        }

        $home_it = $this->input->post('home_it');
        $home_en = $this->input->post('home_en');
        $clienti_it = $this->input->post('clienti_it');
        $clienti_en = $this->input->post('clienti_en');
        $fornitori_it = $this->input->post('fornitori_it');
        $fornitori_en = $this->input->post('fornitori_en');
        $produzione_it = $this->input->post('produzione_it');
        $produzione_en = $this->input->post('produzione_en');
        $contatti_it = $this->input->post('contatti_it');
        $contatti_en = $this->input->post('contatti_en');
        
        $sql="UPDATE statiche SET
          
            home=?,   
            home_en=?      ,
            clienti =?  ,
            clienti_en =?  ,
            fornitori=? ,
            fornitori_en=? ,
            produzione=?,
            produzione_en=?,
            contatti=?  ,
            contatti_en=?";
        
        $this->db->query($sql,array($home_it,$home_en,$clienti_it,$clienti_en,$fornitori_it,$fornitori_en,$produzione_it,$produzione_en
                ,$contatti_it,$contatti_en));
        
        
        

    }

}

