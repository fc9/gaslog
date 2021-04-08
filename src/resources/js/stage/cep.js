module.exports = {
    init: ($, axios) => {

        const body = $('body');

        const state = {
            parent: body.find('.section-school'),
         };

        state.parent.on("change", ".cepField", (e) => {

            const el = $(e)[0];

            const parent = $(el.target).closest('.form-item__escola');
            const cep  = el.target.value.replace(/\D/g, '');

            const stateField     = $(parent).find('.form-item__escola--estado').find('input');
            const stateLabel     = $(parent).find('.form-item__escola--estado').find('label');
            const cityIdField    = $(parent).find('.form-item__escola--cidade').find('input.city_id');
            const cityField      = $(parent).find('.form-item__escola--cidade').find('label');
            const cityFieldSelect      = $(parent).find('.form-item__escola--cidade').find('.select');
            const citiesOptions  = $(parent).find('.form-item__escola--cidade').find('.select__options');
            const addressField   = $(parent).find('.form-item__escola--endereco').find('input');

            stateField.val("");
            cityIdField.val("");
            cityField.val("");
            addressField.val("");
            citiesOptions.html('');

            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                if(validacep.test(cep)) {

                    parent.LoadingOverlay("show");

                    const viaCep = axios.create();
                    viaCep.defaults.timeout = 5000;

                    viaCep.get(`https://viacep.com.br/ws/${cep}/json/`)
                    .then((response) => {

                        if (!response.data.erro) {

                            const data = response.data;

                            stateField.val(data.uf);
                            stateLabel.text(data.uf);
                            addressField.val(data.logradouro);

                            // Carrega cidades do estado
                            axios.get(`/api/city?state=${data.uf}`)
                            .then((response) => {

                                if( response.data.cities ) {
                                    response.data.cities.forEach( city => {
                                        if(city.name.toUpperCase() == data.localidade.toUpperCase()) {
                                            cityField.text(city.name)
                                            cityIdField.val(city.id)
                                            cityFieldSelect.removeClass('disabled')
                                        }
                                        citiesOptions.append(`<li data-value="${city.id}" data-name="${city.name}">${city.name}</li>`);
                                    });
                                }

                            })
                            .catch(({ response  }) => {

                                const { status, data } = response;

                                const MESSAGE_MAP = {
                                        400: data.message
                                };

                                window.alert(
                                        MESSAGE_MAP[status] || "Algo inesperado ocorreu ao carregar cidades."
                                );
                            })
                            .finally( () => {
                            });
                        } else {
                            window.alert("CEP não encontrado");
                        }
                    })
                    .catch(({ response  }) => {
                        /*
                    const { status, data } = response;

                        const MESSAGE_MAP = {
                                400: data.message
                        };

                        window.alert(
                                MESSAGE_MAP[status] || "Algo inesperado ocorreu."
                        ); */
                    })
                    .finally( () => {
                        parent.LoadingOverlay("hide");
                    });
                } else {
                    window.alert("CEP inválido");
                }
            }

        });
    }
};
