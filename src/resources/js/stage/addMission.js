module.exports = {
    init: $ => {
        const resource = 'mission'
        const modalConfirm = $('.modal__confirm-mission')
        const modalGeneric = $(".modal__generic")
        const modalGenericScope = {
            title: modalGeneric.find(".modal__generic__title"),
            content: modalGeneric.find(".modal__generic__content")
        }
        const help = $('.missao__help a')

        console.log('loading...')

        help.click((e) => {
            e.preventDefault()
            $('html, body').animate({
                scrollTop: $(".conteudo_pagina__grid").offset().top
            }, 2000);
        })

        $('.form_padrao__submit').click((e) => {
            if ($('form#inscricao').length === 0) {
                window.location.href = `/group`
            }
        })

        $('form#inscricao').on('submit', function (e) {
            e.preventDefault();
            modalConfirm.addClass('modal--active')
        });

        $('.modal__confirm-mission__submit').click((e) => {
            e.preventDefault();
            modalConfirm.removeClass('modal--active')
            $.LoadingOverlay("show");

            // const data = $('form#inscricao')[0]
            // var formdata = new FormData(data);
            var formdata = $('.inscricao').find('form').serializeJSON()

            const createOrUpdateRequest = axios.post(`/api/${resource}`, formdata);

            createOrUpdateRequest
                // .then(() => window.location.href = `/group`)
                .then((response) => console.log(response.data))
                .catch(({response}) => {
                    erroModal()
                    let {status, data} = response
                    console.log(data)
                })
                .finally(() => {
                    $.LoadingOverlay("hide");
                });
        });

        function erroModal() {
            modalGenericScope.content.html(`<p>Algumas informações estão incorretas. <br> Por favor, confira para continuar. </p>`)
            modalGeneric.addClass("modal--active")
        }

    },
    modal: $ => {
        const page = $(".inscricao");
        const modal = $(".modal");
        const modalFinish = $(".modal__finish-subscription");
        const state = {
            buttons: page.find(".form__buttons__finish"),
            close: modal.find(".modal__close"),
            closeFinish: modal.find(".modal__close-finish"),
            cancel: modal.find(".modal__cancel")
        };
        state.buttons.each((i, el) => {
            $(el).click(e => {
                e.preventDefault();
                modalFinish.addClass("modal--active");
            });
        });
        modal.click(e => {
            e.stopPropagation();
            modal.removeClass("modal--active");
        });
        state.close.click(() => {
            modal.removeClass("modal--active");
        });
        state.closeFinish.click(() => {
            modal.removeClass("modal--active");
        });
        state.cancel.click(e => {
            e.preventDefault();
            e.stopPropagation();
            modal.removeClass("modal--active");
        });
    }
}
