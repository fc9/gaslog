@foreach(($group ? ($group->schools ?? [0]) : [0]) as $school)
    <div class="form-item__escola box-repeater__wrapper stateCityWrapper">
        @if(isset($school->id))
            <input type="hidden" name="schools[][id]" value="{{$school->id}}" required>
            <input type="hidden" name="schools[][address][id]" value="{{$school->address->id ?? ''}}" required>
        @endif
        <label class="form-item__escola--nome form-group">
            <p><strong>Nome completo:</strong></p>
            <input type="text" name="schools[][name]" value="{{$school->name ?? ''}}" required>
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <label class="form-item__escola--tipo form-group">
            <p><strong>Tipo:</strong></p>
            <div class="select select--schools">
                <div class="select__selected">
                    <label>{{$school->type->description ?? ''}}</label>
                    <input type="hidden" name="schools[][type]" value="{{$school->type->value ?? ''}}" readonly required>
                </div>
                <p class="form-group__error__msg">Não pode ficar em branco</p>
                <ul class="select__options select__options--schools">
                    @foreach($schoolTypes as $option)
                        <li data-value="{{$option->value}}">{{$option->description}}</li>
                    @endforeach
                </ul>
            </div>
        </label>
        <label class="form-item__escola--subtipo form-group select__options--schools-subitem" style="{{$school && $school->school_religious_type ? 'display:inline' : 'display:none'}}">
            <p>
                <strong>Caso sua escola/ONG seja confessional ou religiosa, selecione alguma das opções abaixo. Caso
                    contrário selecione "Não somos confessional, nem religiosa"</strong>
            </p>
            <div class="select select__options__schools-type">
                <div class="select__selected">
                    <label>{{$school && $school->school_religious_type ? $school->school_religious_type->name : ''}}</label>
                    <input type="hidden" name="schools[][school_religious_type_id]"
                           value="{{$school && $school->school_religious_type ? $school->school_religious_type->id : ''}}"
                           readonly required>
                </div>
                <p class="form-group__error__msg">Não pode ficar em branco</p>
                <ul class="select__options">
                    @foreach ($schoolReligiousTypes as $schoolReligiousType)
                        <li data-value="{{$schoolReligiousType->id}}">{{$schoolReligiousType->name}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group form-group__schools-type">
                <input type="text" name="schools[][other_school_religious_type]"
                       value="{{$school ? $school->other_school_religious_type : ''}}" placeholder="Qual?">
                <p class="form-group__error__msg">Não pode ficar em branco</p>
            </div>
        </label>
        <label class="form-item__escola--cep form-group">
            <p><strong>CEP:</strong></p>
            <input type="text" name="schools[][address][zipcode]" class="cepField cep-mask" value="{{$school->address->zipcode ?? ''}}" required>
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <label class="form-item__escola--estado form-group">
            <p><strong>Estado:</strong></p>
            <div class="select cep_states states">
                <div class="select__selected">
                    <label>{{isset($school->address->city) ? $school->address->city->state : ''}}</label>
                    <input type="hidden" name="schools[][address][state]" value="{{isset($school->address->city) ? $school->address->city->state : ''}}" readonly
                           required>
                </div>
                <p class="form-group__error__msg">Não pode ficar em branco</p>
                <ul class="select__options">
                    @foreach ($states as $state)
                        <li data-value="{{$state->state}}">{{$state->state}}</li>
                    @endforeach
                </ul>
            </div>
        </label>
        <label class="form-item__escola--cidade form-group">
            <p><strong>Cidade:</strong></p>
            <div class="select cep_cities cities disabled">
                <div class="select__selected">
                    <label>{{isset($school->address->city) ? $school->address->city->name : ''}}</label>
                    <input type="hidden" name="schools[][address][city_id]" class="city_id" value="{{isset($school->address->city) ? $school->address->city_id : ''}}"
                           readonly required>
                </div>
                <p class="form-group__error__msg">Não pode ficar em branco</p>
                <ul class="select__options">
                </ul>
            </div>
        </label>
        <label class="form-item__escola--endereco form-group">
            <p><strong>Endereço:</strong></p>
            <input type="text" name="schools[][address][address]" class="schoolAdress" value="{{$school->address->address ?? ''}}" required>
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <label class="form-item__escola--numero form-group">
            <p><strong>Numero:</strong></p>
            <input type="text" name="schools[][address][number]" value="{{$school->address->number ?? ''}}" required>
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <label class="form-item__escola--complemento form-group">
            <p><strong>Complemento:</strong></p>
            <input type="text" name="schools[][address][additional]" value="{{$school->address->additional ?? ''}}">
        </label>
        <label class="form-item__escola--telefone form-group">
            <p><strong>Telefone:</strong></p>
            <input type="text" name="schools[][phone]" value="{{$school->phone ?? ''}}" class="phone-mask" required>
            <p class="form-group__error__msg">Não pode ficar em branco</p>
        </label>
        <button class="btn btn--small btn--lowercase btn--empty-black box-repeater--remove ">excluir escola</button>
    </div>
@endforeach
