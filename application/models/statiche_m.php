<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of statiche_m
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 15-giu-2013, Diego Bellati diego@ranaridens.com
 */
class statiche_m extends CI_Model {

    public function __construct() {
        parent::__construct();
                     $login = $this->session->userdata('auth');
        if ($login != 'si') {
            redirect('errors/error_404');
        }
    }

    /**
     * 
     */
    public function form() {
        $form="";
        
        $sql="SELECT * FROM statiche";
        $ris=  $this->db->query($sql)->row_array();
        
        $form .= form_label('Home page IT:').br(2);
        $form .= form_textarea('home',$ris['home'],'id="editor"').br();
        
        $form .= form_label('Home page EN:').br(2);
        $form .= form_textarea('home_en',$ris['home_en'],'id="editor1"').br();
        
        $form .= form_label('clienti IT:').br(2);
        $form .= form_textarea('clienti',$ris['clienti'],'id="editor2"').br();

        $form .= form_label('clienti EN:').br(2);
        $form .= form_textarea('clienti_en',$ris['clienti_en'],'id="editor3"').br();
        
        $form .= form_label('fornitori:').br(2);
        $form .= form_textarea('fornitori_it',$ris['fornitori'],'id="editor4"').br();
        $form .= form_label('fornitori EN:').br(2);
        $form .= form_textarea('fornitori_en',$ris['fornitori_en'],'id="editor5"').br();
        
        $form .= form_label('produzione:').br(2);
        $form .= form_textarea('produzione_it',$ris['produzione'],'id="editor6"').br();
        $form .= form_label('produzione EN:').br(2);
        $form .= form_textarea('produzione_en',$ris['produzione_en'],'id="editor7"').br();
   
        $form .= form_label('contatti:').br(2);
        $form .= form_textarea('contatti_it',$ris['contatti'],'id="editor8"').br();
        $form .= form_label('contatti EN:').br(2);
        $form .= form_textarea('contatti_en',$ris['contatti_en'],'id="editor9"').br();
        
        $form .= form_button('btn1','SALVA').br(2);
        
        
        return $form;
    }
    


}

