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
class clienti_m extends CI_Model {

    public function __construct() {
        parent::__construct();
//        $login = $this->session->userdata('auth');
//        if ($login != 'si') {
//            redirect('errors/error_404');
//        }
    }

    /**
     * restituisce il form per aggiungere un cliente
     */
    public function aggiungi_clienti_form() {

        $tab = '<div id="tabella_1" > <table id="tabella_1_1"><tbody>';

        $tab .= '<tr>
           <td class="background_blue" ><form id="f1">' . form_radio('tipo', 'cliente', 'cliente') . nbs(5) . 'CLIENTE - CLIENT </td>
           <td class="background_blue" >' . form_radio('tipo', 'fornitore') . nbs(5) . 'FORNITORE - SUPPLIER</td></tr>';
        $tab .= '<tr><td class="color_blue" colspan=2>CATEGORIA - CATEGORY</td></tr>
            <tr><td>' . form_radio('categoria', 'produttore', 'produttore') . 'Produttore - Manufacturer</td>
                <td>' . form_radio('categoria', 'riciclatore') . 'Riciclatore - Recycler</td></tr>
                    
    <tr><td>' . form_radio('categoria', 'raccoglitore') . 'Raccoglitore - Collector</td>
        <td>' . form_radio('categoria', 'intermediario') . 'Intermediario - Broker</td></tr></form></tbody></table>';

        $tab .= '<table id="tabella_2"><tbody><tr><td><form id="f2" class="color_blue">DATI AZIENDA - COMPANY DETAILS</td><td class="color_blue">PERSONA DI RIFERIMENTO</td></tr>
                <tr><td class="meta_tabella"><label>Ragione sociale* - Company Name*</label>' . br(1) . form_input('rag_soc', '', 'class="input_ko"') . br(2) .
                '<label>Indirizzo - Street address</label>' . br(1) . form_input('indirizzo', '', 'class="input_ko"') . br(2) .
                '<label>Città - City</label>' . br(1) . form_input('citta', '', 'class="input_ko"') . br(2) .
                '<label>Provincia - Province</label>' . br(1) . form_input('provincia', '', 'class="input_ko"') . br(2) .
                '<label>Nazione - Country</label>' . br(1) . form_input('nazione', '', 'class="input_ko"') . br(2) .
                '<label>Partita Iva - VAT No</label>' . br(1) . form_input('piva', '', 'class="input_ko"') . br(2) .
                '<label>Telefono - Telephone</label>' . br(1) . form_input('telefono', '', 'class="input_ko"') . br(2) .
                '<label>Sito Web - Website</label>' . br(1) . form_input('web', '', 'class="input_ko"') . '</td><td class="meta_tabella">
                           <label>Nome* - Name*</label>' . br(1) . form_input('nome', '', 'class="input_ko"') . br(2) .
                '<label>Cognome* - Surname*</label>' . br(1) . form_input('cognome', '', 'class="input_ko"') . br(2) .
                '<label>E-mail** - E-mail**</label>' . br(1) . form_input('email', '', 'class="input_ko"') . br(2) .
                '<label>Password** - Password** </label>' . br(1) . form_password('password', '', 'class="input_ko"') . br(2) .
                '<label>Conferma password - Confirm password</label>' . br(1) . form_password('password2', '', 'class="input_ko"') . br(2) . '<div class="testo_form_basso">
<p>
** Per garantire una buona comunicazione richiediamo<br>
l’e-mail diretta della persona di riferimento.<br><br>
To guarantee effective communication,<br>
the contact person’s direct email is required.<br><br>
*** Minino 6 caratteri.<br>
Minimum 6 alphanumeric characters

</p>
</div>
                           </form> </tr></tbody></table></div>
                            
<div id="consenso_tratt_dati">
<span class="consenso_titoletto">CONSENSO AL TRATTAMENTO DEI DATI PERSONALI:</span> Ai sensi della D.L g.S. n° 30.06.2003 n° 196 Vi informiamo che i vostri dati e il materiale
fotografico da voi fornito sono conservati nel nostro archivio informatico e saranno utilizzati da C.G.R. srl al fine di prestare il servizio in oggetto.
Vi informiamo che avrete il diritto in qualsiasi momento di conoscere, aggiornare, cancellare, rettificare i vostri dati o opporvi all’utilizzo degli stessi,
se trattati in violazione della Legge.<br>
<span class="consenso_titoletto">AGREEMENT FOR THE USE OF PERSONAL DETAILS: In accordance with Legislative
Decree gS n ° 196 30.06.2003 please be advised that your personal data and any
photographic material provided by you will be stored in our database and will be
used by C.G.R. Ltd. in order to provide the service in question.
Please be advised that you have the right at any given time to know, update, delete
or modify your data and to oppose the use of same if handled in violation of the
law.
</div>
<div class="accetto_form">
' . form_checkbox('accetto_pr', '1') . 'ACCETTO - ACCEPT' . br(2) . form_button('accetto', 'INVIA - SEND', 'class="background_blue"') . '
</div>
<br class="clear_box">
    </div>';

        return $tab;
    }

    public function aggiungi_clienti_form_admin() {

        $tab = '<div id="tabella_1" > <table><tbody>';

        $tab .= '<tr>
           <td class="background_blue" colspan=2><form id="f1">' . form_radio('tipo', 'cliente', 'cliente') . nbs(5) . 'Cliente</td>
           <td class="background_blue" colspan=2>' . form_radio('tipo', 'fornitore') . nbs(5) . 'FORNITORE</td></tr>';
        $tab .= '<tr><td class="color_blue" colspan=4>CATEGORIA</td></tr>
            <tr><td>' . form_radio('categoria', 'produttore', 'produttore') . '</td><td>Produttore</td>
                <td>' . form_radio('categoria', 'riciclatore') . '</td><td>Riciclatore</td></tr>
                    
    <tr><td>' . form_radio('categoria', 'raccoglitore') . '</td><td>Raccoglitore</td>
        <td>' . form_radio('categoria', 'intermediario') . '</td><td>Intermediario</td></tr></form></tbody></table>';

        $tab .= '<table id="tabella_2"><tbody><tr><td><form id="f2" class="color_blue">DATI AZIENDA</td><td class="color_blue">PERSONA DI RIFERIMENTO</td></tr>
                <tr><td class="meta_tabella"><label>Ragione sociale*</label>' . br(1) . form_input('rag_soc', '', 'class="input_ko"') . br(2) .
                '<label>Indirizzo</label>' . br(1) . form_input('indirizzo', '', 'class="input_ko"') . br(2) .
                '<label>Città</label>' . br(1) . form_input('citta', '', 'class="input_ko"') . br(2) .
                '<label>Provincia</label>' . br(1) . form_input('provincia', '', 'class="input_ko"') . br(2) .
                '<label>Nazione</label>' . br(1) . form_input('nazione', '', 'class="input_ko"') . br(2) .
                '<label>Partita Iva</label>' . br(1) . form_input('piva', '', 'class="input_ko"') . br(2) .
                '<label>Telefono - Phone</label>' . br(1) . form_input('telefono', '', 'class="input_ko"') . br(2) .
                '<label>Sito Web - Web site</label>' . br(1) . form_input('web', '', 'class="input_ko"') . '</td><td class="meta_tabella">
                           <label>Nome</label>' . br(1) . form_input('nome', '', 'class="input_ko"') . br(2) .
                '<label>Cognome</label>' . br(1) . form_input('cognome', '', 'class="input_ko"') . br(2) .
                '<label>E-mail</label>' . br(1) . form_input('email', '', 'class="input_ko"') . br(2) .
                '<label>Password</label>' . br(1) . form_password('password', '', 'class="input_ko"') . br(2) .
                '<label>Password</label>' . br(1) . form_password('password2', '', 'class="input_ko"') . br(2) . '<div class="testo_form_basso">
<p>
** Per garantire una buona comunicazione richiediamo
l’e-mail diretta della persona di riferimento.
Per garantire una buona comunicazione richiediamo
l’e-mail diretta della persona di riferimento.
*** Minino 6 caratteri 
Minino 6 caratteri .
</p>
</div>
                           </form> </tr></tbody></table></div>

<div class="accetto_form">
' . form_button('accetto', 'INVIA', 'class="background_blue"') . '
</div>
    </div>';



        return $tab;
    }

    public function modifica_clienti_form($id) {


        $sql = "SELECT * FROM anagrafica WHERE id = ?";
        $ris = $this->db->query($sql, $id)->row_array();


//        echo $ris['tipo'];

        $cliente = "";
        if ($ris['tipo'] == 'cliente') {
            $cliente = form_radio('tipo', 'cliente', 'checked');
            $fornitore = form_radio('tipo', 'fornitore');
        } else {
            $cliente = form_radio('tipo', 'cliente');
            $fornitore = form_radio('tipo', 'fornitore', 'checked');
        }

        $produttore = "";
        $riciclatore = "";
        $raccoglitore = "";
        $intermediario = "";

        switch ($ris['categoria']) {
            case 'produttore':
                $produttore = form_radio('categoria', 'produttore', 'checked');
                $riciclatore = form_radio('categoria', 'riciclatore');
                $raccoglitore = form_radio('categoria', 'raccoglitore');
                $intermediario = form_radio('categoria', 'intermediario');

                break;
            case 'riciclatore':
                $produttore = form_radio('categoria', 'produttore');
                $riciclatore = form_radio('categoria', 'riciclatore', 'checked');
                $raccoglitore = form_radio('categoria', 'raccoglitore');
                $intermediario = form_radio('categoria', 'intermediario');

                break;
            case 'raccoglitore':
                $produttore = form_radio('categoria', 'produttore');
                $riciclatore = form_radio('categoria', 'riciclatore');
                $raccoglitore = form_radio('categoria', 'raccoglitore', 'checked');
                $intermediario = form_radio('categoria', 'intermediario');

                break;
            case 'intermediario':
                $produttore = form_radio('categoria', 'produttore');
                $riciclatore = form_radio('categoria', 'riciclatore');
                $raccoglitore = form_radio('categoria', 'raccoglitore');
                $intermediario = form_radio('categoria', 'intermediario', 'checked');

                break;

            default:
                break;
        }




        $tab = '<div id="tabella_1" > <table><tbody>';

        $tab .= '<tr>
           <td class="background_blue" colspan=2><form id="f1">' . $cliente . nbs(5) . 'Cliente</td>
           <td class="background_blue" colspan=2>' . $fornitore . nbs(5) . 'FORNITORE</td></tr>';
        $tab .= '<tr><td class="color_blue" colspan=4>CATEGORIA</td></tr>
            <tr><td>' . $produttore . '</td><td>Produttore</td>
                <td>' . $riciclatore . '</td><td>Riciclatore</td></tr>
                    
    <tr><td>' . $raccoglitore . '</td><td>Raccoglitore</td>
        <td>' . $intermediario . '</td><td>Intermediario</td></tr></form></tbody></table>';

        $tab .= '<table id="tabella_2"><tbody><tr><td><form id="f2" class="color_blue">DATI AZIENDA</td><td class="color_blue">PERSONA DI RIFERIMENTO</td></tr>
                <tr><td class="meta_tabella"><label>Ragione sociale*</label>' . br(1) . form_input('rag_soc', $ris['rag_soc'], 'class="input_ko"') . br(2) .
                '<label>Indirizzo</label>' . br(1) . form_input('indirizzo', $ris['indirizzo'], 'class="input_ko"') . br(2) .
                '<label>Città</label>' . br(1) . form_input('citta', $ris['citta'], 'class="input_ko"') . br(2) .
                '<label>Provincia</label>' . br(1) . form_input('provincia', $ris['provincia'], 'class="input_ko"') . br(2) .
                '<label>Nazione</label>' . br(1) . form_input('nazione', $ris['nazione'], 'class="input_ko"') . br(2) .
                '<label>Partita Iva</label>' . br(1) . form_input('piva', $ris['piva'], 'class="input_ko"') . br(2) .
                '<label>Telefono - Phone</label>' . br(1) . form_input('telefono', $ris['telefono'], 'class="input_ko"') . br(2) .
                '<label>Sito Web - Web site</label>' . br(1) . form_input('web', $ris['web'], 'class="input_ko"') . '</td><td class="meta_tabella">
                           <label>Nome</label>' . br(1) . form_input('nome', $ris['nome'], 'class="input_ko"') . br(2) .
                '<label>Cognome</label>' . br(1) . form_input('cognome', $ris['cognome'], 'class="input_ko"') . br(2) .
                '<label>E-mail</label>' . br(1) . form_input('email', $ris['email'], 'class="input_ko"') . br(2) .
                '<label>Password</label>' . br(1) . form_password('password', '', 'class="input_ko"') . br(2) .
                '<label>Password</label>' . br(1) . form_password('password2', '', 'class="input_ko"') . br(2) . form_hidden('id', $id) . '<div class="testo_form_basso">
<p>
** Per garantire una buona comunicazione richiediamo
l’e-mail diretta della persona di riferimento.
Per garantire una buona comunicazione richiediamo
l’e-mail diretta della persona di riferimento.
*** Minino 6 caratteri 
Minino 6 caratteri .
</p>
</div>
                           </form> </tr></tbody></table></div>

<div class="accetto_form">
' . form_button('accetto', 'INVIA', 'class="background_blue"') . '
</div>
    </div>';

        return $tab;
    }

    public function inserisci_cliente($tipo, $categoria, $privacy, $rag_soc, $indirizzo, $citta, $provincia, $nazione, $piva, $telefono, $web, $nome, $cognome, $email, $password, $password2) {
        $errori = array();
        $dati_ok = array();
        $this->load->helper('email');
        //privacy
        if ($privacy != 1) {
            $errori[] = 'Privacy non accettata';
        }

        if (strlen($rag_soc) < 3) {
            $errori[] = 'Ragione sociale troppo corta';
        }

//        if (strlen($piva) < 2) {
//            $errori[] = 'Partita iva errata';
//        }

        if (strlen($nome) < 2) {
            $errori[] = 'Nome assente';
        }

        if (strlen($cognome) < 2) {
            $errori[] = 'Cognome assente';
        }

        if (!valid_email($email)) {
            $errori[] = 'Email errata';
        }


        if ($password != $password2 || strlen($password) < 6) {
            $errori[] = 'Password non conicidenti - Password mismatch';
        }





        if (count($errori) == 0) {
            $sql = "INSERT INTO anagrafica
                (tipo,
                categoria,
                rag_soc,
                indirizzo,
                citta,
                provincia,
                nazione,
                piva,
                telefono,
                web,
                nome,
                cognome,
                email,
                password,
                privacy,
                inserimento) 
                VALUES 
                (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->db->query($sql, array($tipo, $categoria, $rag_soc,
                $indirizzo, $citta, $provincia, $nazione,
                $piva, $telefono, $web,
                $nome, $cognome, $email, md5($password),
                $privacy, time()));

            $this->load->helper('string');
            $str = random_string('unique');

            $last_id = $this->db->insert_id();

            $sql = "INSERT INTO attivazioni (stringa,data,anagrafica_id) VALUES (?,?,?)";
            $this->db->query($sql, array($str, time(), $last_id));

            $message = "Click sul link sottostante per attivare la registrazione\n Click on the following link to activate your account.\n" .
                    anchor('login_clienti/attiva/' . $str, 'CLICK ME!');

            $this->load->library('email');

            $config = Array(
//    'protocol' => 'smtp',
//    'smtp_host' => 'smtps.cgr-riciclodelpet.it',
//    'smtp_port' => 465,
//    'smtp_crypto' => 'ssl',
//    'smtp_user' => 'noreply@cgr-riciclodelpet.it',
//    'smtp_pass' => '[9yw1wMA',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );

            $this->email->initialize($config);
            $this->email->from('noreply@cgr-riciclodelpet.it', 'CGR');
            $this->email->to($email);
            $this->email->subject('CGR Iscrizione online / Account activation');
            $this->email->message('<html><head></head><body>' . $message . '</body>');
            $this->email->send();


            return '0';
        } else {
            $err = "";
            foreach ($errori as $value) {
                $err .= $value . br();
                return $err;
            }
        }
    }

    public function inserisci_cliente_admin($tipo, $categoria, $rag_soc, $indirizzo, $citta, $provincia, $nazione, $piva, $telefono, $web, $nome, $cognome, $email, $password, $password2) {
        $errori = array();

        $this->load->helper('email');
        //privacy
//        if ($privacy != 1) {
//            $errori[] = 'Privacy non accettata';
//        }
        if (strlen($rag_soc) < 3) {
            $errori[] = 'Ragione sociale troppo corta';
        }

//        if (strlen($piva) < 2) {
//            $errori[] = 'Partita iva errata';
//        }

        if (strlen($nome) < 2) {
            $errori[] = 'Nome assente';
        }

        if (strlen($cognome) < 2) {
            $errori[] = 'Cognome assente';
        }

        if (!valid_email($email)) {
            $errori[] = 'Email errata';
        }


//        if ($password != $password2 || strlen($password) < 6) {
//            $errori[] = 'Password non conicidenti - Password mismatch';
//        }

        

        $this->load->helper('string');
        $password = random_string('alnum', 6);
        $chiave = random_string('alnum', 20);


        if (count($errori) == 0) {
            $sql = "INSERT INTO anagrafica
                (tipo,
                categoria,
                rag_soc,
                indirizzo,
                citta,
                provincia,
                nazione,
                piva,
                telefono,
                web,
                nome,
                cognome,
                email,
                password,
                privacy,
                inserimento,attivo,chiave) 
                VALUES 
                (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->db->query($sql, array($tipo, $categoria, $rag_soc,
                $indirizzo, $citta, $provincia, $nazione,
                $piva, $telefono, $web,
                $nome, $cognome, $email, md5($password),
                1, time(), 1, $chiave));

//invio mail in cui genero una password in automatico
            $this->load->library('email');
            $this->load->helper('email');








            $mess = '<html>
                <head>
                 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                 <link rel="stylesheet" media="screen" type="text/css" href="' . base_url() . 'css/default.css"/>
                </head><body>
                        <div id="content">

            <div id="logo_header">
            </div>
           
            <div id="intestazione" class="av_" >

            </div>

        </div>
        <br>
         <div class="contenuto">
<h1>Il tuo account sul sito C.G.R. Riciclo del PET è ora attivo. - Your C.G.R. account is now active</h1><p>La tua password per accedere è : '.$password.' - Your password is : '.$password.'</p>';

            $mess .= '<p>Clicca '.anchor('login_clienti/cambia_password/' . urlencode($chiave).'/'.urlencode($password),'QUI')
                    .' per cambiare la password ed accedere direttamente al sito.</p>'
                    . '<p>Click '.anchor('login_clienti/cambia_password/' . urlencode($chiave).'/'.urlencode($password),'HERE').' to reset your password and access the site</p></div>';

$mess .='<div id="footer">
    <p class="footer_text">C.G.R. srl • Via Casalvolone, 8 • 13010 Villata (VC) • Tel. 0161 310055 • info@cgr-riciclodelpet.it • P.IVA e C.F. 09803370155</p>
    
</div>';

            $mess .='</body></html>';
            $config = Array(
//                'protocol' => 'smtp',
//                'smtp_host' => 'smtps.cgr-riciclodelpet.it',
//                'smtp_port' => 465,
//                'smtp_crypto' => 'ssl',
//                'smtp_user' => 'noreply@cgr-riciclodelpet.it',
//                'smtp_pass' => '[9yw1wMA',
                'mailtype' => 'html',
                'charset' => 'utf-8'
            );
            if (valid_email($email)) {
                $this->email->initialize($config);
                $this->email->from('noreply@cgr-riciclodelpet.it', 'CGR-riciclo del PET');
                $this->email->to($email);
                $this->email->subject('CGR - Iscrizione al sito / Web site subscription');
                $this->email->message($mess);
                $this->email->send();
//                $this->email->clear();
            }

            return '0';
        } else {
            $err = "";
            foreach ($errori as $value) {
                $err .= $value . br();
                return $err;
            }
        }
    }

    public function modifica_cliente_admin($tipo, $categoria, $rag_soc, $indirizzo, $citta, $provincia, $nazione, $piva, $telefono, $web, $nome, $cognome, $email, $password, $password2, $id) {
        $errori = array();

        $this->load->helper('email');
        //privacy
//        if ($privacy != 1) {
//            $errori[] = 'Privacy non accettata';
//        }
        if (strlen($rag_soc) < 3) {
            $errori[] = 'Ragione sociale troppo corta';
        }

//        if (strlen($piva) < 2) {
//            $errori[] = 'Partita iva errata';
//        }

        if (strlen($nome) < 2) {
            $errori[] = 'Nome assente';
        }

        if (strlen($cognome) < 2) {
            $errori[] = 'Cognome assente';
        }

        if (!valid_email($email)) {
            $errori[] = 'Email errata';
        }


        if (strlen($password) == 0 && (strlen($password) == strlen($password2))) {
            
        } elseif (strlen($password) > 0 && strlen($password) < 6 || strlen($password) != strlen($password2)) {
            $errori[] = 'Password non conicidenti - Password mismatch';
        } else {

            $sql = "UPDATE anagrafica SET password = ? WHERE id = ?";
            $this->db->query($sql, array(md5($password), $id));
        }




        if (count($errori) == 0) {
            $sql = "UPDATE anagrafica SET
                tipo=?,
                categoria=?,
                rag_soc=?,
                indirizzo=?,
                citta=?,
                provincia=?,
                nazione=?,
                piva=?,
                telefono=?,
                web=?,
                nome=?,
                cognome=?,
                email=?
                WHERE id = ?";
            $this->db->query($sql, array($tipo, $categoria, $rag_soc,
                $indirizzo, $citta, $provincia, $nazione,
                $piva, $telefono, $web,
                $nome, $cognome, $email, $id));


            return '0';
        } else {
            $err = "";
            foreach ($errori as $value) {
                $err .= $value . br();
                return $err;
            }
        }
    }

    /**
     * restituisce l'elenco dei clienti con funzioni annesse
     */
    public function elenco_clienti($richiesta) {


        $sql = "SELECT * FROM anagrafica WHERE tipo = ? ORDER BY rag_soc, categoria";
        $ris = $this->db->query($sql, $richiesta)->result_array();

        $tab = '        <table border="0">
            <thead>
                <tr>
                    <th>CATEGORIA</th>
                
                    <th>RAGIONE SOCIALE</th>
               
                    <th>INDIRIZZO</th>
              
                    <th>CITTA\'</th>
                
                    <th>NAZIONE</th>
                
                    <th>P.IVA</th>

                    <th>TELEFONO</th>
  
                    <th>WEB</th>
   
                    <th>NOME</th>
     
                    <th>COGNOME</th>
           
                    <th>EMAIL</th>
     
                    <th>MODIFICA</th>
      
                    <th>ELIMINA</th>
                </tr>                
            </thead>
            <tbody>
                ';
        foreach ($ris as $value) {

            $tab .='
                    <tr><td>' . $value['categoria'] . '</td>
                    <td>' . $value['rag_soc'] . '</td>
                    <td>' . $value['indirizzo'] . '</td>
                    <td>' . $value['citta'] . '</td>
                    <td>' . $value['nazione'] . '</td>
                    <td>' . $value['piva'] . '</td>
                    <td>' . $value['telefono'] . '</td>
                    <td>';
            if ($value['web'] != "") {
                $tab .= anchor(prep_url($value['web']), 'sito', 'target="_blank"');
            } else {
                $tab .=' - ';
            }
            $tab .='</td>
                    <td>' . $value['nome'] . '</td>
                    <td>' . $value['cognome'] . '</td>
                    <td>' . mailto($value['email']) . '</td>
                    <td>' . anchor('admin/clienti/modifica/' . $value['id'], 'modifica') . '</td>
                    <td>' . anchor('admin/clienti/elimina/' . $value['id'], 'elimina', 'class="elimina"') . '</td></tr>';
        }
        $tab .='

</tbody>
</table>';



        return $tab;
    }

}
