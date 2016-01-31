jQuery(document).ready(function($) {
    $('#benz_add_wishlist').click(function(e) {
        $.post(document.location.protocol+'//'+document.location.host+'/wp-admin/admin-ajax.php', MyAjax, function(response) {
            $('#benz_add_wishlist_div').html('You want this');
        })
    });
});