
            <div id="intestazione"class="av_" >
                
            </div>
                
       </div>

<div id='av_view' class="contenuto">
    <script>
        $(document).ready(function() {
            generic.generic(baseurl);
            generic.av_view(baseurl);
        })
    </script>

    <div id="av_login">
        
        E-Mail: <input type="text" name="username" size="15"/> Password: <input type="text" size="15" name="username"/> <?php echo img('img/VARIE/freccina-rossa.png');?>
    </div>

    <div id="av_login_testo">
                <p>C.G.R. Store</p>

        
        <p>
            Per accedere 
            alla tua area riservata
            devi effettuare il login.
        </p>
        <br>
                <p>
            To access the reserved area, please login
        </p>
    </div>
    <div id="hr_av_cont">
        <hr>
    </div>

        <div id="av_registra_testo">
            Se non sei ancora registrato compila il form cliccando su REGISTRA.<br>
If you haven’t yet registered, complete the registration form by clicking on
REGISTER.
        </div>
        <div id="av_registra_pulsante">
            <?php echo anchor('av/registra','REGISTRA - REGISTER');?>
        </div>
 
</div>