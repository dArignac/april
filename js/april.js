+function ($) {
    $(function () {
        // adjust the toggler class on opening a collapsible from the primary navigation
        $( "#collapsingNavbar ul li ul.collapse" ).on({
            'show.bs.collapse': function () {
                $(this).prev('span.toggler').addClass('open');
            },
            'hide.bs.collapse': function () {
                $(this).prev('span.toggler').removeClass('open');
            }
        });
    });
}(jQuery);