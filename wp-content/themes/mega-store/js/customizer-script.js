jQuery(document).ready(function($) {
    'use strict';

    $(document).on('click', '.mega_store_go_to_section', function(event) {
        event.preventDefault();
        var id = jQuery(this).attr('href');
        if (typeof(id) != 'undefined') {
            jQuery(id).find('h3').trigger('click');
        }
    });


    $(document).on('click', 'li[id*="accordion-section-mega_store_home_"]', function(event) {

        var sections = $(this).attr('aria-owns').split('_');
        if (sections.length) {
            var section = sections[sections.length - 2];
            wp.customize.previewer.send('customizer-section-clicked', section);
        }
    });

});