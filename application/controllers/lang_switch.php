<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lang_switch
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 23-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Lang_switch extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     */
    public function index() {
        die('Resticted');
    }
    
    public function sw($page)
    {
        
        $url= htmlspecialchars(trim($page));
        
        if($this->session->userdata('lang')=='it')
        {
        $this->session->set_userdata(array('lang'=>'en'));
        }
        else
        {
            $this->session->set_userdata(array('lang'=>'it'));            
        }
        
        
//        logica
        
        redirect($url);
        
    }

}

