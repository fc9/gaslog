module.exports = {
    init: $ => {
        $(".menu").on("click", function () {
            $(this).toggleClass("active");
            $(".menu_mobile").toggleClass("active");
            $("#header").toggleClass("active");
            $("body").toggleClass("overflow-hidden");
        });
        $(window).on("load", function () {
            let $header = $('#header')
            let lastScrollTop = 0
            if ($(window).width() >= 1024) {
                $(window).scroll(function () {
                    let windowOffset = window.pageYOffset;
                    let scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
                    if (windowOffset > $header.outerHeight()) {
                        if (scrollPosition > lastScrollTop && scrollPosition > $header.outerHeight()) {
                            $header.addClass('header--outview');
                            $header.removeClass('header--inview');
                        } else {
                            $header.addClass('header--fixed');
                            $header.removeClass('header--outview');
                            $header.addClass('header--inview');
                            $('.header__wrapper').removeClass('active');
                        }
                        setTimeout(
                            function () {
                                lastScrollTop = scrollPosition;
                            }, 205);
                    } else {
                        $header.removeClass('header--fixed');
                        $header.removeClass('header--inview');
                        lastScrollTop = 0;
                    }
                });
            }
        });
    }
};
