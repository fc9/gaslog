module.exports = {
    init: $ => {
        const dropdowns = $(".dropdown");

        dropdowns.each((i, el) => {
            $(el).click(e => {
                e.preventDefault();
                e.stopPropagation();
                const link = $(el).find("a[data-toggle]");
                const menu = $(el).find(".dropdown-menu");
                $(el).toggleClass("show");
                menu.toggleClass("show");
                if ($(el).hasClass("show")) {
                    menu.data("expanded", true);
                } else {
                    menu.data("expanded", false);
                }
            });
            $(el).find('.dropdown-item').click(e => {
                e.stopPropagation();
            });
        });
        $("body").click(e => {
            e.stopPropagation();

            dropdowns.each((i, el) => {
                const link = $(el).find("a[data-toggle]");
                const menu = $(el).find(".dropdown-menu");
                $(el).removeClass("show");
                menu.removeClass("show");
                menu.data("expanded", false);
            });
        });
    }
};
