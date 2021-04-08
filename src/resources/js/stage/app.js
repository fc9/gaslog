require('../bootstrap');

var jQuery = require('jquery');
require('../axios');
require('gasparesganga-jquery-loading-overlay');
require('jquery-serializejson');
require('jquery-mask-plugin');

var oAuth = require('../oAuth/oAuth');
var login = require('./auth/login');
var register = require('./auth/register');
var forgotPassword = require('./auth/forgotPassword');
var resetPassword = require('./auth/resetPassword');
var header = require('./header');
var project = require('./project');
var selects = require('./selects');
var checks = require('./checks');
var boxRepeater = require('./boxRepeater');
var textarea = require('./textarea');
var upload = require('./upload');
var erros = require('./erros');
var cities = require('./cities');
var cep = require('./cep');
var masks = require('./masks');
var applied = require('./applied');
var dropdown = require('./dropdown');
var groupForm = require('./group-form');
var addMission = require('./addMission');
var group = require('./group');

jQuery(document).ready($ => {
    const $window = $(window);
    $.LoadingOverlaySetup({ background: 'rgba(0, 0, 0, 0.5)' });
    oAuth.init(document, window);
    login.init($, window.axios);
    register.init($);
    forgotPassword.init($);
    resetPassword.init($);
    header.init($);
    project.init($);
    selects.init($);
    checks.init($);
    boxRepeater.init($);
    textarea.init($);
    upload.init($);
    groupForm.init($);
    groupForm.modal($);
    addMission.init($);
    addMission.modal($);
    group.modal($);
    erros.init($);
    cities.init($);
    cep.init($, window.axios);
    masks.init($);
    applied.init($);
    dropdown.init($);
});