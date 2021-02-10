<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        echo' sei in index';
    }

    public function carica($id = 0) {
        $id = (int) $id;
//        if ($id == 0) {
//            //immagini della gallery home sono immagini con prodotto id = 0
//            $this->load->view('admin/admin_head_view');
//            $this->load->view('admin/menu');
//            $this->load->view('admin/uploader', array('error' => ' ', 'id' => $id));
//            $this->load->view('admin/admin_footer_view');
//        }

        $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');

        $this->load->view('admin/uploader', array('error' => ' ', 'id' => $id));

        $this->load->view('admin/admin_footer_view');
    }

    function do_upload($id) {
        //se id=0 sono le foto in homepage quindi hanno valori differenti
        if ($id == 0) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
        } else {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';
        }


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            $error = array('error' => $this->upload->display_errors(), 'id' => $id);
            $this->load->view('admin/admin_head_view');
            $this->load->view('admin/menu');
            $this->load->view('admin/uploader', $error);
            $this->load->view('admin/admin_footer_view');
        } else {
            $dati = $this->upload->data();
            
           
           $this->load->helper('file');//helper per i file

           
  //configuro la libreria per il thumb
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/'.$dati['file_name'];
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 300;
            $config['height'] = 300;
 //carico la libreria
             $this->load->library('image_lib',$config); //modifico le immagini per creare miniatura
             //ridimensiono immagine preservando l'originale
            $this->image_lib->resize();            

            $thumb_name=$dati['raw_name'].'_thumb'.$dati['file_ext'];
            
            $sql = "INSERT INTO gallery (url,thumb) VALUES (?,?)";
            $this->db->query($sql, array($dati['file_name'],$thumb_name, $id));

            $data = array('upload_data' => $dati);
            $this->load->view('admin/admin_head_view');
            $this->load->view('admin/menu');
            $this->load->view('admin/upload_success', $data);
            $this->load->view('admin/admin_footer_view');
        }
    }

}
?>

