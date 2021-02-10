<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of form_check
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 22-giu-2013, Diego Bellati diego@ranaridens.com
 */
class form_check extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function check_string() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $string = htmlspecialchars(trim($this->input->post('string')));
        $min = htmlspecialchars(trim($this->input->post('min')));
        $max = htmlspecialchars(trim($this->input->post('max')));
        $lun=strlen($string);
        if ( $lun < $max && $lun > $min) {
            echo '1';
        } else {
            echo '0';
        }
    }
    public function check_password() {
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $pswd1 = htmlspecialchars(trim($this->input->post('pswd1')));
        $pswd2 = htmlspecialchars(trim($this->input->post('pswd2')));
        
        $min = htmlspecialchars(trim($this->input->post('min')));
        $max = htmlspecialchars(trim($this->input->post('max')));        
        
        $lun=strlen($pswd1);
        $lun2=strlen($pswd2);
        if($pswd1!=$pswd2)
        {
            echo '0';
        }       
        
        elseif ( $lun2 < $max && $lun > $min) {
            echo '1';
        } else {
            echo '0';
        }
    }
    public function check_checkbox() {
 
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $string = htmlspecialchars(trim($this->input->post('string')));
       
        if ( $string!=1) {
            echo '1';
        } else {
            echo '0';
        }
    }
    public function check_email() {
 
        if (!$this->input->is_ajax_request()) {
            die();
        }
        $string = htmlspecialchars(trim($this->input->post('string')));
       $this->load->helper('email');
       
       
        if (valid_email($string)) {
            echo '1';
        } else {
            echo '0';
        }
    }
    
    

}

