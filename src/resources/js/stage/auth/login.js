module.exports = {
    init: ($, axios) => {
        const page = $(".login")
        const validateEmail = (email) => {
            const expression = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([\t]*\r\n)?[\t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([\t]*\r\n)?[\t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i
            return expression.test(String(email).toLowerCase())
        }
        var url = ''
        var payload = {}
        const state = {
            submitButton: page.find('form button[type="submit"]'),
            facebookProvider: page.find('a[id="facebookProvider"]'),
            googleProvider: page.find('a[id="googleProvider"]'),
            emailField: page.find('input[name="email"]'),
            passwordField: page.find('input[name="password"]'),
            modal: $('.modal__generic'),
            login: () => {

                $.LoadingOverlay("hide")

                axios.post(url, payload)
                .then((response) => {
                    //console.log(response, response.data)
                    window.location.href = `/${response.data['redirectTo'] ? response.data['redirectTo'] : 'group'}`
                })
                .catch(({ response  }) => {
                    const { status, data } = response
                    console.log(data)

                    // validação Google
                    if(data.message === 'Você ainda não possui uma conta cadastrada.'){
                        return window.location.href = `/register`
                    }

                    let message = data.message.includes("{") ? JSON.parse(data.message) : data.message

                    page.find(`input[name="email"]`)
                        .next()
                        .addClass("active")
                        .html(data.message.includes("{") ? Object.values(message).join() :  data.message)

                })
                .finally( () => {
                    $.LoadingOverlay("hide")
                });
            }
        }
        const modalGeneric =  $('.modal__generic')
        const modalScope = {
            title: modalGeneric.find('.modal__generic__title'),
            content: modalGeneric.find('.modal__generic__content'),
        }

        state.submitButton.click(event => {

            event.preventDefault();

            state.emailField.next().removeClass("active")
            state.passwordField.next().removeClass("active")

            //url = "/api/auth/login"
            url = "/api/auth/signin"

            payload = {
                email: state.emailField.val(),
                password: state.passwordField.val()
            }

            if (!payload.email && !payload.password ) {
                state.emailField.next().addClass("active").html("Campo obrigatório")
                state.passwordField.next().addClass("active").html("Campo obrigatório")
            }
            if (!payload.email ) {
                state.emailField.next().addClass("active").html("Campo obrigatório")
            }
            else if (!payload.password ) {
                state.passwordField.next().addClass("active").html("Campo obrigatório")
            }
            else if (!validateEmail(payload.email)) {
                state.emailField.next().addClass("active").html("Campo e-mail inválido")
            }
            else {
                state.login()
            }

        })

        state.facebookProvider.click(event => {

            event.preventDefault()

            url = '/api/auth/login/facebook'

            window.FB.login( (response) => {

                if ( response.status === 'connected' && response.authResponse ) {

                    window.FB.api('/me', {fields: 'id, name, email'}, (response) => {

                    payload.id    = response.id
                    payload.name  = response.name
                    payload.email = response.email

                    state.login()

                    })
                } else {
                    modalScope.content.html(`<p>Falha ao cadastrar-se pelo aplicativo</p>`)
                    modalGeneric.addClass("modal--active")
                }
            }, {scope:'email', return_scopes: true} )

        });

        state.googleProvider.click(event => {

            event.preventDefault()

            url = '/api/auth/login/google'

            // API call for Google login
            gapi.auth2.getAuthInstance().signIn().then(
                function(googleUser) {

                    var profile = googleUser.getBasicProfile()

                    payload.id = profile.getId()
                    payload.name = profile.getName()
                    payload.email = profile.getEmail()

                    state.login()
                },
                function(error) {
                    modalScope.content.html(`<p>Falha ao cadastrar-se pelo aplicativo</p>`)
                    modalGeneric.addClass("modal--active")
                }
            )

        })
    }
}
