
var baseurl = 'http://www.cgr-riciclodelpet.it/';
//var baseurl = 'http://localhost/cgr/index.php/';
//var baseurl = 'http://192.168.1.2/cgr/index.php/';
//var baseurl = 'http://cgr.retelocale.com/index.php/';


var generic = {
    generic: function(baseurl) {

        $('#password_recovery').on("click", function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: baseurl + "welcome/lost_password_form",
                dataType: "html",
                cache: false,
                success: function(data) {

                    $('#dialog_message').html(data);
                    $('#dialog_message').dialog(
                            {
                                title: "Password recovery form",
                                modal: true
                            });



                }
            });

        });

        $(document).on("click", "button[name=lost_btn]", function() {
            var email_lost = $('input[name=email_lost]').val();
//            alert(email_lost);return false;
            $('#dialog_message').dialog('close');
            $.ajax({
                type: "post",
                url: baseurl + "welcome/update_lost_pswd",
                dataType: "html",
                cache: false,
                data: {
                    email_lost: email_lost
                },
                success: function(data) {

                    $('#dialog_message').html(data);
                    $('#dialog_message').dialog(
                            {
                                title: "Password recovery form",
                                modal: true
                            });



                }
            });
        });


        //carico le due offerte con il link
        var items = new Array;

        $.ajax({
            type: "post",
            dataType: "json",
            url: baseurl + "welcome/generatore_offerte",
            async: false,
            data: {
            },
            success: function(data) {

                $.each(data, function(k, val) {
                    items[k] = [val];
                });



            }
        });

        var lungh = items.length;

        var num = 0;
        $('#__top_offerta').html(items[num]);
        $('#__bottom_offerta').html(items[num + 1]);


        window.setInterval(function() {

            $('#__top_offerta').fadeOut("slow", function() {
                $('#__top_offerta').html(items[num]);
                $(this).fadeIn();
            });
            $('#__bottom_offerta').fadeOut("slow", function() {
                $('#__bottom_offerta').html(items[num + 1]);
                $(this).fadeIn();
            });
            if (num === 4)//sempre pari
            {
                num = 0;
            }
            else
            {
                num = num + 2;
            }
        }, 5000);


        $('#accedi_top').on("click", function(event) {
            event.preventDefault();
            var username = $('#login_header input[name=email]').val();
            var password = $('#login_header input[name=pswd]').val();

            $.ajax({
                type: "post",
                url: baseurl + "login_clienti/login",
                dataType: "html",
                cache: false,
                beforeSend: function() {

                },
                data: {
                    password: password,
                    username: username
                },
                success: function(data) {

                    if (data == 1)
                    {
                        location.href = baseurl;
                    }
                    else
                    {
                        $('#dialog_message').html('Login error');
                        $('#dialog_message').dialog(
                                {
                                    title: "ERRORE! - ERROR!",
                                    modal: true,
                                });

                    }

                }
            });


        })


//        CKEDITOR.replace('editor');
//        CKEDITOR.config.toolbar = [
//    [ 'Preview', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
//    '/',
//    [ 'Bold', 'Italic','Image' ]
//];
    },
    welcome_view: function(baseurl) {

    },
    ricerca_view: function(baseurl) {

    },
    av_logged_cliente_view: function(baseurl) {

    },
    cambia_password_view: function(baseurl) {
        $('button[name=sbm_chpswd]').on("click", function() {
            var old = $('input[name=old_password]').val();
            var new_pass = $('input[name=new_password]').val();
            var new_pass2 = $('input[name=new_password_2]').val();

            $.ajax({
                type: "post",
                url: baseurl + "login_clienti/ricevi_cambia_password",
                dataType: "html",
                cache: false,
                beforeSend: function() {

                },
                data: {
                    old: old,
                    new_pass: new_pass,
                    new_pass2: new_pass2
                },
                success: function(data) {
                    if (data === '1')
                    {
                        $('#dialog_message').html("Password cambiata - Password changed")
                        $('#dialog_message').dialog(
                                {
                                    title: "OK!",
                                    modal: true,
                                    close: function() {
                                        window.location = baseurl + "/";
                                    }
                                }
                        );
                    }
                    else
                    {
                        $('#dialog_message').html(data);

                        $('#dialog_message').dialog(
                                {
                                    title: "Errore!",
                                    modal: true,
                                    close: function() {

                                    }
                                }
                        );
                    }

                }
            });


            if (new_pass !== new_pass2)
            {
                $('#dialog_message').html('Password non coincidenti – Password doesn’t match');
                $('#dialog_message').dialog({
                    modal: true
                });
            }





        });
    },
    av_logged_fornitore_view: function(baseurl) {

        function in_sessione() {
            var nome = $('input[name=nome]').val();
            var polimero = $('input[name=polimero]').val();
            var quantita = $('input[name=quantita]').val();
            var prezzo = $('input[name=prezzo]').val();
            var descrizione = $('input[name=descrizione]').val();

            $.ajax({
                type: "post",
                url: baseurl + "av/temporaneo",
                dataType: "html",
                cache: false,
                data: {
                    nome: nome,
                    polimero: polimero,
                    quantita: quantita,
                    prezzo: prezzo,
                    descrizione: descrizione
                },
                success: function(data) {

                    $('#form_upl_foto').submit();
                }
            });

        }


        $('#submit_form_fornitore').on("click", function() {
            var nome = $('input[name=nome]').val();
            var polimero = $('input[name=polimero]').val();
            var quantita = $('input[name=quantita]').val();
            var prezzo = $('input[name=prezzo]').val();
            var descrizione = $('textarea[name=descrizione]').val();
            $.ajax({
                type: "post",
                url: baseurl + "av/salva_offerta",
                dataType: "html",
                cache: false,
                beforeSend: function() {

                },
                data: {
                    nome: nome,
                    polimero: polimero,
                    quantita: quantita,
                    prezzo: prezzo,
                    descrizione: descrizione
                },
                success: function(data) {
                    if(data==1)
                        {
                    $('#dialog_message').html('Inserimento effettuato con successo <br> Success!');
                        }
                        else
                            {
                                $('#dialog_message').html('Error! please contact webmaster');
                            }
                    $('#dialog_message').dialog(
                        {
                                    title: "OK!",
                                    modal: true,
                                    close: function() {
                                        window.location = baseurl + "av/visualizza";
                                    }
                                })
                }
            
            });


        })



        $('button[name=carica]').on("click", function() {
            alert('df');
        });

        $('#rimuovi_img_button').on("click", function() {

            var foto = $('#foto_up_content input[name=canc_foto]:checked').serialize();

//            in_sessione();

            $.ajax({
                type: "post",
                url: baseurl + "av/elimina_foto_temp",
                cache: false,
                beforeSend: function() {

                },
                data: {
                    foto: foto
                },
                success: function(data) {

                    $('#foto_up_content input[name=canc_foto]:checked').removeAttr('checked');
                    window.location.reload();

                }
            });



        });
        $('#rimuovi_file_button').on("click", function() {
            var file = $('#file_up_content input[type=checkbox]:checked').serialize();

//alert(file);
//return false;
//        

//            in_sessione();

            $.ajax({
                type: "post",
                url: baseurl + "av/elimina_file_temp",
                cache: false,
                beforeSend: function() {

                },
                data: {
                    file: file
                },
                success: function(data) {
                    $('#file_up_content input[type=checkbox]:checked').removeAttr('checked');
                    window.location.reload();

                }
            });



        });




        $('#sbm_btn').on("click", function(e) {
            e.preventDefault();
            var nome = $('input[name=nome]').val();
            var polimero = $('input[name=polimero]').val();
            var quantita = $('input[name=quantita]').val();
            var prezzo = $('input[name=prezzo]').val();
            var descrizione = $('input[name=descrizione]').val();

            $.ajax({
                type: "post",
                url: baseurl + "av/temporaneo",
                dataType: "html",
                cache: false,
                beforeSend: function() {

                },
                data: {
                    nome: nome,
                    polimero: polimero,
                    quantita: quantita,
                    prezzo: prezzo,
                    descrizione: descrizione
                },
                success: function(data) {

                    $('#form_upl_foto').submit();
                }
            });


        });


        $('#sbm_btn_file').on("click", function(e) {
            e.preventDefault();
            var nome = $('input[name=nome]').val();
            var polimero = $('input[name=polimero]').val();
            var quantita = $('input[name=quantita]').val();
            var prezzo = $('input[name=prezzo]').val();
            var descrizione = $('input[name=descrizione]').val();

            $.ajax({
                type: "post",
                url: baseurl + "av/temporaneo",
                dataType: "html",
                cache: false,
                beforeSend: function() {

                },
                data: {
                    nome: nome,
                    polimero: polimero,
                    quantita: quantita,
                    prezzo: prezzo,
                    descrizione: descrizione
                },
                success: function(data) {

                    $('#form_upl_file').submit();
                }
            });


        });






//        $('#form_uploader').hide();
//        $('button[name=btn_f]').on("click", function()
//        {
//            $('#form_uploader').dialog();
//
//
//        })
        $('#bt').on("click", function(e) {
            e.preventDefault();

            var userfile = $('input[name=userfile]').val();

//                return false;
            $.ajax({
                type: "post",
                url: baseurl + "foto_uploader/do_upload",
                dataType: "html",
                cache: false,
                beforeSend: function() {

                },
                data: {
                },
                success: function(data) {


                }
            });
        });
    },
    produzione_view: function(baseurl) {

        var rotation = function() {
            $("#rotazione").rotate({
                angle: 0,
                duration: 5000,
                animateTo: -360,
                callback: rotation,
                easing: function(x, t, b, c, d) {        // t: current time, b: begInnIng value, c: change In value, d: duration
                    return c * (t / d) + b;
                }
            });
        };
        rotation();
    },
    news_view: function(baseurl) {

    },
    fornitori_view: function(baseurl) {

    },
    registra_view: function(baseurl) {

        $('button[name=accetto]').on("click", function() {

            var tipo = $('input[name=tipo]:checked').val();
            var categoria = $('input[name=categoria]:checked').val();
            var privacy = $('input[name=accetto_pr]:checked').val();
            var rag_soc = $('input[name=rag_soc]').val();
            var indirizzo = $('input[name=indirizzo]').val();
            var citta = $('input[name=citta]').val();
            var provincia = $('input[name=provincia]').val();
            var nazione = $('input[name=nazione]').val();
            var piva = $('input[name=piva]').val();
            var telefono = $('input[name=telefono]').val();
            var web = $('input[name=web]').val();
            var nome = $('input[name=nome]').val();
            var cognome = $('input[name=cognome]').val();
            var email = $('input[name=email]').val();
            var password = $('input[name=password]').val();
            var password2 = $('input[name=password2]').val();


            if (password.length < 6 || password.length !== password2.length)
            {
                $('#dialog_message').html('Le password non coincidono o sono troppo corte - Passwords don’t match or are too short');
                $('#dialog_message').dialog();
                return false;
            }

            if (rag_soc.length === 0 || nome.length === 0 || cognome.length === 0 || email === 0)
            {
                $('#dialog_message').html('Campi obbligatori non completi - You must complete all the required fields ');
                $('#dialog_message').dialog();
                return false;
            }


            if (privacy != 1)
            {
                $('#dialog_message').html("E' necessario accettare la privacy - You must accept the privacy policy");
                $('#dialog_message').dialog();
                return false;
            }



            $.ajax({
                type: "post",
                url: baseurl + "clienti/inserisci",
                dataType: "html",
                cache: false,
                beforeSend: function() {

                },
                data: {
                    tipo: tipo,
                    categoria: categoria,
                    privacy: privacy,
                    rag_soc: rag_soc,
                    indirizzo: indirizzo,
                    citta: citta,
                    provincia: provincia,
                    nazione: nazione,
                    piva: piva,
                    telefono: telefono,
                    web: web,
                    nome: nome,
                    cognome: cognome,
                    email: email,
                    password: password,
                    password2: password2
                },
                success: function(data) {
                    if (data == 0)
                    {
                        $('#dialog_message').html("Inserimento effettuato con successo. riceverai una mail per completare la registrazione -  Your registration has been successful. You will receive a confirmation email to complete the process");


                        $('#dialog_message').dialog(
                                {
                                    title: "OK!",
                                    modal: true,
                                    close: function() {
                                        window.location = baseurl + "clienti";
                                    }
                                }
                        );







//                    window.location.reload();
                    }
                    else
                    {
                        $('#dialog_message').html(data);
                        $('#dialog_message').dialog(
                                {
                                    title: "ERRORE! - ERROR!",
                                    modal: true,
                                });

                    }

                }
            });




        });



    },
    contatti_view: function(baseurl) {

    },
    clienti_view: function(baseurl) {

    },
    av_view: function(baseurl) {

    },
    av_dettaglio_offerta_view: function(baseurl) {
        $('.ant_foto').on("click", function() {

            var att = $(this).attr('data-url');

            $('#grande_foto img').attr("src", att);
        });

        $('#btn_rich_info_prod').on("click", function()
        {
            var contenuto = $('#contenuto_dettaglio_offerta').val();
            var codice=$('#dettaglio_offerta_prodotto h1:first').html();

            $.ajax({
                type: "post",
                url: baseurl + "av/mail_richiesta",
                dataType: "html",
                cache: false,

                data: {
                    contenuto: contenuto,
                    codice: codice
                },
                success: function(data) {
                    $('#dialog_message').html("Messaggio inviato con successo - Message successful send ");
                    $('#dialog_message').dialog(
                                                           {
                                    title: "OK!",
                                    modal: true,
                                    close: function() {
                                        $('#contenuto_dettaglio_offerta').val("");
                                    }
                                });
                
                }
            });
        })

    },
    galleria: function() {

        Galleria.configure({
            transition: 'fade',
            teansitionSpeed: 300,
            autoplay: true,
            carousel: true,
            easing: 'galleria',
//            lightbox: true,
            thumbnails: false,
            showCounter: false,
            imageCrop: true
        });
        Galleria.run('.galleria');
    },
    galleria2: function() {

        Galleria.configure({
//            transition: 'fade',
            teansitionSpeed: 300,
            autoplay: true,
            carousel: true,
            showCounter: false,
            transition: 'fade',
//            easing: 'galleria',
//            lightbox: true,
            thumbnails: false,
            showImagenav: false
//            imageCrop: true
        });
        Galleria.run('.galleria');
    },
    galleria3: function() {

        Galleria.configure({
            transition: 'fade',
            teansitionSpeed: 300,
//            easing: 'galleria',
            lightbox: true,
            thumbnails: false,
            imageCrop: true
        });
        Galleria.run('.galleria3');
    }
}
