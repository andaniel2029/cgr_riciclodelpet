
var baseurl = 'http://www.cgr-riciclodelpet.it/';
//var baseurl = 'http://localhost/cgr/index.php/';
//var baseurl = 'http://192.168.1.2/cgr/index.php/';
//var baseurl = 'http://cgr.retelocale.com/index.php/';
var generic = {
    generic: function(baseurl) {
        $('.elimina').on("click", function() {
            if (!confirm('Sicuro?')) {
                return false;
            }
            $.datepicker.regional['it'] = {
                clearText: 'Svuota',
                clearStatus: '',
                closeText: 'Chiudi',
                closeStatus: '',
                prevText: '&lt;Prec',
                prevStatus: '',
                nextText: 'Succ&gt;',
                nextStatus: '',
                currentText: 'Oggi',
                currentStatus: '',
                monthNames: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno',
                    'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                monthNamesShort: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu',
                    'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],
                monthStatus: '',
                yearStatus: '',
                weekHeader: 'Sm',
                weekStatus: '',
                dayNames: ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Me', 'Gio', 'Ve', 'Sa'],
                dayStatus: 'DD',
                dateStatus: 'D, M d',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                initStatus: '',
                isRTL: false
            };
            $.datepicker.setDefaults($.datepicker.regional['it']);
        });
    },
    clienti_v: function(baseurl) {
        $('table tbody tr:even').css("background-color", "darkgray");
    },
    offerte_pubblicate_view: function(baseurl) {

        $('.class_prolunga_form').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: '1d'
        });

        $('.prolunga').on("click", function() {
            var data_nuova = $(this).siblings('input').val();
            var id = $(this).siblings('input').attr('data-id');
            $.ajax({
                type: "post",
                url: baseurl + "admin/offerte/nuova_scadenza",
                async: false,
                data: {
                    id: id,
                    data_nuova: data_nuova
                },
                success: function(data) {
                    $('#dialog_message').html('Scadenza modificata');
                    $('#dialog_message').dialog();
                }
            });
        });

        $('.attiva_disattiva').change(function() {
            var id = $(this).attr('data-id');
            var attivo = $(this).val();

            $.ajax({
                type: "post",
                url: baseurl + "admin/offerte/attiva",
                async: false,
                data: {
                    id: id,
                    attivo: attivo
                },
                success: function(data) {

                }
            });


        })
    },
    admin_offerte_view: function(baseurl) {



        $('input[name=scadenza]').datepicker({
            dateFormat: "dd-mm-yy"
        });
        $('button[name=offerte_per_clienti_button]').on("click", function() {
            var nome = $('input[name=nome]').val();
            var polimero = $('input[name=polimero]').val();
            var quantita = $('input[name=quantita]').val();
            var prezzo = $('input[name=prezzo]').val();
            var resa = $('input[name=resa]').val();
            var imballo = $('input[name=imballo]').val();
            var peso = $('input[name=peso]').val();
            var mezzo = $('input[name=mezzo]').val();
            var cer = $('input[name=cer]').val();
            var scadenza = $('input[name=scadenza]').val();
            var attiva = $('input[name=attiva]:checked').val();
            var descrizione = $('textarea[name=descrizione]').val();
            var destinatari = $('#multiselect').val();
            var id_offerta_originale = $('input[name=id_offerta_originale]').val();
            
            var rifiuto = $("input[type='radio'][name='rifiuto']:checked").val();
           

            $.ajax({
                type: "post",
                url: baseurl + "admin/offerte/salva_offerte",
                async: false,
                data: {
                    nome: nome,
                    polimero: polimero,
                    quantita: quantita,
                    prezzo: prezzo,
                    resa: resa,
                    imballo: imballo,
                    peso: peso,
                    mezzo: mezzo,
                    cer: cer,
                    scadenza: scadenza,
                    descrizione: descrizione,
                    destinatari: destinatari,
                    attiva: attiva,
                    rifiuto: rifiuto,
                    id_offerta_originale: id_offerta_originale

                },
                success: function(data) {

                    if (data.length > 6)
                    {
                        $('#dialog_message').html(data);
                        $('#dialog_message').dialog();
                    }
                    else
                    {

                        window.location = baseurl + "admin/offerte/offerta_foto_file/" + data;



                    }
                }
            });
        });
        $('.dettaglio_off').on("click", function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                url: baseurl + "admin/offerte/dettaglio",
                async: false,
                data: {
                    id: id
                },
                success: function(data) {

                    $('#dialog_message').html(data);
                    $('#dialog_message').dialog({
                        width: 600,
                        height: 400,
                        close: function() {
                            $('#dialog_message').html("");
                        }
                    });
                }
            });
        });
        $('.crea_off').on("click", function()
        {
            $('#get_offerte_per_clienti').slideDown();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                dataType: "json",
                url: baseurl + "admin/offerte/crea_offerta_form",
                async: false,
                data: {
                    id: id
                },
                success: function(data) {
                    var items = new Array;
                    $.each(data, function(k, val) {
                        items[k] = [val];
                    });
                    $('input[name=nome]').val(items['nome']);
                    $('input[name=polimero]').val(items['polimero']);
                    $('input[name=quantita]').val(items['quantita']);
                    $('input[name=prezzo]').val(items['prezzo']);
                    $('#text_area_offerte').val(items['descrizione']);
                    $('input[name=id_offerta_originale]').val(items['id']);
//                   alert(data);
//                    $('#dialog_message').html(data);
//                    $('#dialog_message').dialog({
//                        width: 600,
//                        height: 400,
//                        close: function() {
//                            $('#dialog_message').html("");
//                        }
//                    });



                }
            });
        });
    },
    clienti_aggiungi_view: function(baseurl) {


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
//            if (password.length < 6 || password.length !== password2.length)
//            {
//                $('#dialog_message').html('Le password non coincidono o sono troppo corte');
//                $('#dialog_message').dialog();
//                return false;
//            }

            if (rag_soc.length === 0 || nome.length === 0 || cognome.length === 0 || email === 0)
            {
                $('#dialog_message').html('Campi obbligatori non completi');
                $('#dialog_message').dialog();
                return false;
            }


//            if (privacy != 1)
//            {
//                $('#dialog_message').html("E' necessario accettare la privacy");
//                $('#dialog_message').dialog();
//                return false;
//            }



            $.ajax({
                type: "post",
                url: baseurl + "admin/clienti/inserisci",
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
                        $('#dialog_message').html("Inserimento effettuato con successo. riceverai una mail per completare la registrazione");
                        $('#dialog_message').dialog(
                                {
                                    title: "OK!",
                                    modal: true,
                                    close: function() {
                                        window.location = baseurl + "admin/clienti";
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
    editor: function() {

        CKEDITOR.config.toolbar = [
            ['Preview', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
            '/',
            ['Bold', 'Italic', 'Image']
        ];
        CKEDITOR.config.language = 'it';
    },
    news_v: function() {
        $('#elenco_foto').on("click", '.elimina_foto', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                url: baseurl + "admin/gallery/elimina_foto",
                async: false,
                data: {
                    id: id
                },
                success: function(data) {

                    location.reload(true);
                }
            });
        });
        $('.show_hide').on("click", function() {
            $('#thumbs_show').fadeToggle();
        });
        $('.chk_attivo').on("change", function() {
            var attivo = $(this).val();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                url: baseurl + "admin/news/pubblicato",
                async: false,
                data: {
                    id: id,
                    attivo: attivo
                },
                success: function(data) {

                    location.reload(true);
                }
            });
        });
    },
    clienti_modifica_view: function(baseurl)
    {

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
            var id = $('input[name=id]').val();
            if ((password.length > 0 && password.length < 6) || password.length !== password2.length)
            {
                $('#dialog_message').html('Le password non coincidono o sono troppo corte');
                $('#dialog_message').dialog();
                return false;
            }

            if (rag_soc.length === 0 || nome.length === 0 || cognome.length === 0 || email === 0)
            {
                $('#dialog_message').html('Campi obbligatori non completi');
                $('#dialog_message').dialog();
                return false;
            }


//            if (privacy != 1)
//            {
//                $('#dialog_message').html("E' necessario accettare la privacy");
//                $('#dialog_message').dialog();
//                return false;
//            }



            $.ajax({
                type: "post",
                url: baseurl + "admin/clienti/ricevi_modifica",
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
                    password2: password2,
                    id: id
                },
                success: function(data) {
                    if (data == 0)
                    {
                        $('#dialog_message').html("Modifiche effettuate correttamente");
                        $('#dialog_message').dialog(
                                {
                                    title: "OK!",
                                    modal: true,
                                    close: function() {
                                        window.location = baseurl + "admin/clienti";
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
    statiche_v: function(baseurl) {
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
        CKEDITOR.replace('editor5');
        CKEDITOR.replace('editor6');
        CKEDITOR.replace('editor7');
        CKEDITOR.replace('editor8');
        CKEDITOR.replace('editor9');
        $('button[name=btn1]').on("click", function() {
            var ed0 = CKEDITOR.instances.editor.getData();
            var ed1 = CKEDITOR.instances.editor1.getData();
            var ed2 = CKEDITOR.instances.editor2.getData();
            var ed3 = CKEDITOR.instances.editor3.getData();
            var ed4 = CKEDITOR.instances.editor4.getData();
            var ed5 = CKEDITOR.instances.editor5.getData();
            var ed6 = CKEDITOR.instances.editor6.getData();
            var ed7 = CKEDITOR.instances.editor7.getData();
            var ed8 = CKEDITOR.instances.editor8.getData();
            var ed9 = CKEDITOR.instances.editor9.getData();
            $.ajax({
                type: "post",
                url: baseurl + "admin/statiche/modifica",
                dataType: "html",
                cache: false,
                beforeSend: function() {

                },
                data: {
                    home_it: ed0,
                    home_en: ed1,
                    clienti_it: ed2,
                    clienti_en: ed3,
                    fornitori_it: ed4,
                    fornitori_en: ed5,
                    produzione_it: ed6,
                    produzione_en: ed7,
                    contatti_it: ed8,
                    contatti_en: ed9,
                },
                success: function(data) {

                    window.location.reload();
                }
            })

        })
    },
    upload_success: function() {

    },
    offerte_modifica_view: function(baseurl) {

        $('button[name=offerte_per_clienti_button]').on("click", function() {

            var id = $('input[name=id]').val();
            var nome = $('input[name=nome]').val();
            var polimero = $('input[name=polimero]').val();
            var quantita = $('input[name=quantita]').val();
            var prezzo = $('input[name=prezzo]').val();
            var resa = $('input[name=resa]').val();
            var imballo = $('input[name=imballo]').val();
            var peso = $('input[name=peso]').val();
            var mezzo = $('input[name=mezzo]').val();
            var cer = $('input[name=cer]').val();
            var rifiuto = $("input[type='radio'][name='rifiuto']:checked").val();
            var descrizione = $('textarea[name=descrizione]').val();
            var destinatari = $('#multiselect').val();


            $.ajax({
                type: "post",
                url: baseurl + "admin/offerte/modifica_offerte_cliente",
                async: false,
                data: {
                    id: id,
                    nome: nome,
                    polimero: polimero,
                    quantita: quantita,
                    prezzo: prezzo,
                    resa: resa,
                    imballo: imballo,
                    peso: peso,
                    mezzo: mezzo,
                    cer: cer,
                    rifiuto: rifiuto,
                    descrizione: descrizione,
                    destinatari: destinatari


                },
                success: function(data) {

                    if (data !== '0')
                        if (data.length > 6)
                        {
                            $('#dialog_message').html(data);
                            $('#dialog_message').dialog();
                        }
                        else
                        {

                            window.location = baseurl + "admin/offerte/offerta_foto_file/" + data;



                        }
                }
            });


        });
    },
    offerte_foto_file_view: function(baseurl) {

        $('#invio_mail_offerta').on("click", function() {
            var id = $('input[name=id_offerta]').val();

            $.ajax({
                type: "post",
                url: baseurl + "admin/offerte/invia_mail_offerte",
                async: false,
                data: {
                    id: id
                },
                success: function(data) {
                    $('#dialog_message').html(data);
                    $('#dialog_message').dialog();
                }
            });

        });
        $('#chiudi_pagina_offerta').on("click", function() {
            window.location = baseurl + "admin/offerte/offerte_pubblicate";
        });

        $('.bottone_elimina_foto').on("click", function() {
            var id = $(this).attr('data-id');
            var offerta_id = $(this).attr('data-offerta_id');

            $.ajax({
                type: "post",
                url: baseurl + "admin/offerte/elimina_foto",
                async: false,
                data: {
                    id: id,
                    offerta_id: offerta_id
                },
                success: function(data) {

                }
            });

            $(this).parent('div').hide("slow");

        });

        $('.bottone_salva_file').on("click", function() {
            var id = $(this).attr('data-id');
            var nome = $(this).siblings('input').val();

            $.ajax({
                type: "post",
                url: baseurl + "admin/offerte/modifica_file",
                async: false,
                data: {
                    id: id,
                    nome: nome
                },
                success: function(data) {
                    alert('ok');
                }
            });

        });
        $('.bottone_elimina_file').on("click", function() {
            var id = $(this).attr('data-id');
            var offerta_id = $(this).attr('data-offerta_id');
//            alert('dsf')
//            return false;
            $.ajax({
                type: "post",
                url: baseurl + "admin/offerte/elimina_file",
                async: false,
                data: {
                    id: id,
                    offerta_id: offerta_id
                },
                success: function(data) {
//                    alert(data);
                }

            });
            $(this).parent('div').hide("slow");
        });
    }
};
