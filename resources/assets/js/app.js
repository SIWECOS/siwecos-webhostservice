
require('./bootstrap');

jQuery( document ).ready(function( $ ) {
    if($('.incidentform').length) {
        // Implement filter toggle feature
        $('.filterdetails').hide();

        $('#filterable').change(function () {
            if ($(this).is(':checked')) {
                $('.filterdetails').show();

                return;
            }

            $('.filterdetails').hide();
        });

        // Implement add/remove feature for rulesets
        $('.rulegroup .btn-add').click(function (e) {
            e.preventDefault();

            var groupname = $(this).attr('data-group');

            $(this).before($('<div class="form-group input-group"><textarea name="' + groupname + '[]" class="form-control"></textarea><span class="input-group-btn"><button type="button" class="btn btn-danger btn-remove">-</button></span></div>'));
        });

        $('.idgroup .btn-add').click(function (e) {
            e.preventDefault();

            var groupname = $(this).attr('data-group');

            $(this).before($('<div class="form-group input-group"><input type="text" name="' + groupname + '[]" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-danger btn-remove">-</button></span></div>'));
        });

        $('.rulegroup, .idgroup').on('click', ' .btn-remove', function (e) {
            e.preventDefault();

            $(this).parents('.input-group').remove();
        });

        // Implement auto-refresh for bugreport preview
        $('.incidentform fieldset:first-child').on('change', 'input, textarea, select', function () {
            $.ajax({
                type: "POST",
                url: '/bugreport/mail',
                data: $(".incidentform form").serialize(),
                success: function (response) {
                    $('#clipboard').val(response.body);
                }
            });
        });

        // Implement bugreport signature validation
        $('.incidentform #signedemail').change(function () {
            $('.incidentform [type=submit]').attr('disabled', 'disabled').addClass('disabled');

            $.ajax({
                type: "POST",
                url: '/pgp/verifysignature',
                data: {
                    signedtext: $("#signedemail").val(),
                    plaintext: $("#clipboard").val(),
                    _token: $("*[name=_token]").val()
                },
                success: function (response) {
                    $('.incidentform *[type=submit]').removeAttr('disabled').removeClass('disabled');
                },
                error: function (response) {
                    alert(response.responseJSON.signedtext[0]);
                }
            });
        });
    }

    if($('.notificationform').length)
    {
        // Implement auto-refresh for notification preview
        $('.notificationform fieldset:first-child').on('change', 'input, textarea, select', function() {
            $.ajax({
                type: "POST",
                url: '/notification/mail',
                data: $(".notificationform form").serialize(),
                success: function(response) {
                    $('#clipboard').val(response.body);
                }
            });
        });

        $('.idgroup .btn-add').click(function (e) {
            e.preventDefault();

            var groupname = $(this).attr('data-group');

            $(this).before($('<div class="form-group input-group"><input type="text" name="' + groupname + '[]" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-danger btn-remove">-</button></span></div>'));
        });

        $('.idgroup').on('click', ' .btn-remove', function (e) {
            e.preventDefault();

            $(this).parents('.input-group').remove();
        });

        // Implement notification signature validation
        $('.notificationform #signedemail').change(function() {
            $('.notificationform [type=submit]').attr('disabled', 'disabled').addClass('disabled');

            $.ajax({
                type: "POST",
                url: '/pgp/verifysignature',
                data: {
                    signedtext:$("#signedemail").val(),
                    plaintext:$("#clipboard").val(),
                    _token:$("*[name=_token]").val()
                },
                success: function(response) {
                    $('.notificationform *[type=submit]').removeAttr('disabled').removeClass('disabled');
                },
                error: function(response) {
                    alert(response.responseJSON.signedtext[0]);
                }
            });
        });
    }
});