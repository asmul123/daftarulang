/**
 * Template Name: Maundy - v2.0.0
 * Template URL: https://bootstrapmade.com/maundy-free-coming-soon-bootstrap-theme/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
!(function ($) {
    "use strict";

    // Countdown timer
    if ($("[data-count]").length) {
        $("[data-count]").each(function () {
            var $this = $(this),
                finalDate = $(this).data("count");
            $this.countdown(finalDate, function (event) {
                $this.html(
                    event.strftime(
                        "<div><h3>%D</h3><h4>Hari</h4></div>" +
                            "<div><h3>%H</h3><h4>Jam</h4></div>" +
                            "<div><h3>%M</h3><h4>Menit</h4></div>" +
                            "<div><h3>%S</h3><h4>Detik</h4></div>",
                    ),
                );
            });
        });
    }

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });

    $(".back-to-top").click(function () {
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            1500,
            "easeInOutExpo",
        );
        return false;
    });
})(jQuery);
