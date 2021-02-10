<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gallery
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 12-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Gallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login = $this->session->userdata('auth');
        if ($login != 'si') {
            redirect('errors/error_404');
        }
        $this->load->model('gallery_m','model');
    }

    /**
     * 
     */
    public function index() {
        
    }

    public function visualizza($id) {

        $dati=array();
        $dati['anteprime']= $this->model->anteprime($id);
        $dati['url']=  $this->model->url($id);

        
                $this->load->view('admin/admin_head_view');
        $this->load->view('admin/menu');
        $this->load->view('admin/gallery_visualizza_view',$dati);
        $this->load->view('admin/admin_footer_view');
        
        
    }
    
    public function elimina_foto()
    {
        if(!$this->input->is_ajax_request())
        {
            redirect('errors/error_404');
        }
        $id=$this->input->post('id');
        $sql="SELECT * FROM gallery WHERE id=?";
        $ris=$this->db->query($sql,array($id))->row_array();
       


        unlink('./uploads/'.$ris['thumb']);
       unlink('./uploads/'.$ris['url']);

        $sql="DELETE FROM gallery WHERE id=?";
        $this->db->query($sql,array($id));
        
    }

}

