<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news_m
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 19-giu-2013, Diego Bellati diego@ranaridens.com
 */
class News_m extends CI_Model {

    public function __construct() {
        parent::__construct();
                     $login = $this->session->userdata('auth');
        if ($login != 'si') {
            redirect('errors/error_404');
        }
    }

    public function all_news()
    {
        $this->load->helper('text');
        $sql="SELECT *,UNIX_TIMESTAMP(timestamp) AS ut  FROM news ORDER BY inserimento DESC";
        $ris=$this->db->query($sql)->result_array();
        $tab="<table><thead><tr><th>data di pubblicazione</th><th>Ultima modifica</th>
            <th>titolo</th><th>anteprima</th><th>pubblicato</th><th>modifica</th><th>elimina</th></tr><tbody>";
        foreach ($ris as $value) {
            $tab .='<tr><td>'.date('d-m-y H:i',$value['inserimento']).'</td><td>'.date('d-m-y H:i',$value['ut']).
                    '</td><td>'.$value['titolo'].'</td><td>'.word_limiter($value['descrizione'],10).'</td>';
            if($value['attivo']==1)
            {
                $att=  form_checkbox('attivo',1,1,'class="chk_attivo" data-id="'.$value['id'].'"');
            }
            else{
                $att=  form_checkbox('attivo',0,0,'class="chk_attivo" data-id="'.$value['id'].'"');
            }
            $tab .='<td>'.$att.'</td><td>'.anchor('admin/news/modifica/'.$value['id'],'<button>modifica</button>').'</td><td>'.
                    anchor('admin/news/elimina/'.$value['id'],'<button class="elimina">elimina</button>').'</td></tr>';
                    
        }
        $tab .='</tbody></table>';
        return $tab;
    }

    public function form_inserimento($ris=0)
            
    {

        if($ris==0)
        {
            $form=  form_fieldset('Inserisci una news');
            $form.=form_open('admin/news/inserisci');
            $form.=form_label('Titolo:').br();
            $form.=form_input('titolo').br(3);
            $form.=form_label('Contenuto della news:').br();
            $form.=form_textarea('contenuto').br(3);
            $form.=form_submit('submit','Salva');
            $form.=form_close();
            $form.=  form_fieldset_close();
        }
        else
        {
                        $form=  form_fieldset('Inserisci una news');
            $form.=form_open('admin/news/salva_modifica');
            $form.=form_label('Titolo:').br();
            $form.=form_input('titolo',$ris['titolo']).br(3);
            $form.=form_hidden('id',$ris['id']);
            $form.=form_label('Contenuto della news:').br();
            $form.=form_textarea('contenuto',$ris['descrizione']).br(3);
            $form.=form_submit('submit','Salva');
            $form.=form_close();
            $form.=  form_fieldset_close();
        }
        return $form;
    }
}

