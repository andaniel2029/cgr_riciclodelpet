<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tools_m
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 12-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Tools_m extends CI_Model {

    public function __construct() {
        parent::__construct();
                     $login = $this->session->userdata('auth');
        if ($login != 'si') {
            redirect('errors/error_404');
        }
        $this->load->helper('string');
    }



        public function slug($string) {

        $string = preg_replace("`\[.*\]`U", "", strtolower($string));
        $string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i", "", $string);
        $string = preg_replace(array("`[^a-z0-9]`i", "`[-]+`"), "-", $string);

        $string = $this->verifica_slug($string);

//        while (TRUE) {
//            echo'dentro while '.$string.br();
//            if ($this->verifica_slug($string)) {
//                echo'dentro if(true) '.$string.br();
//                break;
//            }
//            else{
//                echo'dentro if(false) '.$string.br();
//                $string = increment_string($string, '-');
//                echo'if false dopo increment '.$string.br();
//            }
//        }
//echo'dopo while'.$string.br();
        return $string;
    }

    public function meta_key($string) {
        $ex = explode(',', $string);
        $controllato = array();
        foreach ($ex as $value) {
            $controllato[] = $this->slug($value);
        }
        return implode(',', $controllato);
    }

    private function verifica_slug($string) {
        
        while (true) {
            $sql = "SELECT id FROM prodotti WHERE slug=?";
            $query = $this->db->query($sql, array($string));
            if ($query->num_rows() > 0) {

                $string = increment_string($string, '-');
                $this->verifica_slug($string);
            } else {
                break;
            }
        }
        return $string;
    }

}

