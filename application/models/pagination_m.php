<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pagination_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function record_count() {
        //select * from offerte where cliente autorizzato = ?
        $cliente_id = $this->session->userdata('id');
        $sql = "SELECT * FROM off_cli WHERE cliente_id= $cliente_id";
        $ris = $this->db->query($sql, $cliente_id);

        return $ris->num_rows();
    }

    public function fetch_values($limit, $start) {
        $this->load->helper('text');
        $cliente_id = $this->session->userdata('id');
//        echo $cliente_id . br().'ccc';
        $sql = "SELECT * FROM off_cli WHERE cliente_id=? LIMIT $start,$limit";
        $ri = $this->db->query($sql, array($cliente_id));

        if($ri->num_rows()>0)
        {
        $ris=$ri->result_array();    
        
        $tab = "";


        foreach ($ris as $v) {
//            print_r($v);

            $sql = "SELECT * FROM offerte_per_cliente WHERE attivo = ? AND scadenza > ? AND id = ? ";
            $offerte = $this->db->query($sql, array(1, time(), $v['offerte_per_cliente_id']))->result_array();



            foreach ($offerte as $value) {
                $tab .= "<div class=clienti_offerta_cont>";

                $sql = "SELECT * FROM foto_offerte_clienti WHERE offerta_id = ?";
                $fo = $this->db->query($sql, array($value['id']));


                $sql = "SELECT * FROM file_offerte_clienti WHERE offerta_id = ?";
                $all = $this->db->query($sql, array($value['id']));

                if ($all->num_rows() > 0) {
                    $allegati = $all->result_array();
                    foreach ($allegati as $all) {
                        $allegati_ok[$all['nome']] = './file_offerte/'.$value['id'].'/' . $all['url'];
                    }
                }
                if ($fo->num_rows() > 0) {
                    $foto = $fo->result_array();
                    foreach ($foto as $f) {
                        $valori = array(
                            'src' => 'foto_offerte/'.$value['id'].'/' . $f['thumb'],
                            'alt' => $value['nome'],
                            'class' => 'immagine_cliente',
//                            'width' => '180',
//                            'height' => '130',
                            'title' => $value['nome'],
                            'rel' => 'lightbox',
                        );
                        $f_ok = img($valori);
                    }
                }
//              
                $tab .='<div class="clienti_cont_foto">' . anchor('av/dettaglio_offerta_cliente/' . $value['id'], @$f_ok) . '</div>';
                $tab .='<div class="clienti_cont_descr"><p>(d-m-Y)' . date('d-m-Y', $value['scadenza']) . '</p>
                    <p class="clienti_titoletto">' . $value['codice'] . '</p>
                    <p class="clienti_titoletto">' . strtoupper($value['nome']) . '</p>
                    <div>' . word_limiter($value['descrizione'], 10, '') . anchor('av/dettaglio_offerta_cliente/' . $value['id'], ' read more / leggi...') . '</div>
                    </div>';
                $tab .='<div class="clienti_cont_quantita">
                    <p class="clienti_titoletto">QUANTITA\' - QUANTITY</p>
                    <p>' . $value['quantita'] . '</p><br>
                         <p class="clienti_titoletto">PREZZO - PRICE</p>
                    <p>' . $value['prezzo'] . '</p>
     
                    </div>';
                $tab .='<div class="clienti_cont_allegati">
                    <p class="clienti_titoletto">ALLEGATI - ATTACHMENTS</p>';
                if (isset($allegati_ok)) {
                    foreach ($allegati_ok as $vl => $value) {
                        $tab .= '<a target="_blank" href="' . base_url() . $value . '"> ' . $vl . ' </a><p>';
                    }
                }
 

                $tab .='</div>';
            }
            $tab .='</div>';
        }
        }
        else
        {
            $tab = 'Non ci sono offerte/ No offers';
        }

        return $tab;
    }

    public function record_count_admin_offerte() {
        //select * from offerte where cliente autorizzato = ?
        return $this->db->count_all("offerte_per_cliente");
    }

    public function fetch_values_admin_offerte($start, $limit) {
        $this->load->helper('date');

        $sql = "SELECT * FROM offerte_per_cliente ORDER BY scadenza ASC, attivo DESC, codice DESC, nome ASC LIMIT $start,$limit ";
//        $sql = "SELECT * FROM offerte_per_cliente LIMIT $start,$limit ";
        $query = $this->db->query($sql);

        $tab = "<table><thead><tr><th>CODICE</th><th>NOME</th><th>POLIMERO</th><th>SCADENZA</th><th>RESIDUO</th>
            <th>AUMENTA DURATA OFFERTA</th><th>QUANTITA'</th><th>PREZZO</th><th>RESA</th><th>IMBALLO</th><th>PESO</th><th>MEZZO</th><th>CER</th><th>CLIENTI INTERESSATI</th><th>PUBBLICATA</th></tr></thead><tbody>";
        if ($query->num_rows() > 0) {
            $r = $query->result_array();
            foreach ($r as $row) {

                $sql = "SELECT *,anagrafica.rag_soc AS rag_soc from off_cli JOIN anagrafica ON anagrafica.id = off_cli.cliente_id WHERE offerte_per_cliente_id = ?";

                $ris = $this->db->query($sql, array($row['id']))->result_array();
                $drop = array();
                foreach ($ris as $value) {
                    $drop[$value['cliente_id']] = $value['rag_soc'];
                }

                if ($row['attivo'] == 1) {
                    $chkbox = form_checkbox('attivo', $row['attivo'], '', 'checked="checked" data-id="' . $row['id'] . '" class="attiva_disattiva"');
                } else {
                    $chkbox = form_checkbox('attivo', $row['attivo'], '', ' data-id="' . $row['id'] . '" class="attiva_disattiva"');
                }


                $ora = time();
                if ($row['scadenza'] < $ora) {
                    $scadenza = '<span style="color: red">' . date('d-m-Y', $row['scadenza']) . '</span>';
                    $residuo = 'scaduto';
                    $prolunga = form_fieldset() . form_input('nuova_scadenza', date('d-m-Y', $row['scadenza']), 'data-id="' . $row['id'] . '" class="class_prolunga_form"') . form_button('prolunga', 'salva', 'class="prolunga"') . form_fieldset_close();
                } elseif ($row['scadenza'] < $ora + 86000) {
                    $scadenza = '<span style="color: yellow">' . date('d-m-Y', $row['scadenza']) . '</span>';
                    $residuo = timespan(time(), $row['scadenza']);
                    $prolunga = form_fieldset() . form_input('nuova_scadenza', date('d-m-Y', $row['scadenza']), 'data-id="' . $row['id'] . '" class="class_prolunga_form"') . form_button('prolunga', 'salva', 'class="prolunga"') . form_fieldset_close();
                } else {
                    $scadenza = '<span style="color: green">' . date('d-m-Y', $row['scadenza']) . '</span>';
                    $residuo = timespan(time(), $row['scadenza']);
                    $prolunga = form_fieldset() . form_input('nuova_scadenza', date('d-m-Y', $row['scadenza']), 'data-id="' . $row['id'] . '" class="class_prolunga_form"') . form_button('prolunga', 'salva', 'class="prolunga"') . form_fieldset_close();
                }



                $tab .='<tr><td>' . $row['codice'] . '</td><td>' . $row['nome'] . '</td><td>' . $row['polimero'] . '</td><td>' .
                        $scadenza . '</td><td>' . $residuo . '</td><td>' . $prolunga . '</td><td>' .
                        $row['quantita'] . '</td><td>' . $row['prezzo'] . '</td><td>' . $row['resa'] . '</td><td>' . $row['imballo'] .
                        '</td><td>' . $row['peso'] . '</td><td>' . $row['mezzo'] . '</td><td>' .
                        $row['cer'] . '</td><td>' . form_dropdown('aa', $drop) . '</td><td>' . $chkbox . '</td><td>' .
                        anchor('admin/offerte/modifica_offerta_cliente/' . $row['id'], 'MODIFICA') . '</td><td>' .
                        anchor('admin/offerte/elimina_offerta_cliente/' . $row['id'], 'ELIMINA', 'class="elimina"') . '</td></tr>';
                $drop = array();
            }
            $tab .= '</tbody></table>';
            return $tab;
        }
        return false;
    }

}
