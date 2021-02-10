<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of av
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 23-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Av extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     */
    public function index() {
        redirect('av/visualizza');
    }

    public function visualizza() {
        $this->load->model('frontend_m', 'frontend');
        $this->load->model('av_m', 'av_m');

        $head_data = array();
        $head_data['titolo'] = 'CGR -' . 'Acquisti e vendite';
        $head_data['meta_tag'] = 'acquisti';
        $head_data['meta_description'] = 'acquisti';

        $dati['form_header'] = $this->frontend->get_form_header();
        $dati['flags_header'] = $this->frontend->get_flags_header();

        $lang = $this->frontend->get_lang_menu();
        $count = 1;
        foreach ($lang as $value) {
            $dati['menu' . $count] = $value;
            $count++;
        }



        $this->load->view('head', $head_data);
        $this->load->view('av_header_view', $dati);

        $utente = $this->session->userdata('email');





        if ($this->session->userdata('autorizzato') == 'si' && $this->session->userdata('tipo') == 'fornitore') {
            $dati2['get_inserzioni'] = $this->av_m->get_inserzioni();
            $dati2['get_foto'] = $this->av_m->get_foto($utente);
            $dati2['get_file'] = $this->av_m->get_file();
            $dati2['get_form'] = $this->av_m->get_form();
            //errori caricamento foto
            $dati2['errori'] = $this->session->userdata('errori');
            $this->session->unset_userdata('errori');

            $this->load->view('av_logged_fornitore_view', $dati2);
        } elseif ($this->session->userdata('auth') == 'si') {
            $dati2['get_inserzioni'] = $this->av_m->get_inserzioni();
            $dati2['get_foto'] = $this->av_m->get_foto($utente);
            $dati2['get_file'] = $this->av_m->get_file();
            $dati2['get_form'] = $this->av_m->get_form();
            //errori caricamento foto
            $dati2['errori'] = $this->session->userdata('errori');
            $this->session->unset_userdata('errori');

            $this->load->view('av_logged_fornitore_view', $dati2);
        } elseif ($this->session->userdata('autorizzato') == 'si' && $this->session->userdata('tipo') == 'cliente') {
            $this->load->model("pagination_m");

            $this->load->library('pagination');


            $config = array();
            $config["base_url"] = site_url() . "/av/visualizza";
            $config["total_rows"] = $this->pagination_m->record_count();
            $config["per_page"] = 5;
            $config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['results'] = $this->pagination_m->fetch_values($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();

            $this->load->view("av_logged_cliente_view", $data);
        } else {

            $this->load->view('av_view');
        }
        $this->load->view('footer');
    }

    public function registra() {
        $this->load->model('frontend_m', 'frontend');
        $this->load->model('clienti_m', 'clienti_m');

        $head_data = array();
        $head_data['titolo'] = 'CGR -' . 'Acquisti e vendite';
        $head_data['meta_tag'] = 'acquisti';
        $head_data['meta_description'] = 'acquisti';

//        $dati['form_header']=$this->frontend->get_form_header(); 
        $dati['form'] = $this->clienti_m->aggiungi_clienti_form();
        $dati['flags_header'] = $this->frontend->get_flags_header();

        $lang = $this->frontend->get_lang_menu();
        $count = 1;
        foreach ($lang as $value) {
            $dati['menu' . $count] = $value;
            $count++;
        }

        $this->load->view('head', $head_data);
        $this->load->view('av_registra_view', $dati);

        $this->load->view('registra_view');




        $this->load->view('footer');
    }

    public function temporaneo() {
        if (!$this->input->is_ajax_request()) {
            die('ajax');
        }
        $dati = array();
        $dati['nome'] = $this->input->post('nome');
        $dati['polimero'] = $this->input->post('polimero');
        $dati['quantita'] = $this->input->post('quantita');
        $dati['prezzo'] = $this->input->post('prezzo');
        $dati['descrizione'] = $this->input->post('descrizione');
        $this->session->set_userdata($dati);
    }

    public function elimina_foto_temp() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $this->load->helper('file');
        $foto = $this->input->post('foto');

        if (strlen($foto) > 0) {
            $foto_elab = explode('&', $foto);
            foreach ($foto_elab as $value) {
                $a = explode("=", $value);
                $foto_ok[] = $a[1];
            }


            foreach ($foto_ok as $value) {

                if ($value != 'imagemissing.jpg') {
                    $sql = "SELECT * FROM foto_upload_temp WHERE thumb = ?";
                    $ris = $this->db->query($sql, array($value))->row_array();


                    if (is_file('./uploads_foto/' . $ris['url'])) {
                        unlink('./uploads_foto/' . $ris['url']);
                    } else {
                        echo'errore non è un file';
                    }

                    if (is_file('./uploads_foto/' . $ris['thumb'])) {
                        unlink('./uploads_foto/' . $ris['thumb']);
                    } else {
                        echo'errore non è un file';
                    }



                    $sql = "DELETE FROM foto_upload_temp WHERE thumb = ? ";
                    $this->db->query($sql, array($value));
                }
            }
        }
    }

    public function elimina_file_temp() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $this->load->helper('file');
        $foto = $this->input->post('file');




        if (strlen($foto) > 0) {
            $foto_elab = explode('&', $foto);
            foreach ($foto_elab as $value) {
                $a = explode("=", $value);
                $foto_ok[] = $a[1];
            }


            foreach ($foto_ok as $value) {

                if ($value != '') {

                    if (is_file('./uploads_file/' . $value)) {
                        unlink('./uploads_file/' . $value);
                    } else {
                        echo'errore non è un file';
                    }




                    $sql = "DELETE FROM file_upload_temp WHERE url = ? ";
                    $this->db->query($sql, array($value));
                }
            }
        }
    }

    public function salva_offerta() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $errori = array();
        $nome = htmlspecialchars(trim($this->input->post('nome')));
        $polimero = htmlspecialchars(trim($this->input->post('polimero')));
        $quantita = htmlspecialchars(trim($this->input->post('quantita')));
        $prezzo = htmlspecialchars(trim($this->input->post('prezzo')));
        $descrizione = htmlspecialchars(trim($this->input->post('descrizione')));

        if ($this->session->userdata('auth') == 'si') {
            $sql = "INSERT INTO offerte (nome,polimero,quantita,prezzo,descrizione,utente_email,utente_id,inserimento)
            VALUES (?,?,?,?,?,?,?,?)";
            $utente = $this->session->userdata('email');
            $id = $this->session->userdata('id');
            $now = time();
            $this->db->query($sql, array($nome, $polimero, $quantita, $prezzo, $descrizione, 'Amministratore', 0, $now));

            $inserzione_id = $this->db->insert_id();
            //copio da valori temporanei a definitivi



            $sql = "SELECT * FROM foto_upload_temp WHERE sessione_email = ?";
            $ris = $this->db->query($sql, array($utente))->result_array();

            foreach ($ris as $value) {
                $sql = "INSERT INTO foto (url,thumb,inserzione_id, anagrafica_id) VALUES (?,?,?,?)";
                $this->db->query($sql, array($value['url'], $value['thumb'], $inserzione_id, $id));
            }


            $sql = "SELECT * FROM file_upload_temp WHERE sessione_email = ?";
            $ris = $this->db->query($sql, array($utente))->result_array();

            foreach ($ris as $value) {
                $sql = "INSERT INTO file_offerta (url,inserzione_id, anagrafica_id) VALUES (?,?,?)";
                $this->db->query($sql, array($value['url'], $inserzione_id, $id));
            }


            $sql = "DELETE FROM file_upload_temp WHERE sessione_email = ?";
            $this->db->query($sql, array($utente));

            $sql = "DELETE FROM foto_upload_temp WHERE sessione_email = ?";


            $this->db->query($sql, array($utente));
            $this->session->unset_userdata('nome');
            $this->session->unset_userdata('polimero');
            $this->session->unset_userdata('quantita');
            $this->session->unset_userdata('prezzo');
            $this->session->unset_userdata('descrizione');

            echo 1;
        } else {
            $sql = "INSERT INTO offerte (nome,polimero,quantita,prezzo,descrizione,utente_email,utente_id,inserimento)
            VALUES (?,?,?,?,?,?,?,?)";
            $utente = $this->session->userdata('email');
            $id = $this->session->userdata('id');
            $now = time();
            $this->db->query($sql, array($nome, $polimero, $quantita, $prezzo, $descrizione, $utente, $id, $now));

            $inserzione_id = $this->db->insert_id();
            //copio da valori temporanei a definitivi



            $sql = "SELECT * FROM foto_upload_temp WHERE sessione_email = ?";
            $ris = $this->db->query($sql, array($utente))->result_array();

            foreach ($ris as $value) {
                $sql = "INSERT INTO foto (url,thumb,inserzione_id, anagrafica_id) VALUES (?,?,?,?)";
                $this->db->query($sql, array($value['url'], $value['thumb'], $inserzione_id, $id));
            }


            $sql = "SELECT * FROM file_upload_temp WHERE sessione_email = ?";
            $ris = $this->db->query($sql, array($utente))->result_array();

            foreach ($ris as $value) {
                $sql = "INSERT INTO file_offerta (url,inserzione_id, anagrafica_id) VALUES (?,?,?)";
                $this->db->query($sql, array($value['url'], $inserzione_id, $id));
            }


            $sql = "DELETE FROM file_upload_temp WHERE sessione_email = ?";
            $this->db->query($sql, array($utente));

            $sql = "DELETE FROM foto_upload_temp WHERE sessione_email = ?";


            $this->db->query($sql, array($utente));
            $this->session->unset_userdata('nome');
            $this->session->unset_userdata('polimero');
            $this->session->unset_userdata('quantita');
            $this->session->unset_userdata('prezzo');
            $this->session->unset_userdata('descrizione');

            echo 1;
        }
    }

    public function dettaglio_offerta_cliente($id, $chiave = "") {
        
        if (!is_numeric($id)) {
            redirect('/');
        }
//        print_r($this->session->all_userdata());
//        die();
        
        
        
        
        if ($this->session->userdata('autorizzato') != 'si' ) {
            if($chiave == "")
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
       
        //verifico chi è l'utente per evitare che chiunque possa vedere le offerte cliccando sul link per le offerte in home page

        $sql="SELECT * FROM off_cli WHERE cliente_id = ? AND offerte_per_cliente_id = ?";
        $val = $this->db->query($sql,  array($this->session->userdata('id'),$id));
        
        if($val->num_rows()==0)
        {
            redirect('/av/visualizza');
        }


        $this->load->model('frontend_m', 'frontend');
        $this->load->model('av_m', 'av_m');

        $valori = $this->av_m->dettagli_prodotto($id);

        $head_data = array();
        $head_data['titolo'] = 'CGR -' . 'Acquisti e vendite';
        $head_data['meta_tag'] = 'acquisti';
        $head_data['meta_description'] = 'acquisti';

        $dati['form_header'] = $this->frontend->get_form_header();
        $dati['flags_header'] = $this->frontend->get_flags_header();

        $lang = $this->frontend->get_lang_menu();
        $count = 1;
        foreach ($lang as $value) {
            $dati['menu' . $count] = $value;
            $count++;
        }



        $this->load->view('head', $head_data);
        $this->load->view('av_header_view', $dati);

        $utente = $this->session->userdata('email');



        if ($this->session->userdata('autorizzato') == 'si' && $this->session->userdata('tipo') == 'cliente') {

            $dati['foto1'] = $valori['foto1'];
            $dati['foto2'] = $valori['foto2'];
            $dati['foto3'] = $valori['foto3'];
            $dati['foto4'] = $valori['foto4'];
            $dati['foto5'] = $valori['foto5'];
            $dati['foto_grande'] = $valori['foto_grande'];
            $dati['altre_info'] = $valori['altre_info'];
            $dati['dettaglio_offerta'] = $valori['dettaglio_offerta'];
            $dati['sx'] = $valori['sx'];
            $dati['dx'] = $valori['dx'];
            $dati['form_richiesta'] = $valori['form_contatti'];
            $this->load->view('av_dettaglio_offerta_view', $dati);
        } else {
echo'sd';
//            redirect('/');
        }
        $this->load->view('footer');





















//        
//        
//                $cli= $this->session->userdata('id');
//                 $this->load->model('frontend_m', 'frontend');
//
//        $sql = "SELECT * FROM offerte_per_cliente
//            JOIN off_cli 
//            ON offerte_per_cliente.id = off_cli.offerte_per_cliente_id
//            
//            WHERE attivo = ? AND scadenza > ? AND offerte_per_cliente.id = ? AND off_cli.cliente_id= $cli ";
//        $offerte = $this->db->query($sql, array(1, time(), $id))->row_array();
////        echo $this->session->userdata('id');
//        
//        $dati['form_header'] = $this->frontend->get_form_header();
//        $dati['flags_header'] = $this->frontend->get_flags_header();
//        
//        
//        $this->load->view('head');
//        $this->load->view('av_header_view',$dati);
//        $this->load->view('av_dettaglio_offerta_view');
//        
//
//        $this->load->view('footer');
//        
//        
//        echo '<pre>';
//        print_r($offerte);
//        echo '</pre>';
//        $sql = "SELECT * FROM foto WHERE inserzione_id = ?";
//        $foto = $this->db->query($sql, array($offerte['id_offerta_originale']))->result_array();
//
//        $sql = "SELECT * FROM file_offerta WHERE inserzione_id = ?";
//        $allegati = $this->db->query($sql, array($offerte['id_offerta_originale']))->result_array();
    }

    public function mail_richiesta() {
        $this->load->library('email');
        $codice = htmlspecialchars(trim($this->input->post('codice')));
        $contenuto = htmlspecialchars(trim($this->input->post('contenuto')));
        $cliente_id = $this->session->userdata('id');
        $sql = "SELECT * FROM anagrafica WHERE id = ?";
        $ris = $this->db->query($sql, array($cliente_id))->row_array();

        $sql = "SELECT * FROM offerte_per_cliente WHERE codice = ?";
        $ris2 = $this->db->query($sql, array($codice))->row_array();



        $config = Array(
//                'protocol' => 'smtp',
//                'smtp_host' => 'smtps.cgr-riciclodelpet.it',
//                'smtp_port' => 465,
//                'smtp_crypto' => 'ssl',
//                'smtp_user' => 'noreply@cgr-riciclodelpet.it',
//                'smtp_pass' => '[9yw1wMA',
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );

        $messaggio = '<html><head></head><body>DATI DEL RICHIEDENTE' . br(2) . 'Ragione sociale: ' . $ris['rag_soc'] . br()
                . 'Caregoria: ' . $ris['categoria'] . br()
                . 'Indirizzo: ' . $ris['indirizzo'] . br()
                . 'Nome: ' . $ris['nome'] . br()
                . 'Cognome: ' . $ris['cognome'] . br()
                . 'Telefono: ' . $ris['telefono'] . br()
                . 'Email: ' . $ris['email'] . br(2) . 'DATI DELL\'OFFERTA' . br(2)
                . 'Codice: ' . $ris2['codice'] . br()
                . 'Nome offerta: ' . $ris2['nome'] . br()
                . 'Polimero: ' . $ris2['polimero'] . br()
                . 'Quantità: ' . $ris2['quantita'] . br()
                . 'Prezzo: ' . $ris2['prezzo'] . br()
                . 'Scadenza: ' . date('d/m/Y', $ris2['scadenza']) . br(3) . 'CONTENUTO DEL MESSAGGIO' . br(3) . '<p>' . $contenuto . '</p>';


        $this->email->initialize($config);
        $this->email->from('noreply@cgr-riciclodelpet.it', 'CGR-riciclo del PET - mail di informazione');
        $this->email->reply_to($ris['email']);
        $this->email->to('a.rimini@cgr-riciclodelpet.it');
//                $this->email->to('info@ranaridens.com');
        $this->email->subject('CGR - Richiesta info relativa ad offerta ' . $ris2['nome'] . ' codice ' . $ris2['codice']);
        $this->email->message($messaggio);
        $this->email->send();
    }

}

