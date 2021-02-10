
         <div id="intestazione"class="produzione_" >
                
            </div>
                
       
</div>
<div id='produzione_view' class="contenuto">
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.galleria2();
            generic.produzione_view(baseurl);
        })
    </script>

    <article>

        <p>Gli scarti di lavorazione di diversi tipi e misure provenienti dai nostri fornitori<br>
            sono trattati nello stabilimento di Villata, in provincia di Vercelli,<br>
            che si estende su 11 000 mq, di cui 4500 coperti.</p>

        <ul>
            <li>
                <span class="list_color">Un sistema di separazione per selezione ottica e/o per peso specifico opera la selezione<br>
                    della materia prima.</span>
            </li>
            <li>
                <span class="list_color">Presse, trituratori e mulini effettuano la riduzione volumetrica degli scarti,<br>
                    che poi vengono estrusi
                    in granuli o utilizzati direttamente per la produzione<br> di nuovi manufatti in plastica.</span>
            </li>
            <li>
                <span class="list_color">Metal detector, silos miscelatori, estrusori ed attrezzature da laboratorio sono utlizzati<br>
                    per effettuare il controllo della qualità del prodotto.</span>
            </li>

        </ul>
        <hr>
        <h1>

            Si ottengono materiali macinati e/o granulati idonei per la lavorazione<br>
            tramite estrusione, stampaggio di articoli destinati al settore<br> dell’imballaggio
            e dell’edilizia.
        </h1>
        <div id="ennesimo_cont_prod">
                    <div id="gal_1_prod" class="galleria">
                        <img src="../img/PRODUZIONE/foto2-sx.png" data-layer=" <span>Preforme PET di scarto</span>" >
                        <img src="../img/PRODUZIONE/foto1-sx.png" data-layer=" <span>Scheletri di termoformatura imballati</span>" >
                        <img src="../img/PRODUZIONE/foto3-sx.png" data-layer=" <span>Bottiglie PET pre-consumo (da fonte)<br>imballate</span>">
                    </div>
               
                <img id="img_1_prod" src="../img/PRODUZIONE/freccia-grigia.png" >
               <img id="rotazione" src="../img/PRODUZIONE/rotella.png">
               <img id="img_2_prod" src="../img/PRODUZIONE/freccia-grigia.png">
                <div id="gal_2_prod" class="galleria">
                        <img src="../img/PRODUZIONE/foto1-dx.png" data-layer=" <span>Macinato di PET floreale</span>">
                        <img src="../img/PRODUZIONE/foto3-dx.png" data-layer=" <span>Macinato di PET da termoformatura</span>">
                        <img src="../img/PRODUZIONE/foto2-dx.png" data-layer=" <span>Scaglia PET preconsumo</span>">

                    </div>
               <div id="loghetto_prod">
                               <?php
        echo img('img/PRODUZIONE/logosottorotella.png');

    ?>
               </div>

        </div>

    </article>
 
        <div id="dx_">
            <?php            
        echo anchor('av/visualizza',img('img/offrici-materiali.png'));
    ?>
            <div style="background-image: url('../img/materiali-offerta.png')" id="dx_interno">
                <div id='__top_offerta'>
                    
                </div>
                <div id='__bottom_offerta'>
                    
                </div>
            </div>
        </div>
    <br class="clear_box">    
    <?php
//    echo $home_content;
    ?>
</div>