
<div id="dialog_message"></div>
<div id="footer">
    <br>
    <br>
    <br>
    <div id="benchmark" class="centrato bordato">
    <?php
    $this->benchmark->mark('code_end');
    echo 'nome file: ' . $this->input->server('PHP_SELF') . br();
    echo 'user agent: ' . $this->input->user_agent() . br();
    echo 'tempo generazine pagina: ' . $this->benchmark->elapsed_time('code_start', 'code_end');
    ?>
    </div>
</div>
</body>
</html>