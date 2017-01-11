$(function() {

    $('input[type=checkbox]').click(function(event) {
        console.log($(this).val());
        var a = ($(this).val() == 0 ) ? 1 : 0;
        $(this).val(a);
    })

    $("input#contactname, input#contactemail, input#contactphone, textarea#contactmessage").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            // Prevent spam click and default submit behaviour
            $("#sendContactForm").attr("disabled", true);
            event.preventDefault();
            
            // get values from FORM
            var name = $("input#contactname").val();
            var email = $("input#contactemail").val();
            var phone = $("input#contactphone").val();
            var language = $("input#language").val();
            var shop = $("#contactForm .dropdowns button[data-id='subscribeShop']").prop('title');
            var country = $("#contactForm .dropdowns button[data-id='subscribeCountry']").prop('title');
            var newsletter = $("#contactForm .dropdowns input#subscribeNewsletterContactForm").val();
            var message = $("textarea#contactmessage").val();
            var firstName = name; // For Success/Failure Message
            var data = {
                    name: name,
                    phone: phone,
                    email: email,
                    message: message,
                    shop: shop,
                    language: language,
                    country: country,
                    newsletter: newsletter,
                    sendContactForm: true,
                };

            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "core/mail/contact_me.php",
                type: "POST",
                data: data,
                cache: false,
                success: function(response) {
                    console.log(response);
                    response = $.parseJSON(response);
                    // Enable button & show success message
                    $("#sendContactForm").attr("disabled", false);
                    $('#contactsuccess').html(response.message);

                    //clear all fields
                    $('#contactForm').trigger("reset");
                },
                error: function(response) {
                    console.log(response);
                    // Fail message
                    $('#contactsuccess').html("<div class='alert alert-danger'>");
                    $('#contactsuccess > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#contactsuccess > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    $('#contactsuccess > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm').trigger("reset");
                },
            })
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("input#name, input#email, input#phone, textarea#message").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            // Prevent spam click and default submit behaviour
            $("#sendWishlistForm").attr("disabled", true);
            event.preventDefault();
            
            // get values from FORM
            var name = $("input#name").val();
            var email = $("input#email").val();
            var phone = $("input#phone").val();
            var language = $("input#language").val();
            var country = $("#wishlistForm .dropdowns button[data-id='subscribeCountry']").prop('title');
            var newsletter = $("#wishlistForm .dropdowns input#subscribeNewsletterWishlistForm").val();
            var message = $("textarea#message").val();
            var firstName = name; // For Success/Failure Message
            var image_link = $('#image-preview').attr('src'); // For Success/Failure Message
            var data = {
                    name: name,
                    phone: phone,
                    email: email,
                    message: message,
                    language: language,
                    country: country,
                    newsletter: newsletter,
                    sendWishlistForm: true,
                    image_link: image_link,
                };
            console.log(data);
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "core/mail/contact_me.php",
                type: "POST",
                data: data,
                cache: false,
                success: function(response) {
                    console.log(response);
                    response = $.parseJSON(response);
                    // Enable button & show success message
                    $("#sendWishlistForm").attr("disabled", false);
                    $('#success').html(response.message);

                    //clear all fields
                    $('#wishlistForm').trigger("reset");
                },
                error: function(response) {
                    console.log(response);
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#wishlistForm').trigger("reset");
                },
            })
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

// When clicking on Full hide fail/success boxes
$('#name').focus(function() {
    $('#success').html('');
});
