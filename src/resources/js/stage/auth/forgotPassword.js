module.exports = {
   init: ($) => {
      const page = $('.forgot-password')
      const modal = $('.modal')
      const state = {
         buttons: page.find('.btn-send'),
         close: modal.find('.modal__close'),
         wrapper: modal.find('.modal__wrapper'),
         submitButton: page.find('button[type="submit"]'),
      };

      state.wrapper.click((e) => {
         e.stopPropagation()
      })

      state.close.click((e) => {
         modal.removeClass('modal--active')
      })

      state.submitButton.click(event => {
         event.preventDefault();

         url = "/api/auth/login"

         const payload = {
             email: page.find('input[name="email"]').val(),
         };

         if (!payload.email) {
            page.find('input[name="email"]').next().addClass("active").html("Email é obrigatório.");
         }
         else {

            state.submitButton.html("Enviando ...").prop("disabled",true).css("cursor","not-allowed").fadeTo("fast",0.4)

            axios.post('api/auth/password/restore', payload)
            .then((response) => {

               page.find('input[name="email"]').val("");

               modal.addClass('modal--active')
               //
            })
            .catch(({ response  }) => {

               const { status, data } = response;

               const errors = JSON.parse(data.message);

               Object.keys(errors).forEach( (key, index) => {

                  page.find(`input[name="${key}"]`).next().addClass("active").html(`${errors[key]}`);

               });

            }).finally( () => {
               state.submitButton.html("Enviar").prop("disabled",false).css("cursor","pointer").fadeTo("fast",1);
            });

         }
      })


   }
}
