@foreach(($group ? ($group->members('Student') ?? [0, 1, 2]) : [0, 1, 2]) as $member)
    <div class="form-item__half__wrapper form-item__half__wrapper--start box-repeater__wrapper">
        @if(isset($member->id))
            <input type="hidden" name="members[][id]" value="{{$member->id}}" required>
        @endif
        <input type="hidden" name="members[][type]" value="{{\App\Enums\GroupMemberTypeEnum::Student}}" required>
        <label class="form-group">
            <p><strong>Nome completo do(a) estudante</strong></p>
            <input type="text" name="members[][name]" value="{{$member->name ?? ''}}">
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <label class="form-group">
            <p><strong>Ano que o(a) estudante está cursando</strong></p>
            <div class="select">
                <div class="select__selected">
                    <label>{{$member->school_degree->description ?? ''}}</label>
                    <input type="hidden" name="members[][school_degree]" value="{{$member->school_degree->value ?? ''}}" readonly required>
                </div>
                <p class="form-group__error__msg">Não pode ficar em branco</p>
                <ul class="select__options">
                    @foreach($schoolDegrees as $option)
                        <li data-value="{{$option->value}}">{{$option->description}}</li>
                    @endforeach
                </ul>
            </div>
        </label>
        <label class="form-group">
            <p><strong>Idade do(a) estudante</strong></p>
            <input type="number" min="0" name="members[][age]" value="{{$member->age ?? ''}}" required>
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <label class="form-group">
            <p><strong>Telefone do(a) estudante</strong></p>
            {{--@if(isset($i) && ($i === 0))--}}
            <input type="text" name="members[][mobile_phone]" value="{{$member->mobile_phone ?? ''}}" class="phone-mask" required>
            {{--@else
                <input type="text" name="members[][mobile_phone]" value="{{$member->mobile_phone ?? ''}}" class="phone-mask">
            @endif--}}
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <button class="btn btn--small btn--lowercase btn--black box-repeater--remove">excluir estudante</button>
    </div>
@endforeach
