
<div id="intestazione" class="av_" >

</div>

</div>
<div id='av_logged_fornitore_view' class="contenuto">
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.av_logged_fornitore_view(baseurl);
        });
    </script>
    <p class="color_blue">Invia la tua offerta - Submit your offer to C.G.R.</p>
    <hr>
    <p class="color_blue">Offerte già inviate - Offers already sent<br></p>
    <?php
    echo $get_inserzioni;
    ?>

    <hr>



    <div id="foto_up_content"> 



        <p class="color_blue">Carica foto - carica foto max 5</p>

        <br>

        <?php echo form_open_multipart('upload_foto/do_upload', 'id=form_upl_foto'); ?>

        <input type="file" name="userfile" />

        <br /><br />

        <input id="sbm_btn" class="background_blue" type="submit" value="CARICA - UPLOAD" />

        </form>


        <?php
        echo $errori;
        ?>






        <div id="foto_up_content_div_dx">

            <div id="foto_box1"> <div class="div_in_tab"><?php echo img('uploads_foto/' . $get_foto['foto1']); ?></div><div class="div_in_tab_chkbox"> <?php echo form_checkbox('canc_foto', $get_foto['foto1']); ?></div></div>
            <div id="foto_box2"> <div class="div_in_tab"><?php echo img('uploads_foto/' . $get_foto['foto2']); ?></div><div class="div_in_tab_chkbox"> <?php echo form_checkbox('canc_foto', $get_foto['foto2']); ?></div></div>
            <div id="foto_box3"> <div class="div_in_tab"><?php echo img('uploads_foto/' . $get_foto['foto3']); ?></div><div class="div_in_tab_chkbox"> <?php echo form_checkbox('canc_foto', $get_foto['foto3']); ?></div></div>
            <div id="foto_box4"> <div class="div_in_tab"><?php echo img('uploads_foto/' . $get_foto['foto4']); ?></div><div class="div_in_tab_chkbox"> <?php echo form_checkbox('canc_foto', $get_foto['foto4']); ?></div></div>
            <div id="foto_box5"> <div class="div_in_tab"><?php echo img('uploads_foto/' . $get_foto['foto5']); ?></div><div class="div_in_tab_chkbox"> <?php echo form_checkbox('canc_foto', $get_foto['foto5']); ?></div></div>






            <button id="rimuovi_img_button" class="background_blue">RIMUOVI - REMOVE</button>

        </div>


    </div>



    <div id="av_form_file_upl_cont">

        <div id="form_up_content">

            <?php
            echo $get_form;
            ?>
            <p class="color_blue">Carica foto - Upload photo (max 5)</p>




        </div>

        <div id="file_up_content">
            
            <p class="color_blue">Carica altri files / Upload other files (pdf, doc, xls. etc) </p>
            <div id="solo_inp">
            <input name="file_1" readonly="readonly" value="<?php echo $get_file['file1'];?>"/><input type="checkbox" name="chk1" value="<?php echo $get_file['file1'];?>"/><br><br>
            <input name="file_1" readonly="readonly" value="<?php echo $get_file['file2'];?>"/><input type="checkbox" name="chk2" value="<?php echo $get_file['file2'];?>"/><br><br>
            <input name="file_1" readonly="readonly" value="<?php echo $get_file['file3'];?>"/><input type="checkbox" name="chk3" value="<?php echo $get_file['file3'];?>"/><br><br>
            <input name="file_1" readonly="readonly" value="<?php echo $get_file['file4'];?>"/><input type="checkbox" name="chk4" value="<?php echo $get_file['file4'];?>"/><br><br>
            <input name="file_1" readonly="readonly" value="<?php echo $get_file['file5'];?>"/><input type="checkbox" name="chk5" value="<?php echo $get_file['file5'];?>"/><br><br>
            </div>
                        <br>

            <?php echo form_open_multipart('upload_file/do_upload', 'id=form_upl_file'); ?>

            <input type="file" name="userfile"  />

            <br /><br />

            <input id="sbm_btn_file" class="background_blue" type="submit" value="CARICA - UPLOAD" />

            </form>

   <button id="rimuovi_file_button" class="background_blue">RIMUOVI - REMOVE</button>
            <?php
            echo $errori;
            ?>
        </div>
        <button class="background_blue" id="submit_form_fornitore">SALVA - SAVE</button>
    </div>
</div>
