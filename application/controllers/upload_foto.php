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
class Upload_foto extends CI_Controller {

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
            echo 'Limite di foto raggiunto';

            die();
        }




        $config['upload_path'] = './uploads_foto/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '9280';
        $config['max_height'] = '9024';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            $this->session->set_userdata(array('errori' => $this->upload->display_errors()));
            redirect('av/visualizza');
        } else {
            $this->load->helper('file'); //helper per i file
            $dati = $this->upload->data();

            //configuro la libreria per il thumb
            $this->load->library('image_lib'); //modifico le immagini per creare miniatura

            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads_foto/' . $dati['file_name'];
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
            $utente = $this->session->userdata('email');
            $sql = "INSERT INTO foto_upload_temp (url,thumb,sessione_email) VALUES (?,?,?)";
            $this->db->query($sql, array($dati['file_name'], $thumb_name, $utente));


            redirect('av/visualizza');
        }
    }

}

