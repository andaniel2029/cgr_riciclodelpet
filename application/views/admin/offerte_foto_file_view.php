
<div id='offerte_foto_file_view'>
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.offerte_foto_file_view(baseurl);
        })
    </script>
            <h1>ATTENZIONE COMPLETARE LA PROCEDURA CON IL TASTO CHIUDI. NON TORNARE ALLA PAGINA PRECEDENTE PER NON CREARE UN'OFFERTA INCOMPLETA<BR>
        IN CASO DI ERRORI È POSSIBILE MODIFICARLA SUCCESSIVAMENTE</h1>
    <fieldset>
        <legend>FOTO</legend>
        <?php
        echo $foto;
        ?>
        <?php echo form_open_multipart('admin/offerte/upload_cliente_foto'); ?>

        <input type="file" name="userfile" size="20" />
        <input type="hidden" name="precedente" value="<?php echo current_url(); ?>">
        <input type="hidden" name="id_offerta" value="<?php echo $this->uri->segment(4); ?>">
        <br /><br />

        <input type="submit" value="upload" />

        </form>
    </fieldset>
    <fieldset>
        <legend>
            FILE
        </legend>
        <?php
        echo $file;
        ?>
        <br><br>
                <?php echo form_open_multipart('admin/offerte/upload_cliente_file'); ?>

        <input type="file" name="userfile" size="20" />
        <input type="hidden" name="precedente" value="<?php echo current_url(); ?>">
        <br>
        
        <label>Nome da visualizzare: </label><input type="input" name="nome" value="">
        <input type="hidden" name="id_offerta" value="<?php echo $this->uri->segment(4); ?>">
        <br /><br />

        <input type="submit" value="upload" />

        </form>
    </fieldset>    
    <fieldset>
        <legend>
            Invia una mail agli interessati relativa alla creazione di questa nuova offerta oppure relativa alla modifica
        </legend>
        <button id="invio_mail_offerta">INVIA MAIL</button>
    </fieldset>
        <button id="chiudi_pagina_offerta">CHIUDI</button>
</div>