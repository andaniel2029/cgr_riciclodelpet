
<div id='upload_success'>
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.upload_success(baseurl);
        })
    </script>

<h3>Il file è stato caricato con successo!</h3>

<br>
<fieldset>
    <legend>Dettaglio del file:</legend>
<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>
</fieldset>

<p><?php echo anchor('admin/upload/carica/', 'Carica un altra immagine').  nbs(5).anchor('admin/news','Vai alle news'); ?></p>
</div>