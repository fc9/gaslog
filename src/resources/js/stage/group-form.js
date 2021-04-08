module.exports = {
    init: $ => {
        const resource = 'group'
        const content = $(".form__group")

        if (!content.length) {
            return
        }

        const state = {
            form: content.find("form"),
            action: content.find('input[name="action"]').val(),
            groupId: content.find('input[name="group_id"]').val(),
            formGroupRadio: content.find(".form-item__group-radio"),
            formGroup: content.find(".form-item__group"),
            buttonCreate: content.find("button.form__buttons__create"),
            buttonEdit: content.find("button.form__buttons__edit"),
        }
        const modalConfirm = $('.modal__confirm-group__submit')
        const modalGeneric = $(".modal__generic")
        const modalGenericScope = {
            title: modalGeneric.find(".modal__generic__title"),
            content: modalGeneric.find(".modal__generic__content")
        }
        // const validateEmail = email => {
        //     const expression = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([\t]*\r\n)?[\t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([\t]*\r\n)?[\t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i
        //     return expression.test(String(email).toLowerCase())
        // }
        // const validateYouTube = url => {
        //     const expression = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/
        //     if (url.match(expression)) {
        //         return url.match(expression)[1]
        //     }
        //     return false
        // }

        if (state.action === "show") {
            readonlyForm()
        }

        state.formGroupRadio.each((i, el) => {
            let input = $(el).find("input[type=radio]")
            let subiten = $(el).find(".subitens-radio")

            if (parseInt($(el).find("input[type=radio]:checked").val())) {
                subiten.show()
            }

            input.change(e => {
                if (parseInt($(e.target).val())) {
                    subiten.slideDown("slow")
                } else {
                    subiten
                        .closest(".form-item__group-radio")
                        .find(".form-group__error__msg")
                        .removeClass("active")
                    subiten.hide()
                    subiten.find("input:text").val("")
                    subiten.find("input:checkbox").prop("checked", false)
                }
            })
        })

        state.formGroup.each((i, el) => {
            let input = $(el).find(".form-item__group__input")
            let subiten = $(el).find(".subitens")

            if (input.is(":checked")) {
                subiten.show()
            }

            input.change(e => {
                if (e.target.checked) {
                    subiten.slideDown("slow")
                } else {
                    subiten.hide();
                    // subiten.find("input").val("")
                    subiten.find("input").prop("checked", false)
                }
            })
        })

        state.buttonCreate.click(event => submitForm(event))

        state.buttonEdit.click(event => submitForm(event))

        modalConfirm.click((e) => {
            e.stopPropagation()
            e.preventDefault()
            $.LoadingOverlay("show")

            const payload = formDataToPayload()
            if (!payload) {
                $.LoadingOverlay("hide")
                return false
            }

            // console.log(payload);
            // return

            //const resource = 'group'
            let request = state.action === 'create'
                ? axios.post(`/api/${resource}`, payload)
                : axios.put(`/api/${resource}/${state.groupId}`, payload)

            request
                .then((response) => {
                    //console.log(response.data)
                    window.location.href = `/${resource}`
                })
                .catch(({response}) => {
                    erroModal()
                    let {status, data} = response
                    console.log(data)
                    handleFormSubmitError(data)
                })
                .finally(() => {
                    $.LoadingOverlay("hide")
                })
        })

        function readonlyForm() {
            document
                .querySelectorAll("input, textarea")
                .forEach(el => {
                    el.setAttribute("disabled", "disabled")
                    el.readOnly = true
                })
            document
                .querySelectorAll(".select")
                .forEach(el => el.classList.add('disabled'))
        }

        function submitForm(event) {
            event.preventDefault()

            if (validation()) {
                $(".modal__confirm").addClass('modal--active')
            } else {
                $.LoadingOverlay("hide")
            }
        }

        function validation() {
            const data = formDataToPayload()
            var errors = []

            $("p.form-group__error__msg").removeClass("active")

            for (var key in data) {
                if ((key === 'name' || key === 'state' || key === 'city_id') && data[key] == '') {
                    errors.push({
                        key: key,
                        error: "Campo não pode ficar em branco"
                    });
                } else if (key === 'members') {
                    Object.entries(data['members']).forEach(([index, itens]) => {
                        if (itens['type'] === 1) {
                            Object.entries(itens).forEach(([key, value]) => {
                                if (value == '' && (key !== 'phone' || (key === 'phone' && parseInt(index) === 0))) {
                                    errors.push({
                                        key: key,
                                        error: "Campo não pode ficar em branco"
                                    })
                                }
                            })
                        } else if (itens['type'] === 2) {
                            Object.entries(itens).forEach(([key, value]) => {
                                if (value == '') {
                                    errors.push({
                                        key: key,
                                        error: "Campo não pode ficar em branco"
                                    })
                                }
                            })
                        }
                    })
                } else if (key === 'schools') {
                    var schools = data['schools']
                    Object.entries(schools).forEach(([index, itens]) => {
                        Object.entries(itens).forEach(([key, value]) => {
                            if (key === 'address') {
                                Object.entries(value).forEach(([k, val]) => {
                                    if ((k !== 'additional' && k !== 'id') && val == '') {
                                        errors.push({
                                            key: k,
                                            error: "Campo não pode ficar em branco"
                                        });
                                    }
                                })
                            } else if ((key === 'name' || key === 'type') && value == '') {
                                errors.push({
                                    key: key,
                                    error: "Campo não pode ficar em branco"
                                })
                            }
                        })
                    })
                } else if (key === 'disabilities') {
                    Object.entries(data['disabilities']).forEach(([index, value]) => {
                        if (value.id === '7' && data.others_disabilities === '') {
                            errors.push({
                                key: 'others_disabilities',
                                error: "Campo não pode ficar em branco"
                            })
                        }
                    })
                }
            }

            if (errors.length > 0) {
                console.clear()
                console.log(errors)
                erroModal()
                return false
            }

            return true
        }

        function formDataToPayload() {
            let unrequiredFields = [
                    "action",
                    "group_id"
                ],
                data = state.form.serializeJSON()

            for (var key in data) {
                if (unrequiredFields.includes(key)) {
                    delete data[key]
                } else if (key === 'schools') {
                    Object.entries(data['schools']).forEach(([index, itens]) => {
                        Object.entries(itens).forEach(([i, val]) => {
                            if (unrequiredFields.includes(i)) {
                                delete data['schools'][index][i]
                            }
                        })
                    })
                } //else if (key === 'disabilities') {
                //     Object.entries(data[key]).forEach(([index, itens]) => {
                //         Object.entries(itens).forEach(([i, val]) => {
                //             console.log(data[key][index][i])
                //             //delete data[key][index][i]
                //         })
                //     })
                // }
            }
            //console.log(data)
            return data
        }

        function erroModal() {
            modalGenericScope.content.html(`<p>Algumas informações estão incorretas. <br> Por favor, confira para continuar. </p>`)
            modalGeneric.addClass("modal--active")
        }

        function handleFormSubmitError(data) {
            let msgErros = JSON.parse(data.message)

            for (let prop in msgErros) {
                // Quebra erro com ponto
                const arrField = prop.split(".")

                const fieldName = arrField[0]
                const position = arrField[1] ?? 0
                const key = arrField[2] ?? ""

                let field = null

                // Customização para unico campo diferente do formulario
                if (position) {
                    field =
                        $(`[name="${fieldName}[][${key}]"]`).get(position) ??
                        $(`[name="${fieldName}[][${key}]"]`)
                } else {
                    field = $(`[name^="${fieldName}"`)
                }

                const wrapper = $(field)
                    .closest(".form-group")
                    .addClass("form-group__error")
                let error = $(wrapper)
                    .find(".form-group__error__msg")
                    .first()
                    .addClass("active")
                    .text(msgErros[prop].join())
            }
        }

    },

    modal: $ => {
        const page = $(".form__group")
        const modal = $(".modal")
        const modalFinish = $(".modal__finish-subscription")
        const state = {
            buttons: page.find(".form__buttons__finish"),
            close: modal.find(".modal__close"),
            closeFinish: modal.find(".modal__close-finish"),
            cancel: modal.find(".modal__cancel")
        }
        state.buttons.each((i, el) => {
            $(el).click(e => {
                modalFinish.addClass("modal--active")
            })
        })
        modal.click(e => {
            e.stopPropagation()
            modal.removeClass("modal--active")
        })
        state.close.click(() => {
            modal.removeClass("modal--active")
        })
        state.closeFinish.click(() => {
            modal.removeClass("modal--active")
        })
        state.cancel.click(e => {
            e.preventDefault()
            e.stopPropagation()
            modal.removeClass("modal--active")
        })
    }
}
