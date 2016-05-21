+function ($) {
    $(function () {
        var toggleNavigation =  function() {
            $(this).prev('span.toggler').toggleClass('open');
        };
        
        // adjust the toggler class on opening a collapsible from the primary navigation
        $('#collapsingNavbar').find('ul li ul.collapse').on({
            'show.bs.collapse': toggleNavigation,
            'hide.bs.collapse': toggleNavigation
        });

        var toggleWidgets = function() {
            $('#widgets-primary-open').find('i').toggleClass('fa-plus');
            $('#widgets-primary-open').find('i').toggleClass('fa-minus');
            $(this).parent().toggleClass('open');
        };

        // adjust the toggler class on opening the primary widgets sidebar
        $('#widgets-primary').on({
            'show.bs.collapse': toggleWidgets,
            'hide.bs.collapse': toggleWidgets
        });
    });
}(jQuery);