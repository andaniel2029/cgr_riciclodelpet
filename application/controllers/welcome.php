<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend_m', 'frontend');
//        $this->load->model('tools_m', 'tools_m');
    }

    public function index() {
        redirect('welcome/cgr');
    }

    public function lost_password_form() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $form = form_label("Indirizzo email / Email address", 'email_lost') . br();
        $form .=form_input("email_lost") . br(2);
        $form .=form_button("lost_btn", "Vai/Submit");
        echo $form;
    }

    public function update_lost_pswd() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $email_lost = htmlspecialchars(trim($this->input->post('email_lost')));

        $sql = "SELECT * FROM anagrafica WHERE email = ?";
        $ris = $this->db->query($sql, array($email_lost));
        if ($ris->num_rows() == 1) {
            $this->load->helper('string');
            $new_pswd = random_string('alpha', 6);
            $sql2 = "UPDATE anagrafica SET password=? WHERE email = ?";
            $this->db->query($sql2, array(md5($new_pswd), $email_lost));
            $this->load->library('email');

            $config = Array(
//    'protocol' => 'smtp',
//    'smtp_host' => 'smtps.cgr-riciclodelpet.it',
//    'smtp_port' => 465,
//    'smtp_crypto' => 'ssl',
//    'smtp_user' => 'noreply@cgr-riciclodelpet.it',
//    'smtp_pass' => '[9yw1wMA',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );

            $this->email->initialize($config);
            $this->email->from('noreply@cgr-riciclodelpet.it', 'CGR');
            $this->email->to($email_lost);
            $this->email->subject('CGR Recupero password / new password');
            $this->email->message('<html><head></head><body> CGR <br>New password / nuova password:  ' . $new_pswd . '</body>');
            $this->email->send();
            echo'Nuova password inviata all\' indirizzo e-mail' . br() . 'New password sent to your e-mail address.';
        } else {
            sleep(2);
            echo 'Nessun utente con questo indirizzo.' . br() . 'No user with this address';
        }
    }

    public function cgr() {
        //lingua
        $lang_test = $this->session->userdata('lang');

        if ($lang_test == 'en') {
            $lang = 'en';
        } else {
            $lang = 'it';
        }
        // /lingua

        $head_data = array();
        $head_data['titolo'] = 'CGR -' . 'titolo';
        $head_data['meta_tag'] = 'prodotti';
        $head_data['meta_description'] = 'prodotti';

        $dati['form_header'] = $this->frontend->get_form_header();
        $dati['flags_header'] = $this->frontend->get_flags_header();
//        $dati['statica'] = $this->get_statiche_m->page('home', $lang);
        $lang = $this->frontend->get_lang_menu();
        $count = 1;
        foreach ($lang as $value) {
            $dati['menu' . $count] = $value;
            $count++;
        }
//        echo md5('cgr2013');
        $this->load->view('head', $head_data);
        $this->load->view('welcome_header_view', $dati);
        if ($lang_test == 'en') {

            $this->load->view('welcome_view_1');
        } else {
            $this->load->view('welcome_view');
        }

        $this->load->view('footer');
    }

    //GENERA LE IMMAGINI DELLE OFFERTE
    public function generatore_offerte() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $sql = "SELECT *, offerte_per_cliente.id AS CLI_ID FROM offerte_per_cliente JOIN
            foto_offerte_clienti
            ON offerte_per_cliente.id = foto_offerte_clienti.offerta_id WHERE offerte_per_cliente.attivo = 1 ORDER BY timestamp DESC LIMIT 10";
        $adesso = time();
        $ris = $this->db->query($sql, array($adesso))->result_array();

        $z = array();
        foreach ($ris as $value) {
            
            list($w, $h) = getimagesize(base_url() . 'foto_offerte/'.$value['CLI_ID'] .'/'. $value['thumb']);
            if ($w >= $h) {
                $w_ok = 140;
                 $z[] = '<div class="cont_img__">' . anchor('av/dettaglio_offerta_cliente/'.$value['CLI_ID'],img(array('src'=>'foto_offerte/'.$value['CLI_ID'] .'/'. $value['thumb'],'width'=>$w_ok))) . '</div><div class="cont_cont__"><p class="cont_cont_titolo">' . $value['codice'] . '</p>
                <p>' . $value['nome'] . '</p></div>';
            } else {
                $h_ok = 92;
                $z[] = '<div class="cont_img__">' . anchor('av/dettaglio_offerta_cliente/'.$value['CLI_ID'],img(array('src'=>'foto_offerte/'.$value['CLI_ID'] .'/'. $value['thumb'],'height'=>$h_ok))) . '</div><div class="cont_cont__"><p class="cont_cont_titolo">' . $value['codice'] . '</p>
                <p>' . $value['nome'] . '</p></div>';
            }

            
            
            
            
            
        }

//        print_r($z);

        $a = array(0 => 'dati', 1 => 'dati2', 2 => 'dati3', 3 => 'dati4', 4 => 'dati5', 5 => 'dati6', 6 => 'dati7', 7 => 'dati8');

        echo json_encode($z);
    }

//        public function test(){
//            
//            $aa = $this->security->sanitize_filename($this->input->post('sd'));
//            $zz=$this->security->sanitize_filename($this->input->post('zzz'));
//            echo $aa.br().$zz;
//        }
}

