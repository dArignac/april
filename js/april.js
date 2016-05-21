+function ($) {
    $(function () {
        // adjust the toggler class on opening a collapsible from the primary navigation
        $('#collapsingNavbar').find('ul li ul.collapse').on({
            'show.bs.collapse': function () {
                $(this).prev('span.toggler').addClass('open');
            },
            'hide.bs.collapse': function () {
                $(this).prev('span.toggler').removeClass('open');
            }
        });

        // adjust the toggler class on opening the primary widgets sidebar
        $('#widgets-primary').on({
            'show.bs.collapse': function () {
                $('#widgets-primary-open').find('i').toggleClass('fa-plus');
                $('#widgets-primary-open').find('i').toggleClass('fa-minus');
            },
            'hide.bs.collapse': function () {
                $('#widgets-primary-open').find('i').toggleClass('fa-plus');
                $('#widgets-primary-open').find('i').toggleClass('fa-minus');
            }
        });
    });
}(jQuery);