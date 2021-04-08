module.exports = {
   init: ($) => {

      var url = '';
      const page = $('.register');
      var payload = {};

      const state = {
         radios: page.find('input[type="radio"]'),
         content: page.find('.create__content'),
         submitButton: page.find('form button[type="submit"]'),
         facebookProvider: page.find('a[id="facebookProvider"]'),
         googleProvider: page.find('a[id="googleProvider"]'),
         create: () => {

            $.LoadingOverlay("show");

            axios.post( url, payload)
            .then((response) => {
               window.location.href = "/group"
            })
            .catch(({ response  }) => {
               const { status, data } = response;

               const errors = JSON.parse(data.message);

               Object.keys(errors).forEach( (key, index) => {

                  page.find(`input[name="${key}"]`).next().addClass("active").html(`${errors[key]}`);

               });

            })
            .finally( (response) => {
               $.LoadingOverlay("hide");
            });
         }
      };

      state.radios.change((e) => {
         let checked = page.find('input[type="radio"]:checked')
         if (checked.length) {
            state.content.removeClass('create__wrapper--disabled')
         }
      });

      const validateEmail = (email) => {
         const expression = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([\t]*\r\n)?[\t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([\t]*\r\n)?[\t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
         return expression.test(String(email).toLowerCase())
      }

      state.submitButton.click(event => {

         event.preventDefault();

         url = 'api/auth/signup';

         payload = {
            email: page.find('input[name="email"]').val(),
            email_confirmation: page.find('input[name="confirm_email"]').val(),
            password: page.find('input[name="password"]').val().trim(),
            password_confirmation: page.find('input[name="confirm_password"]').val().trim(),
            role: page.find('input[name="role"]:checked').val()
         };

         page.find('input[name="email"]').next().removeClass("active");
         page.find('input[name="confirm_email"]').next().removeClass("active");
         page.find('input[name="password"]').next().removeClass("active");
         page.find('input[name="confirm_password"]').next().removeClass("active");

         let erro = false;

         if (!payload.email) {
            page.find('input[name="email"]').next().addClass("active").html("O campo email é obrigatório");
            erro = true
         }
         else if (!validateEmail(payload.email)) {
            page.find('input[name="email"]').next().addClass("active").html("O campo email é inválido");
            erro = true
         }

         if (!payload.email_confirmation) {
            page.find('input[name="confirm_email"]').next().addClass("active").html("O campo confirmar email é inválido");
            erro = true
         }

         if (payload.email !== payload.email_confirmation) {
            page.find('input[name="confirm_email"]').next().addClass("active").html("O campo email e confirmar email devem ser iguais");
            erro = true
         }

         if (!payload.password) {
            page.find('input[name="password"]').next().addClass("active").html("O campo senha é obrigatório");
            erro = true
         }

         else if ( payload.password.length < 6 ) {
            page.find('input[name="password"]').next().addClass("active").html("O campo senha deve ter mais de 6 caracteres");
            erro = true
         }

         if (!payload.password_confirmation) {
            page.find('input[name="confirm_password"]').next("active").addClass().html("O campo confirmar senha é obrigatório");
            erro = true
         }

         if (!payload.password !== !payload.password_confirmation) {
            page.find('input[name="confirm_password"]').next("active").addClass().html("O campo senha e confirmar senha devem ser iguais");
            erro = true
         }

         if(!payload.role) {
            window.alert("Selecione uma opção");
            erro = true
         }

         if(!erro) {
            state.create();
         }

      });

      state.facebookProvider.click(event => {

         event.preventDefault();

         url = 'api/auth/signup/facebook';

         payload = {
            role: page.find('input[name="role"]:checked').val()
         };

         if( !payload.role ) {
            return window.alert("Seleção de estudante/educador(a) é obrigatório.");
         }
         else {

            window.FB.login( (response) => {

               if ( response.status === 'connected' && response.authResponse ) {

                  window.FB.api('/me', {fields: 'id, name, email'}, (response) => {

                     payload.id    = response.id;
                     payload.name  = response.name;
                     payload.email = response.email;

                     state.create();

                  });
               } else {
                  alert("Para cadastrar-se você precisa autorizar o aplicativo.");
               }
            }, {scope:'email', return_scopes: true} );

         }
      })

      state.googleProvider.click(event => {

         event.preventDefault();

         url = 'api/auth/signup/google';

         payload = {
            role: page.find('input[name="role"]:checked').val()
         };

         if( !payload.role ) {
            return window.alert("Seleção de estudante/educador(a) é obrigatório.");
         }
         else {

            // API call for Google login
            gapi.auth2.getAuthInstance().signIn().then(
               function(googleUser) {

                  var profile = googleUser.getBasicProfile();

                  payload.id = profile.getId()
                  payload.name = profile.getName()
                  payload.email = profile.getEmail()

                  state.create()
               },
               function(error) {
                  console.log(error)
               }
            );

         }

     });

   }
}
