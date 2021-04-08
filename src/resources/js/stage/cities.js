module.exports = {
    init: ($) => {

        const state = {
            body: $('body'),
            selectState: $('.select.states'),
            selectCity: $('.select.cities')
        };

        state.selectState.each((i, el) => {

            let scope = {
                selected: $(el).find('.select__selected'),
                input: $(el).find('input'),
                options: $(el).find('.select__options li'),
                stateCityWrapper: $(el).closest('.stateCityWrapper'),
                selectCity: $(el).closest('.stateCityWrapper').find('.select.cities'),
                filter: $(el).find(".select__options input")
            }

            if (scope.selected.find('label').text()) {
                scope.stateCityWrapper.find('.select.cities').removeClass('disabled')
            }

            scope.selected.click((e) => {
                e.stopPropagation()
                //state.selectCity.removeClass('select--actived') 
                scope.selectCity.removeClass('select--actived')
                removeFilter(scope.filter, scope.options)
                $(el).hasClass('select--actived') ? $(el).addClass('select--actived') : $(el).removeClass('select--actived')

            })

            scope.options.each((i, option) => {

                $(option).click((e) => {
                    e.stopPropagation()

                    // let cityGroup = state.selectCity.find('.select__options'); 
                    // state.selectCity.find('.select__options li').remove(); 
                    // scope.stateCityWrapper.find('.select.cities').removeClass('disabled') 
                    // const cityField = state.selectCity.find(".city_id")[0]; 
                    //cityField.value = "" 

                    let cityGroup = scope.selectCity.find('.select__options');
                    scope.selectCity.find('.select__options li').remove();
                    scope.stateCityWrapper.find('.select.cities').removeClass('disabled');
                    let value = $(option).data('value')

                    if (value == "") {
                        return false;
                    }

                    //Load cities
                    axios.get(`/api/city?state=${value}`)
                        .then((response) => {

                            if (response.data.cities) {
                                $(el).removeClass('select--actived')
                                //state.selectCity.find(".city_id").val('') 
                                //state.selectCity.find("label").text('') 
                                scope.stateCityWrapper.find('.select.cities').find("input[type=hidden]").val('')
                                scope.stateCityWrapper.find('.select.cities').find("label").text('')
                                response.data.cities.forEach(city => {
                                    cityGroup.append(`<li data-value="${city.id}" data-name="${city.name}">${city.name}</li>`);
                                });
                            }

                        })
                        .catch(({ response }) => {
                            const { status, data } = response;

                            const MESSAGE_MAP = {
                                400: data.message
                            };

                            window.alert(
                                MESSAGE_MAP[status] || "Algo inesperado ocorreu ao carregar cidades."
                            );
                        })

                })
            })

            if (state.selectState.hasClass('select--filter')) {
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
        })

        state.selectCity.each((i, el) => {

            let scope = {
                selected: $(el).find('.select__selected'),
                input: $(el).find(".city_id"),
                label: $(el).find("label"),
                options: $(el).find('.select__options'),
                filter: $(el).find(".select__options input")
            }

            scope.selected.click((e) => {
                e.stopPropagation()
                removeFilter(scope.filter, scope.options)
                $(el).hasClass('select--actived') ? $(el).addClass('select--actived') : $(el).removeClass('select--actived')

                scope.options = state.selectCity.find('.select__options li');

            })

            scope.options.click((option) => {

                option.stopPropagation();

                const value = $(option.target).data('value')
                const name = $(option.target).data('name')

                scope.input.val(value)
                scope.label.text(name)
                //if (option.target.type !== 'text') { 
                    $(el).removeClass('select--actived')
                //}
            })

            if ($(el).hasClass('select--filter')) {
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

        })

        function removeFilter(filter, options) {
            filter.val('')
            options.each(function (i, item) {
                $(item).removeClass('hidden');
            })
        }

        state.body.click((e) => {
            e.stopPropagation()
            state.selectState.removeClass('select--actived')
            state.selectCity.removeClass('select--actived')
        })
    }
}
