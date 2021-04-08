<section class="modal modal__generic modal-concurso">
    <div style="max-width: 5500px;" class="modal__wrapper">
       <div class="modal__generic__content ">
        <p><strong>Parabéns! Você completou esta etapa.</strong></p>
        <p>Clique abaixo e inscreva-se no Concurso 2021.</p>
        <p><strong style="color: red !important">Será necessário fazer um novo cadastro.</strong></p>
        <p>Use o <strong style="color: red !important">{{(Auth::user()->provider) ? Auth::user()->provider : 'email'}}</strong> para se cadastrar na próxima etapa.</p>
       </div>
       <div class="modal__buttons modal__buttons--column">
          <a href="#" target="_etapa-concurso" class="btn btn--primary">Inscrever meu Plano na Concurso</a>
          <button class="btn btn--black modal__close-concurso">
             Voltar
          </button>
       </div>
    </div>
 </section>
