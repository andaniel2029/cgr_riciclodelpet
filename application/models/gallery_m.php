<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gallery_m
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 12-giu-2013, Diego Bellati diego@ranaridens.com
 */
class gallery_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $login = $this->session->userdata('auth');
        if ($login != 'si') {
            redirect('errors/error_404');
        }
    }

    public function anteprime() {
        $sql = "SELECT * FROM gallery ORDER BY timestamp ASC";
        $ris = $this->db->query($sql)->result_array();

        $file = "<table id='elenco_foto'><tbody><tr>";
//        $cont = 1;
        foreach ($ris as $value) {
            $file .=
                    '<td>' . img(array('src'=>base_url() . 'uploads/' . $value['thumb'],'width'=>300)) . br() .anchor(base_url() . 'uploads/' . $value['url'],'link').nbs(4).
                    '<button data-id="'.$value['id'].'" class="elimina_foto">Elimina</button></td>';
//            if ($cont > 2) {
//                $file .='</tr></tr>';
//                $cont = 0;
//            }
//            $cont++;
        }
        $file .='</tr></tbody></table>';
        return  '<div id="thumbs_show" style="overflow:auto;">'.form_fieldset('Foto nella gallery').$file.  form_fieldset_close().'</div>
            <button  class="show_hide">mostra/nascondi foto</button>'.br(2);
    }

    public function url() {
        
    

        return form_fieldset('carica').anchor('admin/upload/carica/','<button >CARICA FOTO</button>').  form_fieldset_close();
    }

}

