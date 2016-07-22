(function ($) {
    var $isotop = $('.tlp-team-isotope').imagesLoaded(function () {
        $isotop.isotope({
            getSortData: {
                name: '.name',
                designation: '.designation',
            },
            sortAscending: true,
            itemSelector: '.team-member',
        });
    });

    $('.sort-by-button-group').on('click', 'button', function () {
        var sortByValue = $(this).attr('data-sort-by');
        $isotop.isotope({sortBy: sortByValue});
        $(this).parent().find('.selected').removeClass('selected');
        $(this).addClass('selected');
    });

    $(window).resize(HeightResize);
    $(window).load(HeightResize);

    var readMore = $('.session_read_more'), readLess = $('.session_read_less');
    readMore.on('click', function () {
        var th = $(this), current = th.parent(), prevSpan = current.prev();
        prevSpan.slideDown(300);
        current.slideUp(100);
    });
    readLess.on('click', function () {
        var th = $(this), current = th.parent(), nextSpan = current.next();
        nextSpan.slideDown(300);
        current.slideUp(100);
    });

})(jQuery);

function HeightResize() {
    if (jQuery(window).width() > 768) {
        jQuery(".tlp-team").each(function () {
            var tlpMaxH = 0;
            jQuery(this).children('div').children(".tlp-equal-height").height("auto");
            jQuery(this).children('div').children(".tlp-equal-height").each(function () {
                var $thisH = jQuery(this).outerHeight();
                if ($thisH > tlpMaxH) {
                    tlpMaxH = $thisH;
                }
            });
            jQuery(this).children('div').children(".tlp-equal-height").height(tlpMaxH + "px");
        });


        var tlpMaxH = 0;
        jQuery(".tlp-team-isotope > div > .tlp-equal-height").height("auto");
        jQuery(".tlp-team-isotope > div > .tlp-equal-height").each(function () {
            var $thisH = jQuery(this).outerHeight();
            if ($thisH > tlpMaxH) {
                tlpMaxH = $thisH;
            }
        });
        jQuery(".tlp-team-isotope > div > .tlp-equal-height").height(tlpMaxH + "px");
    } else {
        jQuery(".tlp-team").children('div').children(".tlp-equal-height").height("auto");
        jQuery(".tlp-team-isotope > div > .tlp-equal-height").height("auto");
    }
}