<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pannello
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 3-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Pannello extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login = $this->session->userdata('auth');

        
        if ($login != 'si') {
            redirect('errors/error_404');

        }
    }

    /**
     * 
     */
    public function index() {
$this->load->helper('string');
echo random_string('alnum',20);
echo md5(random_string('alnum',20));
        $dati=array();

        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/admin_home_view');
        $this->load->view('admin/admin_footer_view');
    }

}

