<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of offerte_m
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 28-giu-2013, Diego Bellati diego@ranaridens.com
 */
class offerte_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_offerte_fornitori() {
        $sql = "SELECT * FROM offerte ORDER BY inserimento DESC ";
        $ris = $this->db->query($sql)->result_array();



        $lista = '<table> <thead><tr><th>Data ins.</th><th>Nome offerta</th><th>polimero</th><th>q.tà</th><th>prezzo</th><th>Rag. sociale</th>
            <th>responsabile</th><th></th><th></th><th></th></tr></thead><tbody>';

        foreach ($ris as $value) {

            if ($value['utente_id'] == 0) {//e quindi amministratore
                $sql2 = "SELECT * FROM anagrafica WHERE id = ?";
                $ris2 = $this->db->query($sql2, array($value['utente_id']))->row_array();

                $lista .='<tr><td>'
                        . date('d-m-Y', $value['inserimento']) .
                        '</td><td>' . $value['nome'] .
                        '</td><td>' . $value['polimero'] .
                        '</td><td>' . $value['quantita'] .
                        '</td><td>' . $value['prezzo'] .
                        '</td><td>' . 'admin' .
                        '</td><td>' . 'admin admin' .
                        '</td><td>' . '<button class="dettaglio_off" data-id="' . $value['id'] . '">descrizione</button>' .
                        '</td><td>' . '<button class="crea_off" data-id="' . $value['id'] . '">crea offerta per clienti</button>' .
                        '</td><td>' . anchor('admin/offerte/elimina_off_fornitore/' . $value['id'], '<button class="elimina">Elimina offerta</button>') .
                        '</td><td>' . anchor('admin/offerte/visualizza/' . $value['id'], '<button>Visualizza</button>') .
                        '</td></tr>';
            } else {
                $sql2 = "SELECT * FROM anagrafica WHERE id = ?";
                $ris2 = $this->db->query($sql2, array($value['utente_id']))->row_array();

                $lista .='<tr><td>'
                        . date('d-m-Y', $value['inserimento']) .
                        '</td><td>' . $value['nome'] .
                        '</td><td>' . $value['polimero'] .
                        '</td><td>' . $value['quantita'] .
                        '</td><td>' . $value['prezzo'] .
                        '</td><td>' . $ris2['rag_soc'] .
                        '</td><td>' . $ris2['cognome'] . $ris2['nome'] .
                        '</td><td>' . '<button class="dettaglio_off" data-id="' . $value['id'] . '">descrizione</button>' .
                        '</td><td>' . '<button class="crea_off" data-id="' . $value['id'] . '">crea offerta per clienti</button>' .
                        '</td><td>' . anchor('admin/offerte/elimina_off_fornitore/' . $value['id'], '<button class="elimina">Elimina offerta</button>') .
                        '</td><td>' . anchor('admin/offerte/visualizza/' . $value['id'], '<button>Visualizza</button>') .
                        '</td></tr>';
            }
        }

        $lista .='</tbody></table>';

        return $lista;
    }

    public function modifica_offerta_cliente_form($id) {
        $sql = "SELECT * FROM offerte_per_cliente WHERE id = ?";
        $ris = $this->db->query($sql, array($id))->row_array();

        $sql = "SELECT * FROM off_cli WHERE offerte_per_cliente_id = ?";
        $ris2 = $this->db->query($sql, array($id))->result_array();

        $cli_in_offerta = array();
        foreach ($ris2 as $value) {

            array_push($cli_in_offerta, $value['cliente_id']);
        }
//        print_r($cli_in_offerta);
        $sql = "SELECT * FROM anagrafica WHERE tipo = 'cliente' AND attivo = '1'";
        $ris3 = $this->db->query($sql)->result_array();

        $clienti = array();
        $clienti[] = '---';
        foreach ($ris3 as $value) {
            $clienti[$value['id']] = $value['rag_soc'] . ' ' . $value['cognome'] . ' ' . $value['email'];
        }

        $form = "";
        $form .=form_hidden('id', $ris['id']) . br();
        $form .=form_label('Nome:', 'nome');
        $form .=form_input('nome', $ris['nome']) . br();
        $form .=form_hidden('id_offerta_originale');
        $form .=form_label('Polimero:', 'polimero');
        $form .=form_input('polimero', $ris['polimero']) . br();
        $form .=form_label('Quantità', 'quantita');
        $form .=form_input('quantita', $ris['quantita']) . br();
        $form .=form_label('Prezzo', 'prezzo');
        $form .=form_input('prezzo', $ris['prezzo']) . br();
        $form .=form_label('Condizioni di resa', 'resa');
        $form .=form_input('resa', $ris['resa']) . br();
        $form .=form_label('Imballo', 'imballo');
        $form .=form_input('imballo', $ris['imballo']) . br();
        $form .=form_label('Peso trasportato', 'peso');
        $form .=form_input('peso', $ris['peso']) . br();
        $form .=form_label('Mezzo di trasportato', 'mezzo');
        $form .=form_input('mezzo', $ris['mezzo']) . br();
        $form .=form_label('Codice CER', 'cer');
        $form .=form_input('cer', $ris['cer']) . br();
                $form .=form_label('Rifiuto', 'rifiuto');
        if ($ris['rifiuto'] == 'no') {
            $form .='  si' . form_radio('rifiuto', 'si') . 'no' . form_radio('rifiuto', 'no', TRUE) . br();
        } else {
            $form .='  si' . form_radio('rifiuto', 'si',TRUE) . 'no' . form_radio('rifiuto', 'no') . br();
        }
        $form .=form_label('Descrizione', 'descrizione') . br();
        $form .=form_textarea('descrizione', $ris['descrizione'], 'id="text_area_offerte"') . br();

        $form .=form_label('Clienti ai quali è destinata l\'offerta (CTRL+click per selezionare più clienti)', 'destinatari') . br();
        $form .=form_multiselect('destinatari', $clienti, $cli_in_offerta, 'size="10" id="multiselect"') . br();

        $form .=form_button('offerte_per_clienti_button', 'AVANTI') . br();

        return $form;
    }

    public function get_offerte_per_clienti() {

        $sql = "SELECT * FROM anagrafica WHERE tipo = 'cliente' AND attivo = '1'";
        $ris = $this->db->query($sql)->result_array();

        $clienti = array();
        $clienti[] = '---';
        foreach ($ris as $value) {
            $clienti[$value['id']] = $value['rag_soc'] . ' ' . $value['cognome'] . ' ' . $value['email'];
        }



        $form = "";

        $form .=form_label('Nome:', 'nome');
        $form .=form_input('nome') . br();
        $form .=form_hidden('id_offerta_originale');
        $form .=form_label('Polimero:', 'polimero');
        $form .=form_input('polimero') . br();
        $form .=form_label('Quantità', 'quantita');
        $form .=form_input('quantita') . br();
        $form .=form_label('Prezzo', 'prezzo');
        $form .=form_input('prezzo') . br();
        $form .=form_label('Condizioni di resa', 'resa');
        $form .=form_input('resa') . br();
        $form .=form_label('Imballo', 'imballo');
        $form .=form_input('imballo') . br();
        $form .=form_label('Peso trasportato', 'peso');
        $form .=form_input('peso') . br();
        $form .=form_label('Mezzo di trasportato', 'mezzo');
        $form .=form_input('mezzo') . br();
        $form .=form_label('Codice CER', 'cer');
        $form .=form_input('cer') . br();
        $form .=form_label('Rifiuto', 'rifiuto');
        $form .='  si' . form_radio('rifiuto', 'si') . 'no' . form_radio('rifiuto', 'no', TRUE) . br();
        $form .=form_label('Scadenza', 'scadenza');
        $form .=form_input('scadenza', date('d-m-Y', time() + 864000), 'readonly="readonly"') . br();
        $form .=form_label('Attiva', 'attiva');
        $form .=form_checkbox('attiva', '1', 'checked="checked"') . br();
        $form .=form_label('Descrizione', 'descrizione') . br();
        $form .=form_textarea('descrizione', '', 'id="text_area_offerte"') . br();
        $form .=form_label('Clienti ai quali è destinata l\'offerta (CTRL+click per selezionare più clienti)', 'destinatari') . br();
        $form .=form_multiselect('destinatari', $clienti, 0, 'size="10" id="multiselect"') . br();

        $form .=form_button('offerte_per_clienti_button', 'AVANTI') . br();

        return $form;
    }

}

