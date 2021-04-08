module.exports = {
    init: $ => {
        const state = {
            requireds: $("[required]")
        };
        if (state.requireds.length) {
            const scope = {
                submit: $("button[type=submit]")
            };
            // scope.submit.addClass("disabled");
            scope.submit.click(e => {
                state.requireds.each((i, el) => {
                    $(el)
                        .closest(".form-group")
                        .removeClass("form-group__error");
                });
                if (scope.submit.hasClass("disabled")) {
                    e.preventDefault();
                }
                let erros = state.requireds.length;

                // console.log(erros);
                state.requireds.each((i, el) => {
                    if ($(el).val()) {
                        erros--;
                        $(el)
                            .closest(".form-group")
                            .removeClass("form-group__error");
                    } else {
                        $(el)
                            .closest(".form-group")
                            .addClass("form-group__error");
                    }
                });
                if (!erros) {
                    scope.submit.removeClass("disabled");
                }
            });
            let errosChange = [];
            for (var i = 0; i < state.requireds.length; i++) {
                errosChange.push(null);
            }
            state.requireds.each((key, el) => {
                $(el).change(e => {
                    if ($(el).val()) {
                        errosChange[key] = $(el).val();
                        $(el)
                            .closest(".form-group")
                            .removeClass("form-group__error");
                    } else {
                        $(el)
                            .closest(".form-group")
                            .addClass("form-group__error");
                    }
                    if (!errosChange.includes(null)) {
                        scope.submit.removeClass("disabled");
                    }
                });
            });
        }
    }
};
