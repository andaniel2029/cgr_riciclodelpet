<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of static_m
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 13-giu-2013, Diego Bellati diego@ranaridens.com
 */
class frontend_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_form_header() {
        $autorizzato = $this->session->userdata('autorizzato');
        if ($this->session->userdata('lang') == '') {
            $this->session->set_userdata(array('lang' => 'it'));
        }

        if ($autorizzato == 'si') {
            $email = $this->session->userdata('email');

            $form = 'Benvenuto - welcome ' . $email . nbs(5) . anchor('login_clienti/cambia_password', 'CAMBIA PASSWORD -CHANGE PASSWORD') . nbs(5)
                    . anchor('login_clienti/logout', '<strong>LOGOUT</strong>' . nbs(3) . img('img/VARIE/x-logout.png')) . br()
                    . form_open('ricerca')
                    . form_label('<strong>CERCA/SEARCH</strong>') .
                    form_input('ricerca') . form_submit('submit', '', 'class="bottone_ricerca"') . form_close();
        } else {


            $form = '<strong>LOGIN</strong>  ' . nbs(2) . form_label('E-mail') . nbs() . form_input('email', '', 'size="12"') .
                    nbs(2) . form_label('Password') . nbs() . form_password('pswd', '', 'size="12"') .
                    anchor('login', img('img/ELEMENTI_FISSI/freccina-login.png'), 'id="accedi_top"') . br(1) . '<strong>REGISTRATI - REGISTER</strong> ' . anchor('av/registra', img('img/ELEMENTI_FISSI/freccina-login.png'))
                    . br(1) . '<strong>RECUPERA PASSWORD - PASSWORD RECOVERY</strong> ' . anchor('', img('img/ELEMENTI_FISSI/freccina-login.png'), 'id="password_recovery"');
        }

        return $form;
    }

    public function get_flags_header() {
        $lang = $this->session->userdata('lang');
        $segment = '';

        if ($this->uri->segment(1, 0)) {
            $segment = $this->uri->segment(1);
        }

        if ($lang == 'it') {
            $flags = anchor('lang_switch/sw/' . $segment, img('img/ELEMENTI_FISSI/bandiera-ITA.png'));
            $flags .= anchor('lang_switch/sw/' . $segment, img('img/ELEMENTI_FISSI/bandiera-ING_light.png'));
        } elseif ($lang == 'en') {
            $flags = anchor('lang_switch/sw/' . $segment, img('img/ELEMENTI_FISSI/bandiera-ITA_light.png'));
            $flags .= anchor('lang_switch/sw/' . $segment, img('img/ELEMENTI_FISSI/bandiera-ING.png'));
        } else {
            $flags = anchor('lang_switch/sw/' . $segment, img('img/ELEMENTI_FISSI/bandiera-ITA.png'));
            $flags .= anchor('lang_switch/sw/' . $segment, img('img/ELEMENTI_FISSI/bandiera-ING.png'));
        }

        return $flags;
    }

    public function get_lang_menu() {
        $lang = $this->session->userdata('lang');
        if ($lang != 'en') {
            return array('Home', 'Fornitori', 'Produzione', 'Clienti', 'News', 'Contatti', 'Acquisto/vendita');
        } else {
            return array('Home', 'Suppliers', 'Production', 'Customers', 'News', 'Contact us', 'Purchase / sell');
        }
    }

    public function get_news($start) {
        $this->load->helper('text');
        $sql = "SELECT * FROM news WHERE attivo = 1 ORDER BY inserimento DESC LIMIT ?, 5 ";
        $ris = $this->db->query($sql, $start)->result_array();
        $news = "<section>";
        foreach ($ris as $value) {
            $news .= '<article class="news_cont">';
            $news .='<h1 class="news_title">' . $value['titolo'] . '</h1>';
            $news .= word_limiter($value['descrizione'], 40, anchor('news/get_full_news/' . $value['id'], ' leggi...')) . br(2)
                    . '<span class="news_pubblicazione">'
                    . date('d/m/Y', $value['inserimento'])
                    . '</span><hr class="news_separator">';
        }
        $news .='</section>';

        return $news;
    }

    public function read_news($id = 0) {

        if (!is_numeric($id)) {
            redirect('news');
        }

        $sql = "SELECT * FROM news WHERE id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() == 0) {
            redirect('news');
        }
        $ris = $query->row_array();

        $news = "<section>";

        $news .= '<article class="news_cont">';
        $news .='<h1 class="news_title">' . $ris['titolo'] . '</h1>';
        $news .= $ris['descrizione'] . br(2)
                . '<span class="news_pubblicazione">'
                . date('d/m/Y', $ris['inserimento'])
                . '</span>' . nbs(5) . '<span>' . anchor('news', 'Indietro / Back') . '</span></article';

        $news .='</section>';
        return $news;
    }

    public function cambia_password_form($pswd) {
        $form = form_label('Vecchia password - Old Password', 'old_password') . br();
        if ($pswd != "") {
            $form .= form_password('old_password', $pswd) . br(2);
        } else {
            $form .= form_password('old_password') . br(2);
        }

        $form .= form_label('Nuova password', 'new_password') . br();
        $form .= form_password('new_password') . br(2);
        $form .= form_label('Riscrivi la nuova password - Retype new password') . br();
        $form .= form_password('new_password_2') . br(2);
        $form .= form_button('sbm_chpswd', 'CAMBIA - CHANGE', 'class="background_blue"');

        return $form;
    }

}
