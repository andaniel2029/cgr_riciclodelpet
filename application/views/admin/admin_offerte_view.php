
<div id='admin_offerte_view' >
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.admin_offerte_view(baseurl);
        })
    </script>
    <div id="elenco_offerte_fornitori">
        <p>ELENCO OFFERTE PRESENTI INSERITE DA FORNITORI DALLE QUALI CREARE L'OFFERTA PER I CLIENTI</p>
        <?php
 
echo $get_offerte_fornitori;

?>
    </div>
    <div id="get_offerte_per_clienti">
        <p>SELEZIONARE UN'OFFERA DA FORNITORE PER POI MODIFICARLA E RENDERLA VISIBILE PER IL CLIENTE COMPILANDO I SEGUENTI CAMPI</p>
      
        <?php
 
echo $get_offerte_per_clienti;

?>
    </div>
</div>