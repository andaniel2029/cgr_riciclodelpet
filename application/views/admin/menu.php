<div id="menu" class="centrato contenuto centrato">

    <br><p class="centrato"><?php echo anchor('admin/login/logout', 'ESCI DAL PANNELLO DI AMMINISTRAZIONE'); ?></p>
    <br><br>
    <ul>
        <li>
            <?php echo anchor('admin/pannello', 'home'); ?>
        </li>

<!--        <li>
            <?php
//            echo anchor('admin/statiche', 'Tutte le pagine statiche(contenuti)');
            ?>

        </li>-->
                <li>
            <?php
            echo anchor('admin/clienti/aggiungi_cliente', 'Inserisci un cliente/fornitore');
            ?>

        </li>
        
        <li>
            <?php
            echo anchor('admin/clienti', 'Gestione clienti');
            ?>

        </li>
        <li>
            <?php
            echo anchor('admin/fornitori', 'gestione fornitori');
            ?>

        </li>
        <li>
            <?php
            echo anchor('admin/offerte', 'gestione offerte');
            ?>

        </li>

        <li>
            <?php
            echo anchor('admin/news', 'News');
            ?>

        </li>
        <li>
            <?php
            echo anchor('av/visualizza', 'Inserisci offerta base (apre una nuova finestra come quella di front-end','target="_blank"');
            ?>

        </li>
        <li>
            <?php
            echo anchor('admin/offerte/offerte_pubblicate', 'Offerte_pubblicate');
            ?>

        </li>

    </ul>
    <br>
</div>
<hr>