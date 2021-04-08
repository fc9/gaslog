module.exports = {
   init: ($) => {

      var SPMaskBehavior = function (val) {
         return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
       },
       spOptions = {
         onKeyPress: function(val, e, field, options) {
             field.mask(SPMaskBehavior.apply({}, arguments), options);
           }
       };

       $('.cep-mask').mask('00000-000');
       $('.phone-mask').mask(SPMaskBehavior, spOptions);

      $("form").on("click",".box-repeater--add", () => {

         $('.cep-mask').mask('00000-000');   
         $('.phone-mask').mask(SPMaskBehavior, spOptions);

      });

      $('.number-mask').mask('9999');
   }
}