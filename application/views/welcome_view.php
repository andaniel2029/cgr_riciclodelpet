<div id="intestazione"class="welcome_" >

</div>
</div>
<script>
    $(document).ready(function() {
        generic.generic(baseurl);
        generic.galleria();

    });
</script>

<div id="welcome_view" class="contenuto">
    <article>
        <p>Dal 2009 produciamo macinati e granuli di PET, HDPE, PP e PS<br>
            ricavati da svariate tipologie di scarti di lavorazione. In pochi anni<br>
            abbiamo ottenuto la fiducia di molte aziende sia in Italia sia all’Estero.</p>
        <h1>

            Le nostre parole d'ordine sono <strong>rispetto</strong> e <strong>qualità</strong>.
        </h1>
        <p>
            <strong>Rispetto</strong> per i clienti e i fornitori, che per noi significa competenza,<br>
            aggiornamento costante, prodotti di <strong>qualità</strong> a prezzi competitivi.<br>
            <strong>Rispetto</strong> per l'ambiente, perché l'essenza della nostra attività<br>
            consiste nel recupero di scarti di lavorazione che in questo modo<br>
            rientrano nel ciclo produttivo.<br>
            Con tutti i vantaggi che ne derivano in termini di minor inquinamento<br>
            e di risparmio di risorse, senza andare a scapito della <strong>qualità</strong>.<br>
        </p>
        <div id="gall_cont_welcome">
            <div id="gall_1_home" class="galleria">
                <?php
                echo img('img/HOME/fotohome1.png');
                echo img('img/HOME/fotohome2.png');
                ?>


            </div>
            
            <div id="gall_2_home" class="galleria">
                <?php
                echo img('img/HOME/fotohome3.png');
                echo img('img/HOME/fotohome4.png');
                ?>
            </div>
            
        </div>
    </article>
    <div id="dx_">
        <?php
        echo anchor('av/visualizza', img('img/offrici-materiali.png'));
        ?>
        <div style="background-image: url('../../img/materiali-offerta.png')" id="dx_interno">
            <div id='__top_offerta'>

            </div>
            <div id='__bottom_offerta'>

            </div>
        </div>
    </div>
    <br class="clear_box">    
    <?php
//    echo $home_content;
//       echo md5('rrrrrr');
    ?>
</div>
