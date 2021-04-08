module.exports = {

    init: ($,window) => {

        module.exports.initFacebook(window);
        module.exports.initGoogle();
    },

    initFacebook: (window) => {

        window.fbAsyncInit = function() {
            window.FB.init({
                appId: '429641184052945', //You will need to change this
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v7.0'
            });
        };
    },

    initGoogle: () => {

        gapi.load('auth2', function() {

            gapi.auth2.init({
              client_id: '512129273060-p3l6sviaj37465p610i7s3h382ok0ls9.apps.googleusercontent.com',
              cookiepolicy: 'single_host_origin',
              scope: 'email profile openid'
            });

        });
    }
};