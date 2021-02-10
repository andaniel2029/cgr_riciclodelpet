<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     */
    public function index() {

        $this->load->view('login/login_view');
    }

    public function auth() {

        if (!isset($_POST['pswd'])) {
            redirect('admin/login');
        } else {
            if ($this->session->userdata('auth') == 'si') {
                redirect('admin/pannello');
            } else {
                $pswd = md5(trim($this->input->post('pswd')));
                //cgr2013
                if ($pswd == 'b177d94042c288de250c94c2f74e5529') {
                    $this->session->set_userdata(array('auth' => 'si'));
                    redirect('admin/pannello');
                } else {
                    redirect('admin/login');
                }
            }
        }
    }

    public function logout() {

        $this->session->sess_destroy();
        redirect('/admin/login');
    }

}

