var selects = require('./selects');
module.exports = {
   init: ($) => {
      const radio = $('.radio-check')
      const checkbox = $('.checkbox-check--limited')

      radio.each((i, el) => {
         const radios = $(el).find('input[type="radio"]')
         const checked = $(el).find('input[type="radio"]:checked')
         radios.change((e) => {
            let checked = $(el).find('input[type="radio"]:checked')
            if (checked.length) {
               $(el).addClass('actived')
            } else {
               $(el).removeClass('actived')
            }
         })
         if (checked.length) {
            $(el).addClass('actived')
         } 
      })

      checkbox.each((i, el) => {
         const limit = $(el).data('limit')
         const checkboxs = $(el).find('input[type="checkbox"]')
         const checked = $(el).find('input[type="checkbox"]:checked')
         checkboxs.change((e) => {
            let checked = $(el).find('input[type="checkbox"]:checked')
            if (checked.length > limit) {
               e.target.checked = false;
            } else if (checked.length == limit) {
               $(el).addClass('actived')
            } else {
               $(el).removeClass('actived')
            }
         })
         if (checked.length) {
            $(el).addClass('actived')
         } 
         if (checked.length == limit) {
            $(el).addClass('actived')
         } else {
            $(el).removeClass('actived')
         }
      })
   }
}