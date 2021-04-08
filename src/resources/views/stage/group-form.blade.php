@extends('layouts.base-model')

@section('title', $title)

@section('content')
    <section class="groups groups--new">
        <main class="form__group">
            <div class="limit-grid">

                {{-- header --}}
                <div class="groups__header">
                    <h1><span class="labels">{{$title}}</span></h1>
                </div>

                {{-- form --}}
                <div class="limit-grid2">
                    <form class="form" method="post" autocomplete="off">

                        <input type="hidden" name="action" value="{{$action}}" disabled>
                        <input type="hidden" name="group_id" value="{{$group->id ?? ''}}" disabled>

                        <section class="form-item form-group">
                            <h4 class="mb-0">Nome do grupo:</h4>
                            <p style="font-weight: normal;">Crie um nome que represente sua equipe em até 4 palavras<br>
                                (Exemplos: Todos contra os preconceitos, Cuidando da nossa cidade, entre outros)</p>
                            <input type="text" name="name" value="{{$group->name ?? ''}}" required>
                            <p class="form-group__error__msg">Não pode ficar em branco</p>
                            <div class="form-item__state stateCityWrapper">
                                <div class="form-item__state__item">
                                    <p><strong>Estado</strong></p>
                                    <div class="select states select--filter">
                                        <div class="select__selected">
                                            <label>{{isset($group->address->city) ? $group->address->city->state : ''}}</label>
                                            <input type="hidden" name="state" value="{{isset($group->address->city) ? $group->address->city->state : ''}}" readonly
                                                   required>
                                        </div>
                                        <p class="form-group__error__msg">Não pode ficar em branco</p>
                                        <ul class="select__options">
                                            <input type="text" placeholder="Buscar por...">
                                            @foreach ($states as $state)
                                                <li data-value="{{$state->state}}">{{$state->state}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-item__state__item">
                                    <p><strong>Cidade</strong></p>
                                    <div class="select cities select--filter disabled">
                                        <div class="select__selected">
                                            <label>{{isset($group->address->city) ? $group->address->city->name : ''}}</label>
                                            <input type="hidden" name="city_id" class="city_id"
                                                   value="{{isset($group->address->city)  ? $group->address->city->id : ''}}"
                                                   readonly required>
                                        </div>
                                        <p class="form-group__error__msg">Não pode ficar em branco</p>
                                        <ul class="select__options">
                                            <input type="text" placeholder="Buscar por...">
                                            @if($group && $group->city)
                                                @foreach($cities as $city)
                                                    <li data-value="{{$city->id}}">{{$city->name}}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="form-item students">
                            <h4>Estudantes integrantes do grupo</h4>
                            <p>(Inclua os dados de, no mínimo, 3 crianças e/ou adolescentes que fazem parte do grupo)</p>
                            <p><strong>Atenção:</strong> é necessário informar o telefone (fixo ou celular) de pelo
                                menos um(a) integrante do grupo.</p>
                            <div class="form-item__half box-repeater box-repeater--student {{$action !== 'show' ? 'spaced' : ''}}">
                                @include('stage.includes.group.student', compact('group'))
                                @if ($action !== 'show')
                                    <button class="btn btn--red btn--small btn--lowercase box-repeater--add">adicionar estudante</button>
                                @endif
                            </div>
                        </section>

                        <section class="form-item educators">
                            <h4>Educadores(as) e/ou adultos(as) responsáveis</h4>
                            <p>Caso mais de uma pessoa tenha contribuído com a orientação/acompanhamento do grupo,
                                clique no botão “Adicionar educador(a)” para preencher seus dados.</p>
                            <div class="form-item__half box-repeater {{$action !== 'show' ? 'spaced' : ''}}">
                                @include('stage.includes.group.educator', compact('group'))
                                @if (!$action !== 'show')
                                    <button class="btn btn--red btn--small btn--lowercase box-repeater--add">
                                        adicionar educador(a)
                                    </button>
                                @endif
                            </div>
                        </section>

                        <section class="form-item section-school schools">
                            <h4>Dados da escola/organização em que o projeto foi realizado</h4>
                            <p>Caso esse projeto envolva integrantes de mais de uma escola ou organização, clique em "Adicionar mais uma escola" para preencher os dados
                                da nova instituição.</p>
                            <div class="box-repeater">
                                @include('stage.includes.group.school', compact('group', 'schoolReligiousTypes', 'states'))
                                @if ($action !== 'show')
                                    <button class="btn btn--red btn--small btn--lowercase box-repeater--add ">adicionar mais uma escola</button>
                                @endif
                            </div>
                        </section>

                        <section class="form-item form-group form-item__group-radio">
                            <h4>O grupo participou do Desafio 2020?</h4>
                            <div class="radio-check">
                                <label>
                                    <input type="radio" class="form-item__group-radio__input" name="has_participation" value="1" {{$hasParticipation ? 'checked' : ''}}>
                                    <span></span>
                                    <p>Sim</p>
                                </label>
                                <div class="subitens-lastChallengeXXX subitens-radio" style="display: none">
                                    <div class="checkbox-check">
                                        <label>
                                            <input type="hidden" name="previous_participant" value="0">
                                            <input type="checkbox" name="previous_participant" value="1"
                                                    {{isset($group->previous_participant) && $group->previous_participant ? 'checked' : ''}}>
                                            <span></span>
                                            <p>Participamos da última edição, em 2020</p>
                                        </label>
                                        <label>
                                            <input type="hidden" name="recurring_participant" value="0">
                                            <input type="checkbox" name="recurring_participant" value="1"
                                                    {{isset($group->recurring_participant) && $group->recurring_participant ? 'checked' : ''}}>
                                            <span></span>
                                            <p>Participamos de alguma(s) das edições anteriores à pandemia (2015 a 2019)</p>
                                        </label>
                                    </div>
                                </div>
                                <label>
                                    <input type="radio" class="form-item__group-radio__input" name="has_participation" value="0" {{$hasParticipation ? '' : 'checked'}}>
                                    <span></span>
                                    <p>Não</p>
                                </label>
                            </div>
                        </section>

                        <section class="form-item__group">
                            <div class="radio-check">
                                <label>
                                    <input type="checkbox" class="form-item__group__input" name="has_disability" value="1" {{$hasDisability ? 'checked' : ''}}>
                                    <span></span>
                                    <p><strong>Clique aqui caso o projeto tenha a participação de algum(a) estudante com deficiência</strong></p>
                                </label>
                            </div>
                            <section class="subitens" style="margin-top: -20px">
                                <p style="font-weight: normal">Caso tenha selecionado a opção acima, especifique qual é ou quais são o(s) tipo(s) de deficiência:</p>
                                <p class="form-group__error__msg">Não pode ficar em branco</p>
                                <div class="checkbox-check form-item__half mt-4 pt-2">
                                    <div class="form-item__half__wrapper form-item__half__wrapper--hgap">
                                        @foreach ($disabilities as $disability)
                                            @if ($disability->type == 'checkbox')
                                                <label>
                                                    <input type="checkbox" name="disabilities[][id]" value="{{$disability->id}}"
                                                            {{$group && $group->hasDisability($disability->id) ? 'checked': ''}}>
                                                    <span></span>
                                                    <p>{{$disability->name}}</p>
                                                </label>
                                            @else
                                                <label class="wrap">
                                                    <input type="checkbox" name="disabilities[][id]" value="{{$disability->id}}"
                                                            {{$group && $group->hasDisability($disability->id) ? 'checked': ''}}>
                                                    <span></span>
                                                    <p>{{$disability->name}}</p>
                                                    <input type="text" name="others_disabilities" placeholder="Quais?"
                                                           value="{{$group->others_disabilities ?? ''}}">
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </section>

                        <section class="form__buttons">
                            <div></div>
                            <button type="submit" class="btn btn--red form__buttons__{{$action}}">{{$title}}</button>
                        </section>

                    </form>
                </div>

            </div>
        </main>
    </section>

    @include('stage.includes.modals.group-create-confirm')
    @include('stage.includes.modals.generic')
@endsection

