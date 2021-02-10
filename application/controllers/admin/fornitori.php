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
 * @copyright (c) 19-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Fornitori extends CI_Controller {

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
                $dati['elenco'] = $this->model->elenco_clienti('fornitore');



        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/fornitori_v', $dati);
        $this->load->view('admin/admin_footer_view');
    }

}

