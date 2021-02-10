<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of av_m+ù
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 27-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Av_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_inserzioni() {
        $id = $this->session->userdata('id');

        $sql = "SELECT * FROM offerte WHERE utente_id=? LIMIT 5";
        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() > 0) {
            $ris = $query->result_array();
            $tab = '<table><thead><tr><th>data (d-m-Y)/date</th><th>nome/name</th><th>dettagli/details</th></tr></thead><tbody>';

            foreach ($ris as $value) {
                $tab .='<tr>'
                        . '<td>' . date('d-m-Y', $value['inserimento']) . '</td>'
                        . '<td>' . $value['nome'] . '</td>'
                        . '<td>' . $value['polimero'] .br(). $value['prezzo'].br(). $value['quantita'].
//                        anchor('av/get_details/' . $value['id'], '<button>dettagli/details</button>').
                        '</td></tr>';
            }

            $tab .='</tbody></table>';
        } else {
            $tab = "Nessuna offerta precedente / no offers" . br();
        }
        return $tab;
    }

    public function get_foto($email) {
        $sql = 'SELECT * FROM foto_upload_temp WHERE sessione_email = ?';
        $query = $this->db->query($sql, array($email));

        $foto['foto1'] = 'imagemissing.jpg';
        $foto['foto2'] = 'imagemissing.jpg';
        $foto['foto3'] = 'imagemissing.jpg';
        $foto['foto4'] = 'imagemissing.jpg';
        $foto['foto5'] = 'imagemissing.jpg';




        $ris = $query->result_array();
        $count = 1;
        foreach ($ris as $value) {
            $foto['foto' . $count] = $value['thumb'];
            $count++;
        }


        return $foto;
    }

    public function get_file() {

        $sql = "SELECT * FROM file_upload_temp WHERE sessione_email = ?";
        $sessione_email = $this->session->userdata('email');

        $ris = $this->db->query($sql, array($sessione_email))->result_array();

        $file = array();

        $file['file1'] = '';
        $file['file2'] = '';
        $file['file3'] = '';
        $file['file4'] = '';
        $file['file5'] = '';




        $count = 1;
        foreach ($ris as $value) {
            $file['file' . $count] = $value['url'];
            $count++;
        }



        return $file;
    }

    public function get_form() {
        $form = "";
        $form .= form_label('Nome prodotto - Product Name') . br();
        $form .= form_input('nome', $this->session->userdata('nome')) . br();
        $form .= form_label('Polimero - Polymer') . br();
        $form .= form_input('polimero', $this->session->userdata('polimero')) . br();
        $form .= form_label('quantità - Quantity') . br();
        $form .= form_input('quantita', $this->session->userdata('quantita')) . br();
        $form .= form_label('prezzo - Price') . br();
        $form .= form_input('prezzo', $this->session->userdata('prezzo')) . br();
        $form .= form_label('descrizione - Description') . br();
        $form .= form_textarea('descrizione', $this->session->userdata('descrizione')) . br();
        return $form;
    }

    /**
     * @todo inviare mail
     * @param type $id
     * @return string
     */
    public function dettagli_prodotto($id) {

//        if(!is_numeric($id))
//        {

        $valori['foto1'] = img('img/ELEMENTI_FISSI/imagemissing.jpg');
        $valori['foto2'] = img('img/ELEMENTI_FISSI/imagemissing.jpg');
        $valori['foto3'] = img('img/ELEMENTI_FISSI/imagemissing.jpg');
        $valori['foto4'] = img('img/ELEMENTI_FISSI/imagemissing.jpg');
        $valori['foto5'] = img('img/ELEMENTI_FISSI/imagemissing.jpg');
        $valori['foto_grande'] = img('img/ELEMENTI_FISSI/imagemissing_big.jpg');


        $sql = "SELECT * FROM foto_offerte_clienti WHERE offerta_id =$id";
        $ris_foto = $this->db->query($sql, array($id))->result_array();

        $count = 1;
        foreach ($ris_foto as $value) {

            list($w, $h) = getimagesize(base_url() . 'foto_offerte/' . $id . '/' . $value['thumb']);
            if ($w >= $h) {
                $w_ok = 60;
                 $valori['foto' . $count] = img(array("src" => 'foto_offerte/' .$id.'/'. $value['thumb'], 'width' => $w_ok,  "class" => "ant_foto","data-url"=>  base_url().'foto_offerte/'.$id.'/'.$value['foto']));
            } else {
                $h_ok = 60;
                 $valori['foto' . $count] = img(array("src" => 'foto_offerte/' .$id.'/'. $value['thumb'], 'height' => $h_ok,  "class" => "ant_foto","data-url"=>  base_url().'foto_offerte/'.$id.'/'.$value['foto']));
            }




            if ($count == 1) {
                            list($w, $h) = getimagesize(base_url() . 'foto_offerte/' . $id . '/' . $value['thumb']);
            if ($w >= $h) {
                $w_ok = 360;
                 $valori['foto_grande'] = img(array("src" => 'foto_offerte/' . $id . '/' . $value['foto'], 'width' => $w_ok));
            } else {
                $h_ok = 300;
                 $valori['foto_grande'] = img(array("src" => 'foto_offerte/' . $id . '/' . $value['foto'], 'height' => $h_ok));
            }
                
            }
            $count++;
        }

        $sql = "SELECT *,UNIX_TIMESTAMP(timestamp) AS ts FROM offerte_per_cliente WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() == 0) {
            die('zero');
        }
        $ris_offerta = $query->row_array();

        $rifiuto = $ris_offerta['rifiuto'];
        if ($rifiuto == 'si') {
            $rifiuto = 'si/yes';
        } else {
            $rifiuto = 'no';
        }

        $altre_info = '<h1>ALTRE INFORMAZIONI -FURTHER INFORMATIONS</h1><p>
    <p>Condizioni di resa - Terms of yeld:<strong>' . nbs(3) . $ris_offerta['resa'] . '</strong><br>           
Tipo di imballo - Packaging type:<strong>' . nbs(3) . $ris_offerta['imballo'] . ' </strong> <br>        
Peso trasportato - Transport weight:<strong>' . nbs(3) . $ris_offerta['peso'] . ' </strong> <br>         
Mezzo di trasporto - Means of transport:<strong>' . nbs(3) . $ris_offerta['mezzo'] . ' </strong><br>           
Rifiuto - Waste:<strong>' . nbs(3) . $rifiuto . '   </strong><br>     
    Polimero - Polymer:<strong>' . nbs(3) . $ris_offerta['polimero'] . '   </strong><br>   
Codice CER - EWC-code:<strong>' . nbs(3) . $ris_offerta['cer'] . '</strong>';

        $valori['altre_info'] = $altre_info;


        $dettagli = date('d-m-Y', $ris_offerta['ts']) . heading($ris_offerta['codice'], 1) . heading($ris_offerta['nome'], 1) . '<p>' . $ris_offerta['descrizione'] . '</p>';
        $valori['dettaglio_offerta'] = $dettagli;

        $sx = heading('QUANTITA\'-QUANTITY', 1) . $ris_offerta['quantita'] . heading('PREZZO - PRICE', 1) . $ris_offerta['prezzo'];


        $valori['sx'] = $sx;

        $sql = "SELECT * FROM file_offerte_clienti WHERE offerta_id =$id";
        $ris_file = $this->db->query($sql, array($id));
        $lista_val = "";
        if ($ris_file->num_rows() > 0) {
            $lista_val = heading('ALLEGATI - ATTACHMENTS', 1) . '<p>';
            $ris = $ris_file->result_array();
            foreach ($ris as $value) {
                $lista_val .= '<a href="' . base_url() . 'file_offerte/' .$id.'/'. $value['url'] . '">' . $value['nome'] . '</a><br>';
            }
            $lista_val .='</p>';
        }
        $valori['dx'] = $lista_val;

        $form_contatti = heading('RICHIEDI INFORMAZIONI - WRITE US', 1) . '<textarea id="contenuto_dettaglio_offerta" cols="40" rows="3"></textarea>' . br() . '<div id="bott_invia_dettaglio_offerta">
         <button id="btn_rich_info_prod" >INVIA-SEND</button></div>';
        $valori['form_contatti'] = $form_contatti;
        return $valori;
    }

}
