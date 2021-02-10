
               <div id="intestazione"class="news_" >
                
            </div>
</div>
<div id='news_view' class="contenuto">
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.news_view(baseurl);
        })
    </script>

    <?php
    echo $news;
    ?>
</div>