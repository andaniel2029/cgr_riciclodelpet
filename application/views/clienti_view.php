       <div id="intestazione"class="clienti_" >
                
            </div>
                
       


</div>

<div id='clienti_view' class="contenuto">
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.galleria2()(baseurl);
            generic.clienti_view(baseurl);
        })
    </script>
    
    <article>
        <h1>

            I prodotti C.G.R. sono il frutto dell’impegno<br>
            e dell’esperienza di un team affiatato<br>
            e di uno scrupoloso processo di lavorazione.
        </h1>
        <p>
            C.G.R. si rivolge alle aziende che producono in PET, PP, PS, HDPE bobine<br> per la termoformatura,
            fibra e reggia in poliestere, monofilo in poliestere<br> e compoundatori.
            Oltre a garantire la qualità dei nostri prodotti,<br> offriamo un servizio che include:
        </p>
        <ul>
            <li>
                <span class="list_color">Disponibilità continua di materia prima</span>
            </li>
            <li>
                <span class="list_color">Uniformità nel tempo delle caratteristiche dei materiali.</span>
            </li>
            <li>
                <span class="list_color">Competenza tecnica sui materiali e sui processi produttivi.</span>
            </li>

        </ul>
        <hr>
        <table>
            <tr>
                <td>
                    <div class="galleria">
                        <img src="../img/CLIENTI/reggette.png">
                        <img src="../img/CLIENTI/conf-uova.png">                       
                    </div>
                </td>
                <td>
                    <div class="galleria">
                        <img src="../img/CLIENTI/bobine.png">
                        <img src="../img/CLIENTI/vasi.png">                       
                    </div>
                </td>

                <td>        
                    <div class="galleria">
                        <img src="../img/CLIENTI/imballi.png">
                        <img src="../img/CLIENTI/tubi.png">   

                    </div>
                </td>
            </tr>
        </table>
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