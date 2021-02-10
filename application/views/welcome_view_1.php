<div id="intestazione"class="welcome_eng" >

</div>
</div>
<script>
    $(document).ready(function() {
        generic.generic(baseurl);
        generic.galleria();

    });
</script>

<div id="welcome_view" class="contenuto">
    <article>
       
        <p>Since 2009 we have been been grinding and pelletising PET, HDPE, PP and PS derived from
various types of processed waste. In a few short years,<br> we have built a strong
reputation and confidence through our relationships<br> with companies both in Italy
and abroad.</p>
        <h1>
            
            Our motto is <strong>quality</strong> and <strong>respect</strong>.
        </h1>
        <p>
            <strong>Respect</strong> for our customers and suppliers, which for us translates into competence,
continuous upgrading as well as offering <strong>quality</strong><br> products at competitive prices.<br>
<strong>Respect</strong> for the environment, as our core business is committed<br> to the recycling
and repurposing of industrial waste<br> which can then be reintroduced into the
production cycle.<br>
Our goal is to heighten all the benefits that this process can bring in terms<br> of reduced pollution 
and resource optimisation whilst at the same time<br> never compromising on <strong>quality</strong>.<br>
        </p>
        <div id="gall_cont_welcome">
            <div id="gall_1_home" class="galleria">
                <?php
                echo img('img/HOME/fotohome1.png');
                echo img('img/HOME/fotohome2.png');
                ?>


            </div>
            
            <div id="gall_2_home" class="galleria">
                <?php
                echo img('img/HOME/fotohome3.png');
                echo img('img/HOME/fotohome4.png');
                ?>
            </div>
            
        </div>
    </article>
        <div id="dx_">
            <?php            
        echo anchor('av/visualizza',img('img/offrici-materiali-ING.png'));
    ?>
            <div style="background-image: url('../../img/materiali-offerta-ING.png')" id="dx_interno">
                <div id='__top_offerta'>
                    
                </div>
                <div id='__bottom_offerta'>
                    
                </div>
            </div>
        </div>
    <br class="clear_box">    
    <?php
//    echo $home_content;
//       echo md5('rrrrrr');
    ?>
</div>
