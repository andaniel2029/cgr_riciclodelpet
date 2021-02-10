<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria_m extends CI_Model {

    public function __construct() {
        parent::__construct();
                $login = $this->session->userdata('auth');
        if ($login != 'si') {
            redirect('errors/error_404');
        }
    }

    public function get_categorie() {
        $ris=  form_fieldset('Categorie presenti').'<table id="get_categoria"><tbody>';
        $sql = "SELECT * FROM categoria ORDER BY nome ASC";
        $query = $this->db->query($sql)->result_array();
        foreach ($query as $value) {
            $ris .= '<tr><td>'.$value['prefisso'].'</td><td>'.
                    $value['nome'].'</td><td>'.
                    anchor('admin/categoria/modifica/'.$value['id'],'modifica/elimina').'</td></tr>';
        }
        $ris .='</tbody></table>'.  form_fieldset_close();
        return $ris;
    }

    public function form_ins_categoria() {
        $form = "";
        $form .= form_fieldset('Inserisci una nuova categoria');
        $form .= form_open('admin/categoria/inserisci');
        $form .=form_label('Prefisso per il codice dei prodotti:') . br();
        $form .=form_input('prefisso') . br(2);
        $form .=form_label('Nome della categoria:') . br();
        $form .=form_input('nome') . br(2);
        $form .=form_label('descrizione della categoria:') . br();
        $form .=form_textarea('editor') . br(2);
        $form .=form_submit('submit', 'Inserisci');
        $form .=form_close();
        $form .=form_fieldset_close();

        return $form;
    }
    
    public function form_modifica($id)
    {
        $sql="SELECT * FROM categoria WHERE id=?";
        $ris=$this->db->query($sql,array($id))->row_array();

                $form = "";
        $form .= form_fieldset('Modifica categoria');
        $form .= form_open('admin/categoria/esegui_modifica');
        $form .=form_label('Prefisso per il codice dei prodotti:') . br();
        $form .=form_input('prefisso',$ris['prefisso']) . br(2);
        $form .=form_label('Nome della categoria:') . br();
        $form .=form_input('nome',$ris['nome']) . br(2);
        $form .=form_hidden('id',$ris['id']) . br(2);
        $form .=form_label('descrizione della categoria:') . br();
        $form .=form_textarea('editor',$ris['descrizione']) . br(2);
        $form .=form_submit('submit', 'Modifica');
        $form .=form_close();
        $form .=form_fieldset_close();

        return $form;
        
    }
    
   

}

