
<div id="logo_header">
</div>
<div id="flags_header">
    <?php echo $flags_header; ?>
</div>
<div id="login_header">
    <?php echo $form_header; ?>
</div>
<div id="segnaposto">
    <?php
        echo anchor('welcome','<div id="sp1" class="segnaposto_class segnaposto_class_selected"><div class="testo"><p>'.$menu1.'</p></div></div>');
    ?>
    
        <?php
        echo anchor('fornitori','<div id="sp2" class="segnaposto_class "><div class="testo"><p>'.$menu2.'</p></div></div>');
    ?>
        <?php
        echo anchor('produzione','<div id="sp3" class="segnaposto_class "><div class="testo"><p>'.$menu3.'</p></div></div>');
    ?>
        <?php
        echo anchor('clienti','<div id="sp4" class="segnaposto_class "><div class="testo"><p>'.$menu4.'</p></div></div>');
    ?>
        <?php
        echo anchor('news','<div id="sp5" class="segnaposto_class "><div class="testo"><p>'.$menu5.'</p></div></div>');
    ?>
        <?php
        echo anchor('contatti','<div id="sp6" class="segnaposto_class "><div class="testo"><p>'.$menu6.'</p></div></div>');
    ?>
        <?php
        echo anchor('av','<div id="sp7" class="segnaposto_class "><div class="testo"><p>'.$menu7.'</p></div></div>');
    ?>

  

</div>






