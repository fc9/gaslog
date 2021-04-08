module.exports = {
   init: ($) => {
      const page = $('.reset-password')
      const modal = $('.modal')
      const state = {
         buttons: page.find('.btn-send'),
         close: modal.find('.modal__close'),
         wrapper: modal.find('.modal__wrapper'),
         submitButton: page.find('button[type="submit"]'),
         redirectTo: '/login'
      };

      state.wrapper.click((e) => {
         e.stopPropagation()
      })

      state.close.click((e) => {
         modal.removeClass('modal--active')

         window.location.href = state.redirectTo;
      })

      state.submitButton.click(event => {
         event.preventDefault();

         page.find('input[name="password"]').next().removeClass("active").html("")

         const payload = {
             password: page.find('input[name="password"]').val().trim(),
             password_confirmation: page.find('input[name="password_confirmation"]').val().trim(),
             token: page.find('input[name="token"]').val().trim()
         };

         if (!payload.password || !payload.password_confirmation) {
            page.find('input[name="password"]').next().addClass("active").html("Senha e confirmação de senha são obrigatórios");
         }
         else if ( payload.password.length < 6 ) {
            page.find('input[name="password"]').next().addClass("active").html("A senha deve possuir mais de 6 caracteres");
         }
         else if ( payload.password !== payload.password_confirmation) {
            page.find('input[name="password"]').next().addClass("active").html("Senha e confirmação de senha não conferem");
         }
         else if ( payload.token == "" ) {
            return window.alert("Token é obrigatório");
         }
         else {

            state.submitButton.html("Salvando ...").prop("disabled",true).css("cursor","not-allowed").fadeTo("fast",0.4)

            axios.post('/api/auth/password/reset', payload)
            .then((response) => {

               page.find('input[name="password"]').val("");
               page.find('input[name="password_confirmation"]').val("");

               modal.addClass('modal--active')

               setTimeout( () => { window.location.href = state.redirectTo }, 5000) ;
               //
            })
            .catch(({ response  }) => {
               const { status, data } = response;

               const errors = JSON.parse(data.message);

               Object.keys(errors).forEach( (key, index) => {

                  page.find(`input[name="${key}"]`).next().addClass("active").html(`${errors[key]}`);

               });
            }).finally( () => {
               state.submitButton.html("Salvar").prop("disabled",false).css("cursor","pointer").fadeTo("fast",1);
            });

         }
      })


   }
}
