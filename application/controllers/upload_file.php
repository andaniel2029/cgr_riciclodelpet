<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upload_foto
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 28-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Upload_file extends CI_Controller {

    public function __construct() {
        parent::__construct();

//        $autorizzato = $this->session->userdata('autorizzato');
//        $auth = $this->session->userdata('auth');
//        $tipo = $this->session->userdata('tipo');
//        if($auth!='si' || $autorizzato !='si')
//        {
//            die();
//        }
//        if($tipo !='fornitore' && $auth !='si')
//        {
//            die();
//        }
//        
//   
    }

    /**
     * 
     */
    public function index() {
        
    }

    function do_upload() {

        $sql = "SELECT * FROM foto_upload_temp";

        $query = $this->db->query($sql);

        if ($query->num_rows >= 5) {
            echo 'Limite di file raggiunto';

            die();
        }






        $config['upload_path'] = './uploads_file/';
        $config['allowed_types'] = 'doc|xls|docx|xlsx|pdf';
        $config['max_size'] = '10000';
        $config['is_image'] = 0;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            $this->session->set_userdata(array('errori' => $this->upload->display_errors()));
            redirect('av/visualizza');
        } else {
            $this->load->helper('file'); //helper per i file
            $dati = $this->upload->data();

         
            $utente = $this->session->userdata('email');
            $sql = "INSERT INTO file_upload_temp (url,sessione_email) VALUES (?,?)";
            $this->db->query($sql, array($dati['file_name'],  $utente));


            redirect('av/visualizza');
        }
    }

}

