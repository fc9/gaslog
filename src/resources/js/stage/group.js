module.exports = {
    modal: $ => {
        const resource = 'group'
        const page = $(".groups")
        const state = {
            btnExcluir: page.find(".btn-excluir-group")
        }
        const award = {
            modal: $(".modal.modal-concurso"),
            button: $(".btn-concurso"),
            close: $(".modal__close-concurso")
        }

        state.btnExcluir.each((i, el) => {
            $(el).click(e => {
                e.preventDefault()

                const {groupId} = e.currentTarget.dataset
                const section = $($(e)[0].target).closest('section')
                const modal = section.find('.delete-group')

                modal.addClass("modal--active")

                modal.find('.modal__btn__delete').click(e => {
                    e.preventDefault()
                    axios.delete(`/api/${resource}/${groupId}`)
                        .then(response => {
                            console.log(response.data)
                            section.remove()
                            modal.removeClass("modal--active")
                        })
                        .catch(({response}) => console.error(response))
                })

                modal.find('.modal__btn__cancel').click(e => {
                    e.stopPropagation()
                    e.preventDefault()
                    modal.removeClass("modal--active")
                })
            })
        })

        award.button.click(e => {
            e.preventDefault();
            award.modal.addClass("modal--active");
        });

        award.close.click(e => {
            e.preventDefault();
            award.modal.removeClass("modal--active");
        });
    }
};
