@foreach(($group ? ($group->members('Educator') ?? [0]) : [0]) as $member)
    <div class="form-item__half__wrapper box-repeater__wrapper">
        @if(isset($member->id))
            <input type="hidden" name="members[][id]" value="{{$member->id}}" required>
        @endif
        <input type="hidden" name="members[][type]" value="{{\App\Enums\GroupMemberTypeEnum::Educator}}" required>
        <label class="form-group form-group--start">
            <p><strong>Nome completo do(a) educador(a)</strong></p>
            <input type="text" name="members[][name]" value="{{$member->name ?? ''}}">
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <label class="form-group form-group--start">
            <p><strong>E-mail do(a) educador(a)</strong></p>
            <input type="email" name="members[][email]" value="{{$member->email ?? ''}}" required>
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <label class="form-group form-group--topMargin">
            <p><strong>Telefone do(a) educador(a)</strong></p>
            <input type="text" name="members[][phone]" value="{{$member->phone ?? ''}}" class="phone-mask"
                   required>
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <label class="form-group">
            <p>
                <strong>Celular do(a) educador(a)</strong>
                <small>(De preferência vinculado ao whatsapp)</small>
            </p>
            <input type="text" name="members[][mobile_phone]" value="{{$member->mobile_phone ?? ''}}"
                   class="phone-mask" required>
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <button class="btn btn--empty-black btn--small btn--lowercase box-repeater--remove">excluir educador(a)
        </button>
    </div>
@endforeach
