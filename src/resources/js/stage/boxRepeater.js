var selects = require("./selects");
var cities = require("./cities");
var erros = require("./erros");
module.exports = {
    init: $ => {
        const repeater = $(".box-repeater");
        const main = $("main");

        repeater.each((i, el) => {
            const state = {
                wrapper: $(el)
                    .find(".box-repeater__wrapper")
                    .last(),
                add: $(el).find(".box-repeater--add"),
                remove: $(el).find(".box-repeater--remove")
            };

            state.add.click(e => {
                e.preventDefault();
                let clone = state.wrapper.clone();
                $(el).append(clone);
                let inputs = $(el).find(
                    '.box-repeater__wrapper:last-child input:not([name="members[][type]"])'
                );
                let select = $(el).find(
                    ".box-repeater__wrapper:last-child .select"
                );
                let label = $(el).find(
                    ".box-repeater__wrapper:last-child .select__selected label"
                );
                let schoolSubitem = $(el).find(
                    ".box-repeater__wrapper:last-child .select__options--schools-subitem"
                );
                let schoolSubitemType = $(el).find(
                    ".box-repeater__wrapper:last-child .form-group__schools-type"
                );
                inputs.val("");
                label.text("");
                if ($(select).hasClass("box-repeater--student")) {
                    module.exports.activeRemove($, $(el), 3);
                } else {
                    module.exports.activeRemove($, $(el), 1);
                    cities.init($);
                }
                $(schoolSubitem).hide();
                $(schoolSubitemType).hide();

                select.each((i, item) => {
                    selects.callSelect($, $(item));
                });
                if ($(window).width() >= 1024) {
                    if (!state.wrapper.length) {
                        $(el).addClass("spaced");
                    } else {
                        $(el).removeClass("spaced");
                    }
                }
                erros.init($);
            });

            // Para campos pré-carregados do form
            state.remove.click(e => {
                e.preventDefault();

                if (!main.hasClass("subscription--completed")) {
                    const element = $(e)[0].target;

                    $(element)
                        .closest(".box-repeater__wrapper")
                        .remove();

                    erros.init($);
                }
            });
        });
    },
    activeRemove: ($, repeater, qtde) => {
        const main = $("main");
        const remove = repeater.find(".box-repeater--remove");
        remove.each((i, el) => {
            $(el).click(e => {
                e.preventDefault();
                if (!main.hasClass("subscription--completed")) {
                    $(el)
                        .closest(".box-repeater__wrapper")
                        .remove();
                    const wrapper = repeater.find(".box-repeater__wrapper");
                    if ($(window).width() >= 1024) {
                        if (wrapper.length <= qtde) {
                            repeater.addClass("spaced");
                        } else {
                            repeater.removeClass("spaced");
                        }
                    }
                }
            });
        });
    }
};
