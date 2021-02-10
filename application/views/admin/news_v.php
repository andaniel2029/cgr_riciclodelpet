
<div id='news_v' class="contenuto centrato">
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.news_v(baseurl);
            generic.editor();
            CKEDITOR.replace('contenuto', {
     
            });

        })
    </script>
    <?php
    
    
    echo $anteprime.br();
    echo $form_inserimento;
    echo $all_news;
    
    ?>
</div>