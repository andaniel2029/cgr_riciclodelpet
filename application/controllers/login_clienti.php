<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_clienti
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 24-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Login_clienti extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend_m', 'frontend');
    }

    public function index() {

        die('');
    }

    public function attiva($hash) {
        $scaduti = time() - 345600;

        $sql = "DELETE FROM attivazioni WHERE data < ?";
        $this->db->query($sql, $scaduti);

        $sql = "SELECT * FROM attivazioni WHERE stringa = ?";
        $query = $this->db->query($sql, $hash);
        if ($query->num_rows() == 1) {
            $ris = $query->row_array();
            $sql = "UPDATE anagrafica SET attivo = 1 WHERE id = ?";
            $this->db->query($sql, $ris['anagrafica_id']);
            
            $sql="SELECT * FROM anagrafica WHERE id = ?";
            
            $ana=  $this->db->query($sql,array($ris['anagrafica_id']))->row_array();
            
            $dati_iscrizione =  '<html><head></head><body><p>Un nuovo utente si è registrato online sul sito CGR</p>'.br();
            
            foreach ($ana as $k => $value) {
                if($k=='inserimento')
                {
                $dati_iscrizione .= $k.':  '.date('d-m-Y',$value).br() ;
                    
                }
 else {
     
                $dati_iscrizione .= $k.':  '.$value.br() ;
 }
            }
            $dati_iscrizione .='</body></html>';
            
            
            
                    $this->load->library('email');

            $config = Array(
               'protocol' => 'smtp',
               'smtp_host' => 'smtps.cgr-riciclodelpet.it',
               'smtp_port' => 465,
               'smtp_crypto' => 'ssl',
               'smtp_user' => 'noreply@cgr-riciclodelpet.it',
               'smtp_pass' => '[9yw1wMA',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );

            $this->email->initialize($config);
            $this->email->from('noreply@cgr-riciclodelpet.it', 'CGR Registrazione cliente');
            $this->email->to('alberto.rimini@fastwebnet.it');
            $this->email->subject('Iscrizione cliente da sito CGR');
            $this->email->message($dati_iscrizione);
            $this->email->send();
            

            $this->session->set_userdata(array('email' => $ana['email'], 'autorizzato' => 'si', 'id' => $ana['id'], 'tipo' => $ana['tipo']));

            
  
            
            redirect('/av/visualizza');
            
        } else {
            redirect('errors/error_404');
        }
    }

    public function login() {
        if (!$this->input->is_ajax_request()) {
            die('');
        }

        $username = htmlspecialchars(trim($this->input->post('username')));
        $password = htmlspecialchars(trim($this->input->post('password')));

        $sql = "SELECT * FROM anagrafica WHERE email = ? AND password = ? AND attivo = 1";
        $query = $this->db->query($sql, array($username, md5($password)));



        if ($query->num_rows() == 0) {
            $ris = $query->row_array();
            print_r($ris);
            echo '0';
        } else {
            $ris = $query->row_array();
            $this->session->set_userdata(array('email' => $username, 'autorizzato' => 'si', 'id' => $ris['id'], 'tipo' => $ris['tipo']));
            echo '1';
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function cambia_password($chiave="",$pswd="") {
        $pswd=  htmlspecialchars(urldecode($pswd));
          if ($this->session->userdata('autorizzato') != 'si' ) {
            if($chiave == "" || $pswd =="")
            {
                redirect('/av/visualizza');
            }
            else
            {
                $chiave=  htmlspecialchars(urldecode($chiave));
                
                $sql="SELECT * FROM anagrafica WHERE chiave=?";
                $ris=  $this->db->query($sql,array($chiave))->row_array();
//                print_r($ris);
                $this->session->set_userdata(array('email' => $ris['email'], 'autorizzato' => 'si', 'id' => $ris['id'], 'tipo' => $ris['tipo']));

                
            }
            
        }      
        


        $dati['form_header'] = $this->frontend->get_form_header();
        $dati['flags_header'] = $this->frontend->get_flags_header();

        $lang = $this->frontend->get_lang_menu();
        $count = 1;
        foreach ($lang as $value) {
            $dati['menu' . $count] = $value;
            $count++;
        }


        $dati['form'] = $this->frontend->cambia_password_form($pswd);


        $this->load->view('head');
        $this->load->view('av_header_view', $dati);
        $this->load->view('cambia_password_view');

        $this->load->view('footer');
    }

    public function ricevi_cambia_password() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        if ($this->session->userdata('autorizzato' != 'si')) {
            die();
        }




        $pass1 = trim($this->input->post('old'));
        $pass2 = trim($this->input->post('new_pass'));
        $pass3 = trim($this->input->post('new_pass2'));

        $id = $this->session->userdata('id');

        $sql = "SELECT * FROM anagrafica WHERE id = ?";
        $ris = $this->db->query($sql, array($id))->row_array();

        if ($ris['password'] != md5($pass1)) {
            echo 'Vecchia password non corretta <br> Old Password wrong';
        } elseif (($pass2 != $pass3) || strlen($pass2) < 6) {
            echo 'Password non corrispondenti o troppo corte <br> Password mismatch or too short';
        } else {
            $sql="UPDATE anagrafica SET password = ?";
            $this->db->query($sql,array(md5($pass2)));
            echo '1';
        }
    }

}

