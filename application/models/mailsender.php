<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mailsender
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 13-giu-2013, Diego Bellati diego@ranaridens.com
 */
class mailsender extends CI_Model {

    public function __construct() {
        parent::__construct();
                     $login = $this->session->userdata('auth');
        if ($login != 'si') {
            redirect('errors/error_404');
        }
    }

    public function invia($nome,$from, $to, $subject, $message) {
        if (!$this->input->is_ajax_request()) {
            redirect('errors/error_404');
        }

        $nome = htmlspecialchars(trim($nome));
        $from = htmlspecialchars(trim($from));
        $to = trim($to);
        $subject = htmlspecialchars(trim($subject));
        $message = htmlspecialchars(trim($message));

   
        

        $errori = array();
        if (!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/', $from)) {
            $errori[]='Email non valida!';
        }
        if (!preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/', $to)) {
            $errori[]='Destinatario errato!';
        }
        if (strlen($subject) > 100 || strlen($subject) < 2) {
            $errori[]='Oggetto superiore ai 50 caratteri o troppo corto!';
        }
        if (strlen($message) > 300 || strlen($message)<10) {
            $errori[]='Messaggio superiore ai 50 caratteri o troppo corto!';
        }
        if (strlen($nome) > 50 || strlen($nome)<3) {
            $errori[]='Nome superiore ai 50 caratteri o troppo corto!';
        }

        $this->load->library('email');

        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        if (count($errori) > 0) {
            foreach ($errori as $value) {
                echo $value . br();
            }
        } else {
          
                $this->email->from($from, $nome);
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);

                $this->email->send();
           

//                echo $this->email->print_debugger();
                echo'messaggio inviato';
           
        }
    }

}

