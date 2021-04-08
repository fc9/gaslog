module.exports = {
   init: ($) => {
      const resource = 'project'
      const page = $('.projects')
      const modal = $('.modal.delete')
      const modalPlan = $('.modal.new-plan')
      const state = {
         deleteButtons: page.find('.btn-excluir'),
         newPlanBtn: page.find('.projects__new-plan'),
         close: modal.find('.modal__close'),
         closeImport: modalPlan.find('.modal__close-import'),
         wrapper: modal.find('.modal__wrapper')
      };

      state.deleteButtons.each((i, el) => {
         $(el).click((e) => {
            e.preventDefault();
            modal.addClass('modal--active');

            const { projectId } = e.currentTarget.dataset;

            modal.find('.btn--black').click(() => {
               axios.delete(`/api/${resource}/${projectId}`)
                  .then(response => window.location.href = `/${resource}`)
                  .catch(({ response }) => console.error(response));
            });
         });
      });

      modal.click((e) => {
         e.preventDefault()
         modal.addClass('modal--active')
      });
      state.wrapper.click((e) => {
         e.stopPropagation();
      });
      state.close.click((e) => {
         modal.removeClass('modal--active')
      });

      state.newPlanBtn.click((e) => {
         e.preventDefault();
         modalPlan.addClass('modal--active');
      });
      state.closeImport.click((e) => {
         e.preventDefault();
         modalPlan.removeClass('modal--active');
      });
   }
}
