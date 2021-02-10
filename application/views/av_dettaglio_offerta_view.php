   <div id="intestazione"class="av_" >
                
            </div>
                
       </div>
       <div id='av_dettaglio_offerta_view' class="contenuto">
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.av_dettaglio_offerta_view(baseurl);
        })
    </script>
    <div id="col_sx">
        <div class="dett_foto_bg" id="dett_foto1"><?php echo @$foto1;?></div>
        <div class="dett_foto_bg" id="dett_foto2"><?php echo @$foto2;?></div>
        <div class="dett_foto_bg" id="dett_foto3"><?php echo @$foto3;?></div>
        <div class="dett_foto_bg" id="dett_foto4"><?php echo @$foto4;?></div>
        <div class="dett_foto_bg" id="dett_foto5"><?php echo @$foto5;?></div>
        <div  id="grande_foto"><?php echo @$foto_grande;?></div>
        <div id="altre_info">
            
            <?php
            echo @$altre_info;
            ?>
            
        </div>
    </div>
    <div id="col_dx">
        <div id="dettaglio_offerta_prodotto">
            <?php echo @$dettaglio_offerta;?>
        </div>
        <div id="altro_dettaglio">
            <div id="__sx___">
                <?php echo @$sx;?>
            </div>
            <div id="__dx___">
                <?php echo @$dx;?>
            </div>
            <br class="clear_box">
        </div>
        <div id="dettaglio_form_info_sul_prodotto">
            <?php echo $form_richiesta;?>
            
        </div>
    </div>
    <br class="clear_box">
    


</div>