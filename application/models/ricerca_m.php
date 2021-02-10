<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clienti_m
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 22-giu-2013, Diego Bellati diego@ranaridens.com
 */
class Ricerca_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function ricerca($valore) {
        $valore = trim(htmlspecialchars($valore));
        $cliente_id = $this->session->userdata('id');
        echo $cliente_id;
        if ($cliente_id) {
            $sql = "SELECT * FROM off_cli WHERE cliente_id=? ORDER BY offerte_per_cliente_id DESC";
            $r = $this->db->query($sql, $cliente_id)->result_array();



//        $sql="SELECT * FROM offerte_per_cliente 
//           JOIN off_cli
//           ON offerte_per_cliente.id = off_cli.offerte_per_cliente_id
//            
//
//                
//                WHERE  cliente_id = $cliente_id 
//                    AND attivo = 1 
//                     AND(         
//             nome LIKE '%$valore%' 
//            OR descrizione LIKE '%$valore%'
//            OR peso LIKE '%$valore%' 
//            OR prezzo LIKE '%$valore%')
//                ";
//            
//        $ris=$this->db->query($sql,array($cliente_id));
         
            $this->load->helper('text');
            $tabella = '<table class="tab_ris_ricerca"><tr><td></td><td></td><td></td><td></td></tr><tbody>';
//            $cont=1;
            foreach ($r as $value) {
//                echo $cont.br();
//                echo '<pre>';
//                print_r($value);
//                echo '</pre>';
                $sql = "SELECT *,UNIX_TIMESTAMP(timestamp) AS data FROM offerte_per_cliente  WHERE id=? AND attivo = 1 AND
                    ((descrizione LIKE '%$valore%') OR (peso LIKE '%$valore%')  OR (prezzo LIKE '%$valore%') OR (nome LIKE'%$valore%'))
                        ";
                $ris=$this->db->query($sql, $value['offerte_per_cliente_id'])->row_array();
                if(count($ris)==0)
                {
                    continue;
                }
//                                echo '<pre>';
//                print_r($ris);
//                echo '</pre>';
                $tabella .='<tr><td>' . date('d/M/Y',$ris['data']) . '</td><td>' . $ris['codice'] . '</td>
                <td>' . $ris['nome'] . '</td>
                    <td>' . $ris['quantita'] . '</td><td>' . word_limiter($ris['descrizione'], 30) . '</td>
                        <td>' . anchor('av/dettaglio_offerta_cliente/' . $ris['id'], 'Visualizza tutto / View more') . '</td></tr>';
//                $cont++;
                
            }





            $tabella .= '</tbody></table>';

            return $tabella;
        } else {
            return 'Nessun risultato / no results found';
        }
    }

}