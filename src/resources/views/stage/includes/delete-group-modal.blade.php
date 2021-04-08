@if (!empty($group_id))
    <section class="modal modal{{$group_id}} delete-group">
        <div class="modal__wrapper">
           <p>Ao excluir um grupo você <strong>perderá todas as informações</strong> já preenchidas e essa ação <strong>não pode ser desfeita</strong>.</p>
           <p>Deseja excluir o grupo?</p>
           <div class="modal__buttons">
{{--              <a href="{{route('stage.group.destroy', $group_id)}}" class="btn btn--black modal__delete">--}}
              <a href="#" class="btn btn--black modal__btn__delete">
                 <i class="icon-trash-alt"></i>
                 Excluir
              </a>
              <button class="btn btn--primary modal__btn__cancel">
                 cancelar
              </button>
           </div>
        </div>
     </section>
@endif
