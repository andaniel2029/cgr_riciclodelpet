<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of offerte
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 19-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Offerte extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login = $this->session->userdata('auth');
        if ($login != 'si') {
            redirect('errors/error_404');
        }
        $this->load->model('offerte_m', 'model');
    }

    /**
     * 
     */
    public function index() {
        $dati['get_offerte_fornitori'] = $this->model->get_offerte_fornitori();
        $dati['get_offerte_per_clienti'] = $this->model->get_offerte_per_clienti();


        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/admin_offerte_view', $dati);
        $this->load->view('admin/admin_footer_view');
    }

    public function dettaglio() {
        if (!$this->input->is_ajax_request()) {
            die();
        }

        $id = $this->input->post('id');
        if (!is_numeric($id)) {
            die();
        }

        $sql = "SELECT * FROM offerte WHERE id =?";
        $ris = $this->db->query($sql, array($id))->row_array();

        echo $ris['descrizione'];
    }

    public function crea_offerta_form() {
        if (!$this->input->is_ajax_request()) {
            die();
        }

        $id = $this->input->post('id');
        if (!is_numeric($id)) {
            die();
        }

        $sql = "SELECT * FROM offerte WHERE id =?";
        $ris = $this->db->query($sql, array($id))->row_array();

        $ris2=array();
        foreach ($ris as $k => $value) {
            $ris2[$k]=  htmlspecialchars_decode($value);
        }
        echo json_encode($ris2);
    }

    public function modifica_offerte_cliente() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $nome = htmlspecialchars(trim($this->input->post('nome')));
        $id = htmlspecialchars(trim($this->input->post('id')));

        $polimero = htmlspecialchars(trim($this->input->post('polimero')));
        $quantita = htmlspecialchars(trim($this->input->post('quantita')));
        $prezzo = htmlspecialchars(trim($this->input->post('prezzo')));
        $resa = htmlspecialchars(trim($this->input->post('resa')));
        $imballo = htmlspecialchars(trim($this->input->post('imballo')));
        $peso = htmlspecialchars(trim($this->input->post('peso')));
        $mezzo = htmlspecialchars(trim($this->input->post('mezzo')));
        $cer = htmlspecialchars(trim($this->input->post('cer')));
        $rifiuto = htmlspecialchars(trim($this->input->post('rifiuto')));

        $descrizione = htmlspecialchars(trim($this->input->post('descrizione')));
        $destinatari = $this->input->post('destinatari');
//        print_r($destinatari);








        if (!in_array('0', $destinatari)) {


            $sql = "UPDATE offerte_per_cliente SET nome=?,polimero=?,quantita=?,prezzo=?,resa=?,imballo=?,peso=?,mezzo=?,cer=?,descrizione=?,rifiuto=? WHERE id = ?";
            $this->db->query($sql, array($nome, $polimero, $quantita, $prezzo, $resa, $imballo, $peso, $mezzo, $cer, $descrizione, $rifiuto, $id));

//            $last_id = $this->db->insert_id();

            $sql = "DELETE  FROM off_cli WHERE offerte_per_cliente_id = ?";
            $this->db->query($sql, array($id));
            foreach ($destinatari as $value) {
                if (!is_numeric($value)) {
                    die();
                }




                $sql = "INSERT INTO off_cli (cliente_id,offerte_per_cliente_id) VALUES (?,?)";
                $this->db->query($sql, array($value, $id));
            }
            echo $id;
        } else {
            echo 'Cliente selezionato non valido';
        }
    }

    public function salva_offerte() {
        if (!$this->input->is_ajax_request()) {
            die();
        }

        $nome = htmlspecialchars(trim($this->input->post('nome')));
        $polimero = htmlspecialchars(trim($this->input->post('polimero')));
        $quantita = htmlspecialchars(trim($this->input->post('quantita')));
        $prezzo = htmlspecialchars(trim($this->input->post('prezzo')));
        $resa = htmlspecialchars(trim($this->input->post('resa')));
        $imballo = htmlspecialchars(trim($this->input->post('imballo')));
        $peso = htmlspecialchars(trim($this->input->post('peso')));
        $mezzo = htmlspecialchars(trim($this->input->post('mezzo')));
        $cer = htmlspecialchars(trim($this->input->post('cer')));
        $scadenza = htmlspecialchars(trim($this->input->post('scadenza')));
        $descrizione = htmlspecialchars(trim($this->input->post('descrizione')));
        $rifiuto = htmlspecialchars(trim($this->input->post('rifiuto')));
        $destinatari = $this->input->post('destinatari');
        $id_offerta_originale = $this->input->post('id_offerta_originale');
        $attivo = $this->input->post('attiva');



//        print_r($destinatari);



        $d = explode("-", $scadenza);
//        print_r($d);
        if (@checkdate(@$d[1], @$d[0], @$d[2])) {
            $data_unix = @$d[2] . @$d[1] . @$d[0];
            $unix_data = strtotime($data_unix);
        } else {
            echo 'Scadenza non selezionata';
            die();
        }





        if (!in_array('0', $destinatari)) {

//creo il codice autoincrement
            $sql = "SELECT codice FROM offerte_per_cliente ORDER BY codice DESC LIMIT 1";
            $cod = $this->db->query($sql)->row_array();

            $codice = @$cod['codice'] + 1;

            if ($attivo != 1) {
                $attivo = 0;
            }
//inserisco i valori nella tabella delle offerte
            $sql = "INSERT INTO offerte_per_cliente (nome,polimero,quantita,prezzo,resa,imballo,peso,mezzo,cer,scadenza,descrizione,attivo,id_offerta_originale,codice,rifiuto) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->db->query($sql, array($nome, $polimero, $quantita, $prezzo, $resa, $imballo, $peso, $mezzo, $cer, $unix_data, $descrizione, $attivo, $id_offerta_originale, $codice, $rifiuto));
            $last_id = $this->db->insert_id();
            foreach ($destinatari as $value) {
                if (!is_numeric($value)) {
                    die();
                }


//tab relazionale che lega offerta a cliente
                $sql = "INSERT INTO off_cli (cliente_id,offerte_per_cliente_id) VALUES (?,?)";
                $this->db->query($sql, array($value, $last_id));
            }
//
            $sql = "SELECT * FROM foto WHERE inserzione_id = ?";
            $r = $this->db->query($sql, array($id_offerta_originale))->result_array();
            mkdir('./foto_offerte/' . $last_id);
            foreach ($r as $value) {
                $sql = "INSERT INTO foto_offerte_clienti (offerta_id,foto,thumb) VALUES (?,?,?)";
                $this->db->query($sql, array($last_id, $value['url'], $value['thumb']));
                if (file_exists('./uploads_foto/' . $value['url']) && file_exists('./uploads_foto/' . $value['thumb'])) {

                    copy('./uploads_foto/' . $value['url'], './foto_offerte/' . $last_id . '/' . $value['url']);
                    copy('./uploads_foto/' . $value['thumb'], './foto_offerte/' . $last_id . '/' . $value['thumb']);
                }
            }

//            $foto = './uploads_foto/' . $value['foto'];
//files
            $sql = "SELECT * FROM file_offerta WHERE inserzione_id = ?";
            $r = $this->db->query($sql, array($id_offerta_originale))->result_array();
            mkdir('./file_offerte/' . $last_id);
            foreach ($r as $value) {
                $sql = "INSERT INTO file_offerte_clienti (offerta_id,url,nome) VALUES (?,?,?)";

                $this->db->query($sql, array($last_id, $value['url'], $value['url']));

                if (file_exists('./uploads_file/' . $value['url'])) {

                    copy('./uploads_file/' . $value['url'], './file_offerte/' . $last_id . '/' . $value['url']);
                }
            }


            echo $last_id;
        } else {
            echo 'Cliente selezionato non valido';
        }
    }

    public function elimina_off_fornitore($id) {
        if (!is_numeric($id)) {
            die();
        }

        $sql = "SELECT * FROM file_offerta WHERE id = ?";
        $zz = $this->db->query($sql, array($id))->result_array();

        foreach ($zz as $value) {
            if (is_file('./uploads_file/' . $value['url'])) {
                unlink('./uploads_file/' . $value['url']);
            }
        }


        $sql = "DELETE FROM offerte WHERE id = ?";
        $this->db->query($sql, array($id));
        redirect('admin/offerte');
    }

    public function offerte_pubblicate() {
        $this->load->model('pagination_m', 'pagination_m');
        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/admin/offerte/offerte_pubblicate';
        $config["total_rows"] = $this->pagination_m->record_count_admin_offerte();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["results"] = $this->pagination_m->fetch_values_admin_offerte($page, $config["per_page"]);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/offerte_pubblicate_view', $data);
        $this->load->view('admin/admin_footer_view');
    }

    public function attiva() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $id = $this->input->post('id');
        if (!is_numeric($id)) {
            die();
        }

        $attivo = $this->input->post('attivo');
        if (!is_numeric($attivo)) {
            die();
        }

        $sql = "SELECT * FROM offerte_per_cliente WHERE id = ?";
        $r = $this->db->query($sql, array($id))->row_array();
        echo $r['attivo'];
        if ($r['attivo'] == 1) {
            $sql = "UPDATE offerte_per_cliente SET attivo = 0 WHERE id = ?";
            $this->db->query($sql, array($id));
        } else {
            $sql = "UPDATE offerte_per_cliente SET attivo = 1 WHERE id = ?";
            $this->db->query($sql, array($id));
        }
    }

    public function nuova_scadenza() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $id = $this->input->post('id');
        $data_nuova = $this->input->post('data_nuova');

        if (!is_numeric($id)) {
            die();
        }
        $d = explode("-", $data_nuova);
//        print_r($d);

        $data_unix = @$d[2] . @$d[1] . @$d[0];
        $unix_data = strtotime($data_unix);

        $sql = "UPDATE offerte_per_cliente SET scadenza = ? WHERE id = ? ";
        $this->db->query($sql, array($unix_data, $id));
    }

    public function modifica_offerta_cliente($id) {
        if (!is_numeric($id)) {
            die();
        }

        $data['form'] = $this->model->modifica_offerta_cliente_form($id);

        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/offerte_modifica_view', $data);
        $this->load->view('admin/admin_footer_view');
    }

    /**
     * 
     * @param type $id
     * @todo inviare mail che l'offerta è stata annullata
     */
    public function elimina_offerta_cliente($id) {

        if (!is_numeric($id)) {
            die();
        }

        $sql = "select * FROM foto_offerte_clienti WHERE offerta_id = ?";
        $ris = $this->db->query($sql, array($id))->result_array();
        foreach ($ris as $value) {
            $foto = './foto_offerte/' . $id . '/' . $value['foto'];
            $thumb = './foto_offerte/' . $id . '/' . $value['thumb'];
            if (is_file($foto)) {
                unlink($foto);
            }
            if (is_file($thumb)) {
                unlink($thumb);
            }
        }



        $sql = "DELETE FROM off_cli WHERE offerte_per_cliente_id = ?";
        $this->db->query($sql, array($id));
        $sql = "DELETE FROM offerte_per_cliente WHERE id = ?";
        $this->db->query($sql, array($id));
        $sql = "DELETE FROM file_offerte_clienti WHERE offerta_id = ?";
        $this->db->query($sql, array($id));
        $sql = "DELETE FROM foto_offerte_clienti WHERE offerta_id = ?";
        $this->db->query($sql, array($id));

        rmdir('./foto_offerte/' . $id);
//
//        $this->load->library('email');
//
//        $this->email->from('your@example.com', 'Your Name');
//        $this->email->to('someone@example.com');
//        $this->email->cc('another@another-example.com');
//        $this->email->bcc('them@their-example.com');
//
//        $this->email->subject('Email Test');
//        $this->email->message('Testing the email class.');
//
//        $this->email->send();
//
//        echo $this->email->print_debugger();



        redirect('admin/offerte/offerte_pubblicate');
    }

    public function offerta_foto_file($id) {

        if (!is_numeric($id)) {
            die();
        }

        $sql = "SELECT * FROM foto_offerte_clienti WHERE offerta_id=?";

        $ris = $this->db->query($sql, array($id))->result_array();

        $foto = '<div id=foto_cont><ul>';

        foreach ($ris as $value) {
            $foto .= '<li><div class="foto_cont_miniature" data-offerta_id="' . $id . ' data-id="' . $value['id'] . '">'
                    . img('foto_offerte/' . $id . '/' . $value['thumb']) . '<button data-offerta_id="' . $id . 'data-id="' . $value['id'] .
                    '" class="bottone_elimina_foto">elimina</button> </div></li>';
        }
        $foto .='</div>';
        $data['foto'] = $foto;

//        echo '<pre>';
//        print_r($ris);
//        echo '</pre>';



        $sql = "SELECT * FROM file_offerte_clienti WHERE offerta_id=?";

        $ris = $this->db->query($sql, array($id))->result_array();

        $file = '<div id=file_cont><ul>';

        foreach ($ris as $value) {
            $file .= '<li><div class="file_cont_miniature" data-offerta_id="' . $id . ' data-id=data-id="' . $value['id'] . '">'
                    . $value['url'] . nbs(2) . 'nome da visualizzare nel link per il download: ' .
                    form_input('file_nome', $value['nome']) .
                    '<button   data-id="' . $value['id'] . '" class="bottone_salva_file">salva modifica</button>
                        <button data-id="' . $value['id'] . ' "data-offerta_id="' . $id . '" class="bottone_elimina_file" >elimina_allegato</button>'
                    . anchor('file_offerte/' . $id . '/' . $value['url'], 'anteprima', 'target="_blank"') . '</div></li>';
        }
//        echo '<pre>';
//        print_r($ris);
//        echo '</pre>';
        $file .='</div>';
        $data['file'] = $file;

//        $data['form'] = $this->model->modifica_offerta_cliente_form($id);

        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/offerte_foto_file_view', $data);
        $this->load->view('admin/admin_footer_view');
    }

    public function elimina_foto() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $id = $this->input->post('id');
        $offerta_id = $this->input->post('offerta_id');

        if (!is_numeric($id)) {
            die();
        }

        $sql = "SELECT * FROM foto_offerte_clienti WHERE id = ?";
        $ris = $this->db->query($sql, array($id))->row_array();


        $foto = './foto_offerte/' . $offerta_id . '/' . $ris['foto'];
        $thumb = './foto_offerte/' . $offerta_id . '/' . $ris['thumb'];
        if (is_file($foto)) {
            unlink($foto);
        }
        if (is_file($thumb)) {
            unlink($thumb);
        }


        $sql = "DELETE FROM foto_offerte_clienti WHERE id = ?";
        $this->db->query($sql, array($id));
    }

    public function elimina_file() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $id = $this->input->post('id');
        $offerta_id = $this->input->post('offerta_id');


//        if (!is_numeric($id)) {
//            die();
//        }

        $sql = "SELECT * FROM file_offerte_clienti WHERE id = ?";
        $ris = $this->db->query($sql, array($id))->row_array();

        $url = './file_offerte/' . $offerta_id . '/' . $ris['url'];

        if (is_file($url)) {
            unlink($url);
        }

        $sql = "DELETE FROM file_offerte_clienti WHERE id = ?";
        $this->db->query($sql, array($id));
    }

    public function modifica_file() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $id = $this->input->post('id');
        $nome = htmlspecialchars(trim($this->input->post('nome')));


        if (!is_numeric($id)) {
            die();
        }

        $sql = "UPDATE file_offerte_clienti SET nome = ? WHERE id = ?";
        $this->db->query($sql, array($nome, $id));
    }

    public function upload_cliente_foto() {

        $precedente = $this->input->post('precedente');
        $id_offerta = $this->input->post('id_offerta');

        if (!is_numeric($id_offerta)) {
            die();
        }



        $config['upload_path'] = './foto_offerte/' . $id_offerta . '/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '9280';
        $config['max_height'] = '9024';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            $error = array('error' => $this->upload->display_errors());
            print_r($error);

            echo br(2) . anchor($precedente, 'Torna alla pagina');
        } else {
            $this->load->helper('file'); //helper per i file
            $dati = $this->upload->data();

            //configuro la libreria per il thumb
            $this->load->library('image_lib'); //modifico le immagini per creare miniatura

            $config['image_library'] = 'gd2';
            $config['source_image'] = './foto_offerte/' . $id_offerta . '/' . $dati['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800;
            $config['height'] = 800;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();




            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] = "_thumb";

            $config['width'] = 136;
            $config['height'] = 136;

            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            $thumb_name = $dati['raw_name'] . '_thumb' . $dati['file_ext'];

            $sql = "INSERT INTO foto_offerte_clienti (offerta_id,foto,thumb) VALUES (?,?,?)";
            $this->db->query($sql, array($id_offerta, $dati['file_name'], $thumb_name,));

            redirect($precedente);
        }
    }

    public function upload_cliente_file() {

        $precedente = $this->input->post('precedente');
        $id_offerta = $this->input->post('id_offerta');
        $nome = htmlspecialchars(trim($this->input->post('nome')));

        if (!is_numeric($id_offerta)) {
            die();
        }



        $config['upload_path'] = './file_offerte/' . $id_offerta . '/';

        $config['allowed_types'] = 'doc|xls|docx|xlsx|pdf';
        $config['max_size'] = '5000';
        $config['is_image'] = 0;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            $error = array('error' => $this->upload->display_errors());
            print_r($error);

            echo br(2) . anchor($precedente, 'Torna alla pagina');
        } else {
            $this->load->helper('file'); //helper per i file
            $dati = $this->upload->data();

            if (strlen($nome) == 0) {
                $nome = $dati['raw_name'];
            }


            $sql = "INSERT INTO file_offerte_clienti (offerta_id,url,nome) VALUES (?,?,?)";
            $this->db->query($sql, array($id_offerta, $dati['file_name'], $nome));

            redirect($precedente);
        }
    }

    /**
     * @todo fare il modulo che invia le mail
     */
    public function invia_mail_offerte() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $id = $this->input->post('id');
        if (!is_numeric($id)) {
            die();
        }




        $this->load->library('email');
        $this->load->helper('email');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtps.cgr-riciclodelpet.it',
            'smtp_port' => 465,
            'smtp_crypto' => 'ssl',
            'smtp_user' => 'noreply@cgr-riciclodelpet.it',
            'smtp_pass' => '[9yw1wMA',
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );


        $sql = "SELECT cliente_id FROM off_cli WHERE offerte_per_cliente_id = ?";
        $ris = $this->db->query($sql, array($id))->result_array();
        $sql2 = "SELECT *,UNIX_TIMESTAMP(timestamp) AS dat FROM offerte_per_cliente WHERE id = ?";
        $ris2 = $this->db->query($sql2, array($id))->row_array();

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

        //model che genera i contenuto
        $this->load->model('av_m', 'av_m');




        foreach ($ris as $value) {
            $sql = "SELECT email,chiave FROM anagrafica WHERE id = ?";
            $r = $this->db->query($sql, $value['cliente_id'])->row_array();

            $valori = $this->av_m->dettagli_prodotto($ris2['id']);

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
//            $this->load->view('av_dettaglio_offerta_view', $dati);

            $mess = '<html>
                <head>
                 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                 <link rel="stylesheet" media="screen" type="text/css" href="' . base_url() . 'css/default.css"/>
                </head><body>';

            $mess .='
                


        <div id="content">

            <div id="logo_header">
            </div>
           
            <div id="intestazione" class="av_" >

            </div>

        </div>
        
            <div id="av_dettaglio_offerta_view" class="contenuto">
            <h1>Offerta dal sito C.G.R. srl <br> You have received the following offer from C.G.R. srl.</h1>
                <div id="col_sx">
                    <div id="dett_foto1">' . @$dati['foto1'] . '</div>
                    <div id="dett_foto2">' . @$dati['foto2'] . '</div>
                    <div id="dett_foto3">' . @$dati['foto3'] . '</div>
                    <div id="dett_foto4">' . @$dati['foto4'] . '</div>
                    <div id="dett_foto5">' . @$dati['foto5'] . '</div>
                    <div id="grande_foto">' . @$dati['foto_grande'] . '</div>
                    <div id="altre_info">' . @$dati['altre_info'] . '</div>
                </div>
                <div id="col_dx">
                    <div id="dettaglio_offerta_prodotto">
            ' . @$dati['dettaglio_offerta'] . '</div>
                    <div id="altro_dettaglio">
                        <div id="__sx___">' . @$dati['sx'] . '</div>
                        <div id="__dx___"> 
                        
</div>
                        <br class="clear_box">
                    </div>
                    
                
                <br class="clear_box">



            </div> <br><br>
          <div><h1 style="text-align:center; padding: 10px; font-weight: bold;">' . anchor('av/dettaglio_offerta_cliente/' . $ris2['id'] . '/' . urlencode($r['chiave']), 'Per ulteriori dettagli clicca qui / For further details click here ') . '  </h1></div>
</div>
            
        
<div id="footer">
    <p class="footer_text">C.G.R. srl • Via Casalvolone, 8 • 13010 Villata (VC) • Tel. 0161 310055 • info@cgr-riciclodelpet.it • P.IVA e C.F. 09803370155</p>
    <p class="footer_links">Design: <a target="_blank" href="http://www.bmcstudio.it">BMCstudio</a> • Powered by: <a href="http://www.ranaridens.com" target="_blank" >Ranaridens</a></p>
</div>';
            $mess .='</body></html>';

            if (valid_email($r['email'])) {
                $this->email->initialize($config);
                $this->email->from('noreply@cgr-riciclodelpet.it', 'CGR-riciclo del PET');
                $this->email->to($r['email']);
                $this->email->subject('CGR - Offerta / offer  - ' . $ris2['nome'] . ' - ' . date('d-m-Y', $ris2['dat']));
                $this->email->message($mess);
                $this->email->send();
                $this->email->clear();
            }
        }


//copia per amministratore
        $ris2 = $this->db->query($sql2, array($id))->row_array();

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

        $messamm = '<html>
                <head>
                 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                 <link rel="stylesheet" media="screen" type="text/css" href="' . base_url() . 'css/default.css"/>
                </head><body>';

        $messamm .='
                


        <div id="content">

            <div id="logo_header">
            </div>
           
            <div id="intestazione" class="av_" >

            </div>

        </div>
        
            <div id="av_dettaglio_offerta_view" class="contenuto">
            <h1>Offerta dal sito C.G.R. srl <br> You have received the following offer from C.G.R. srl.</h1>
                <div id="col_sx">
                    <div id="dett_foto1">' . @$dati['foto1'] . '</div>
                    <div id="dett_foto2">' . @$dati['foto2'] . '</div>
                    <div id="dett_foto3">' . @$dati['foto3'] . '</div>
                    <div id="dett_foto4">' . @$dati['foto4'] . '</div>
                    <div id="dett_foto5">' . @$dati['foto5'] . '</div>
                    <div id="grande_foto">' . @$dati['foto_grande'] . '</div>
                    <div id="altre_info">' . @$dati['altre_info'] . '</div>
                </div>
                <div id="col_dx">
                    <div id="dettaglio_offerta_prodotto">
            ' . @$dati['dettaglio_offerta'] . '</div>
                    <div id="altro_dettaglio">
                        <div id="__sx___">' . @$dati['sx'] . '</div>
                        <div id="__dx___"> 
                        
</div>
                        <br class="clear_box">
                    </div>
                    
                
                <br class="clear_box">



            </div> <br><br>
         <div>
<h1 style="text-align:center; padding: 10px; font-weight: bold;"> <a></a></h1>         
</div>
</div>
            
        
<div id="footer">
    <p class="footer_text">C.G.R. srl • Via Casalvolone, 8 • 13010 Villata (VC) • Tel. 0161 310055 • info@cgr-riciclodelpet.it • P.IVA e C.F. 09803370155</p>
    <p class="footer_links">Design: <a target="_blank" href="http://www.bmcstudio.it">BMCstudio</a> • Powered by: <a href="http://www.ranaridens.com" target="_blank" >Ranaridens</a></p>
</div>';
        $messamm .='</body></html>';




        $this->email->initialize($config);
        $this->email->from('noreply@cgr-riciclodelpet.it', 'CGR-Cpia offerta');
        $this->email->to('alberto.rimini@fastwebnet.it');
        $this->email->subject('CGR - Offerta (copia per l\'amministratore) ' . $ris2['nome'] . ' del ' . date('d-m-Y', $ris2['dat']));
        $this->email->message($messamm);
//        $this->email->send();


//        echo $this->email->print_debugger();

        echo'Mail inviata!';
    }

    public function visualizza($id) {
        $sql = "SELECT * FROM foto WHERE inserzione_id = ?";
        $foto = $this->db->query($sql, array($id))->result_array();
        $sql = "SELECT * FROM file_offerta WHERE inserzione_id = ?";
        $file = $this->db->query($sql, array($id))->result_array();
        $sql = "SELECT * FROM offerte WHERE id =?";
        $testo = $this->db->query($sql, array($id))->row_array();



        $testo_ok = "<ul>";

        $testo_ok .='<li>DATI OFFERTA</li>';
        $testo_ok .='<li>ID offerta: ' . $testo['id'] . '</li>';
        $testo_ok .='<li>Polimero: ' . $testo['polimero'] . '</li>';
        $testo_ok .='<li>Quantità: ' . $testo['quantita'] . '</li>';
        $testo_ok .='<li>Prezzo: ' . $testo['prezzo'] . '</li>';
        $testo_ok .='<li>Descrizione: ' . $testo['descrizione'] . '</li>';
//        $testo_ok .='<li>Email: ' . $testo['email'] . '</li>';
        $testo_ok .='<li>Ultima modifica: ' . $testo['timestamp'] . '</li>';
        $testo_ok .='<li>inserimento' . date('d-m-Y', $testo['inserimento']) . '</li>';
        $testo_ok .='<li>DATI UTENTE</li>';

        if ($testo['utente_id'] == 0) {
            $testo_ok .='<li>Amministratore</li>';
        } else {
            $sql = "SELECT * FROM anagrafica WHERE id =?";
            $utente = $this->db->query($sql, array($testo['utente_id']))->row_array();

            $testo_ok .='<li>' . $utente['attivo'] . '</li>';
            $testo_ok .='<li>' . $utente['categoria'] . '</li>';
            $testo_ok .='<li>' . $utente['rag_soc'] . '</li>';
            $testo_ok .='<li>' . $utente['indirizzo'] . '</li>';
            $testo_ok .='<li>' . $utente['citta'] . '</li>';
            $testo_ok .='<li>' . $utente['nazione'] . '</li>';
            $testo_ok .='<li>' . $utente['provincia'] . '</li>';
            $testo_ok .='<li>' . $utente['piva'] . '</li>';
            $testo_ok .='<li>' . $utente['telefono'] . '</li>';
            $testo_ok .='<li>' . $utente['web'] . '</li>';
            $testo_ok .='<li>' . $utente['nome'] . '</li>';
            $testo_ok .='<li>' . $utente['cognome'] . '</li>';
            $testo_ok .='<li>' . $utente['email'] . '</li>';
        }

        $testo_ok .="</ul>";
        
        $file_ok="";
        foreach ($file as $value) {
            $file_ok .=anchor('uploads_file/'.$value['url'],$value['url'],'target="_blank"').br();
        }
        
        $foto_ok="";
        foreach ($foto as $value) {
            $foto_ok .=img('uploads_foto/'.$value['thumb']).br();
        }

//        echo '<pre>';
//        print_r($file);
//        print_r($foto);
//        echo '</pre>';

        
        
        
        $data['testo']=$testo_ok;
        $data['file']=$file_ok;
        $data['foto']=$foto_ok;
        
        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/offerte_visualizza_dettaglio', $data);
        $this->load->view('admin/admin_footer_view');


    }

}
