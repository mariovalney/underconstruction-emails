var mailMask = "[a-zA-Z0-9]+[a-zA-Z0-9._-]*[@][a-zA-Z0-9]{1,}[-]{0,}[a-zA-Z0-9]{0,}[.]{1}[a-zA-Z0-9]{1,}[-]{0,}[a-zA-Z0-9]{1,}([\.]{1}[0-9a-zA-Z]{2,}){0,}"

jQuery(document).ready(function($) {
    $('.check-email').on('change', function(event) {
        event.preventDefault();

        var input = $(this).val();
        var padrao = new RegExp(mailMask);
        var regexResult = (padrao.exec(input) != null) ? padrao.exec(input) : 0;

        if ((regexResult.index == 0) && (regexResult[0] == regexResult.input)) {
            $(this).parents('.form-group.has-feedback').removeClass('no-feedback has-error').addClass('has-success');
            $(this).siblings('.form-control-feedback').addClass('glyphicon-ok').removeClass('glyphicon-remove');
        } else {
            $(this).parents('.form-group.has-feedback').removeClass('has-success').addClass('no-feedback has-error');
            $(this).siblings('.form-control-feedback').addClass('glyphicon-remove').removeClass('glyphicon-ok');
        }
    });

    $('#save-registry').on('click', function(event) {
        event.preventDefault();

        var formElement = $('#save-registry-form');
        var statusElement = $('#formStatus');

        if (!formElement.hasClass('submiting')) {
        
            formElement.addClass('submiting');        

            var emailValue = formElement.find('#customerEmail').val();
            var nonceValue = formElement.find('#uc-add-registry-security').val();            

            statusElement.removeClass('ok error').addClass('loading').find('.msg').text('Enviando...');

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'save_registry',
                    email: emailValue,
                    uc_nonce: nonceValue
                }
            })
            .done(function(data) {
                formElement.removeClass('submiting');

                if (data.status == 'ok' || data.status == 'error') {
                    formElement.find('.form-control-feedback').hide();
                    statusElement.removeClass('ok error').addClass(data.status).find('.msg').text(data.msg);
                } else {
                    formElement.find('.form-control-feedback').hide();
                    statusElement.removeClass('ok error').addClass('error').find('.msg').text('Ops... Houve um erro. Por favor, tente novamente.');
                }
            })
            .fail(function() {
                formElement.removeClass('submiting');
                alert('Ops... A conexão falhou, tente novamente daqui a pouco.');
            });

        }
    });
});