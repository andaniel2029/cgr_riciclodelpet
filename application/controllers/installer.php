<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Crea le tabelle di tutto il sito se queste non esistono già
 * per modificarle, eseguire la modifica direttamente sul phpmyadmin
 * e riportarla in questa pagina
 *
 * @author Diego Bellati diego@ranaridens.com
 * @copyright (c) 4-apr-2013, Diego Bellati diego@ranaridens.com
 */
class installer extends CI_Controller {

    
    
    public function index() {
        //Creo la tabella che contiene i dati di accesso dei clienti.

           
        $query = "CREATE TABLE IF NOT EXISTS inserzione (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,  
        
        nome VARCHAR(100),
        polimero VARCHAR(100),
        quantita VARCHAR(100) ,        
        prezzo FLOAT(8,2) DEFAULT 0.00,
        descrizione MEDIUMBLOB,        
        inserimento timestamp,
        scadenza INTEGER DEFAULT 0,
        PRIMARY KEY (id))
        ENGINE InnoDB";
           $this->db->query($query);

           //sono le foto che vengono inserite nelle offere per i clienti. in principio prendo quelle dell' offerta ma poi sono modificabili
           $query = "CREATE TABLE IF NOT EXISTS foto_offerte_clienti(
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,          
        offerta_id VARCHAR(100),
        foto VARCHAR(100),
        thumb VARCHAR(100),
        PRIMARY KEY (id))
        ENGINE InnoDB";
           $this->db->query($query);
           //sono i files che vengono inserite nelle offere per i clienti. in principio prendo quelle dell' offerta ma poi sono modificabili
           $query = "CREATE TABLE IF NOT EXISTS file_offerte_clienti(
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,          
        offerta_id VARCHAR(100),
        url VARCHAR(100),
        PRIMARY KEY (id))
        ENGINE InnoDB";
           $this->db->query($query);
           
        $query = "CREATE TABLE IF NOT EXISTS files (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        url VARCHAR(100),
        thumb VARCHAR(100),
        inserzione_id INTEGER UNSIGNED,
        anagrafica_id INTEGER UNSIGNED,
        PRIMARY KEY (id))
        ENGINE InnoDB";
           $this->db->query($query);
           
        $query = "CREATE TABLE IF NOT EXISTS foto (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        url VARCHAR(100),
        thumb VARCHAR(100),
        inserzione_id INTEGER UNSIGNED,
        anagrafica_id INTEGER UNSIGNED,
        PRIMARY KEY (id))
        ENGINE InnoDB";
           $this->db->query($query);
        $query = "CREATE TABLE IF NOT EXISTS file_offerta (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        url VARCHAR(100),
        thumb VARCHAR(100),
        inserzione_id INTEGER UNSIGNED,
        anagrafica_id INTEGER UNSIGNED,
        PRIMARY KEY (id))
        ENGINE InnoDB";
           $this->db->query($query);
           
        $query = "CREATE TABLE IF NOT EXISTS foto_upload_temp (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        url VARCHAR(100),
        thumb VARCHAR(100),
        sessione_email VARCHAR(100),

        PRIMARY KEY (id))
        ENGINE InnoDB";
           $this->db->query($query);
        $query = "CREATE TABLE IF NOT EXISTS file_upload_temp (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        url VARCHAR(100),

        sessione_email VARCHAR(100),

        PRIMARY KEY (id))
        ENGINE InnoDB";
           $this->db->query($query);

           
           $query = "CREATE TABLE IF NOT EXISTS news (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        titolo VARCHAR(100),
        descrizione MEDIUMBLOB,
        attivo SMALLINT DEFAULT 1,        
        inserimento INTEGER UNSIGNED,
        timestamp TIMESTAMP,
        PRIMARY KEY (id))
        ENGINE InnoDB";
           $this->db->query($query);
 
        $query = "CREATE TABLE IF NOT EXISTS attivazioni (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        stringa VARCHAR(100),
        anagrafica_id INTEGER UNSIGNED,
        data INT UNSIGNED,
        PRIMARY KEY (id))
        ENGINE InnoDB";

        $this->db->query($query);
        $query = "CREATE TABLE IF NOT EXISTS anagrafica(
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        attivo INT DEFAULT 0,
        hash VARCHAR(100),
        tipo VARCHAR(10),
        categoria VARCHAR(15),
        rag_soc VARCHAR(100),
        indirizzo VARCHAR(100),
        citta VARCHAR(100),
        nazione VARCHAR(100),
        provincia VARCHAR(100),
        piva VARCHAR(100),
        telefono VARCHAR(100),
        web VARCHAR(100),
        nome VARCHAR(100),
        cognome VARCHAR(100),
        email VARCHAR(100),
        password VARCHAR(500),        
        privacy tinyint DEFAULT 0,
        timestamp TIMESTAMP,
        inserimento INTEGER UNSIGNED,
        PRIMARY KEY (id))
        ENGINE InnoDB";

        $this->db->query($query);

        $query = "CREATE TABLE IF NOT EXISTS gallery (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        url VARCHAR(500),
        thumb VARCHAR(500),
        timestamp TIMESTAMP,
        PRIMARY KEY (id))
        ENGINE InnoDB";
//offerte caricate da fornitore e da modificare per poi salvarle in offerte per cliente
        $this->db->query($query);
        $query = "CREATE TABLE IF NOT EXISTS offerte (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        nome VARCHAR(100),
        polimero VARCHAR(100),
        quantita VARCHAR(100),
        prezzo VARCHAR(100),
        descrizione MEDIUMBLOB,
        utente_email VARCHAR(500),
        utente_id INTEGER UNSIGNED,
        timestamp TIMESTAMP,
        inserimento INTEGER UNSIGNED,      
         PRIMARY KEY (id))
        ENGINE InnoDB";

        $this->db->query($query);
        //offerte per i clienti
        $query = "CREATE TABLE IF NOT EXISTS offerte_per_cliente (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        nome VARCHAR(100),        
        polimero VARCHAR(100),
        quantita VARCHAR(100),
        prezzo VARCHAR(100),
        resa VARCHAR(100),
        imballo VARCHAR(100),
        peso VARCHAR(100),
        mezzo VARCHAR(100),
        cer VARCHAR(100),   
        rifiuto VARCHAR(3),
        descrizione MEDIUMBLOB,       
        codice INTEGER UNSIGNED ZEROFILL,
        scadenza INTEGER UNSIGNED,   
        id_offerta_originale INTEGER UNSIGNED,
        attivo TINIYNT UNSIGNED,
        timestamp TIMESTAMP,
        inserimento INTEGER UNSIGNED,      
         PRIMARY KEY (id))
        ENGINE InnoDB";

        $this->db->query($query);
        
        //relazione tra clienti e offerte
        $query = "CREATE TABLE IF NOT EXISTS off_cli (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        cliente_id INTEGER UNSIGNED,
        offerte_per_cliente_id INTEGER UNSIGNED,
         PRIMARY KEY (id))
        ENGINE InnoDB";

        $this->db->query($query);

  


        $query = "CREATE TABLE IF NOT EXISTS statiche (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,   
        home MEDIUMBLOB,
        clienti MEDIUMBLOB,
        fornitori MEDIUMBLOB,
        produzione MEDIUMBLOB,
        contatti MEDIUMBLOB,
        
        home_en MEDIUMBLOB,
        clienti_en MEDIUMBLOB,
        fornitori_en MEDIUMBLOB,
        produzione_en MEDIUMBLOB,
        contatti_en MEDIUMBLOB,


        PRIMARY KEY (id))
        ENGINE InnoDB";

        $this->db->query($query);


        $query = "INSERT INTO statiche
            (
            home,   
home_en      ,
clienti   ,
clienti_en   ,
fornitori ,
fornitori_en ,
produzione,
produzione_en,
contatti  ,
contatti_en )
VALUES
(1,2,3,4,5,6,7,8,9,10)";

        $this->db->query($query);
    }

}
