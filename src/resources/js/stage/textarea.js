module.exports = {
   init: ($) => {
      const textareas = $('.form-item__textarea')

      textareas.each((i, el) => {
         const scope = {
            textarea: $(el).find('textarea'),
            limit: $(el).find('textarea').attr('maxlength'),
            counter: $(el).find('span'),
         };

         scope.textarea.keyup((e) => {
            let written = scope.textarea.val().length
            let remain = parseInt(scope.limit - written)
            scope.counter.text(remain)
            if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
               scope.textarea.val((scope.textarea.val()).substring(0, written - 1))
            }

         })
      })

   }
}