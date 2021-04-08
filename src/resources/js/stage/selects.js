module.exports = {
    init: $ => {
        const state = {
            body: $("body"),
            main: $("main"),
            selects: $(".select"),
            selectSchool: $(".select--schools"),
            selectSchoolType: $(".select__options__schools-type"),
            dataSchools: [
                "Escola Comunitária",
                "Escola Particular",
                "ONG",
                "Outros"
            ]
        };
        if (state.selectSchool.length) {
            state.selectSchool.each((i, el) => {
                let scope = {
                    text: $(el)
                        .find(".select__selected label")
                        .text(),
                    wrapperSchool: $(el)
                        .closest(".box-repeater__wrapper")
                        .find(".select__options--schools-subitem")
                };
                if (scope.text) {
                    if (state.dataSchools.includes(scope.text)) {
                        scope.wrapperSchool.slideDown("slow");
                    } else {
                        scope.wrapperSchool.hide();
                    }
                }
            });
        }

        if (state.selectSchoolType.length) {
            state.selectSchoolType.each((i, el) => {
                let scope = {
                    text: $(el)
                        .find(".select__selected label")
                        .text(),
                    wrapperSchool: $(el)
                        .closest(".box-repeater__wrapper")
                        .find(".form-group__schools-type")
                };
                if (scope.text) {
                    if (scope.text === "Outros") {
                        scope.wrapperSchool.slideDown("slow");
                    } else {
                        scope.wrapperSchool.hide();
                    }
                }
            });
        }
        // console.log(state.main.hasClass("subscription--completed"));
        if (!state.main.hasClass("subscription--completed")) {
            state.selects.each((i, el) => {
                module.exports.callSelect($, $(el));
            });

            state.body.click(e => {
                e.stopPropagation();
                state.selects.removeClass("select--actived");
            });
        }
    },
    callSelect: ($, select) => {
        const state = {
            wrapperSchool: select
                .closest(".box-repeater__wrapper")
                .find(".select__options--schools-subitem"),
            wrapperSchoolType: select
                .closest(".box-repeater__wrapper")
                .find(".form-group__schools-type"),
            dataSchools: [
                "Escola Comunitária",
                "Escola Particular",
                "ONG",
                "Outros"
            ]
        };
        let scope = {
            selected: select.find(".select__selected"),
            label: select.find(".select__selected label"),
            input: select.find("input"),
            options: select.find(".select__options li"),
            filter: select.find(".select__options input")
        };
        scope.selected.click(e => {
            e.stopPropagation();
            removeFilter(scope.filter, scope.options)
            if (!select.hasClass("disabled")) {
                $(e.target)
                    .closest(".select")
                    .toggleClass("select--actived");
            }
        });
        scope.options.each((i, option) => {
            $(option).click(e => {
                e.stopPropagation();
                let value = $(option).attr("data-value");
                let text = $(option).text();
                scope.label.text(text);
                scope.input.val(value);
                select.removeClass("select--actived");
                if (select.hasClass("select--schools")) {
                    if (state.dataSchools.includes(text)) {
                        state.wrapperSchool.slideDown("slow");
                    } else {
                        state.wrapperSchool.hide();
                    }
                }
                if (select.hasClass("select__options__schools-type")) {
                    if (value === "8") {
                        state.wrapperSchoolType.slideDown("slow");
                    } else {
                        state.wrapperSchoolType.hide();
                    }
                }
            });
        });

        if (select.hasClass('select--filter')) {
            scope.filter.click((e) => {
                e.stopPropagation()
            })
            scope.filter.keyup((e) => {
                e.stopPropagation()
                let val = e.target.value.toLowerCase();
                scope.options.each(function (i, item) {
                    if (!val) {
                        $(item).removeClass('hidden');
                    } else {
                        if ($(item).text().toLowerCase().indexOf(val) === -1) {
                            $(item).addClass('hidden');
                        } else {
                            $(item).removeClass('hidden');
                        }
                    }
                })
            })
        }

        function removeFilter(filter, options) {
            filter.val('')
            options.each(function (i, item) {
                $(item).removeClass('hidden');
            })
        }

    }
};
