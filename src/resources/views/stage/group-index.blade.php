@extends('layouts.base-model')

@section('title', $title)

@section('content')

    <section class="groups">
        <div class="limit-grid">
            <div class="groups__wrapper">
                <div class="groups__title">
                    <h1>Grupo de Pesquisa</h1>
                </div>
                <div class="groups__title__buttons">
                    <a href="{{route('auth.logout')}}" class="btn btn--empty btn--small">sair @include('layouts.icons.logout')</a>
                    <a href="{{route('stage.group.create')}}" class="btn btn--primary  btn--noborder">
                        <img src="/images/groups-yellow.svg" alt=""> Criar novo grupo
                    </a>
                </div>
                <div class="groups__list">
                    @if($groups)
                        @foreach ($groups as $group)
                            <section class="groups__list__item groups__list__item--success">
                                <div class="groups__list__item__header">
                                    <p class="groups__list__item__header__title">{{$group->name}}</p>
                                    <div class="groups__list__item__header__buttons">
                                        <div class="projects__body__list__item__buttons">
                                            <a href="#" class="btn-excluir-group trash btn btn--black btn btn--small" data-group-id="{{$group->id}}">
                                                <i class="icon-trash-alt"></i> excluir grupo
                                            </a>
                                            <a href="{{route('stage.group.edit', $group->id)}}" class="edit btn btn btn--small">
                                                <i class="icon-edit"></i> Editar Grupo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="groups__list__item__body">
                                    <div class="groups__list__item__body__bar">
                                        <ul>
                                            @foreach($missions::all() as $mission)
                                                <li class="groups__list__item__body__bar__item">
                                                    <div></div>
                                                    <p>{{$mission->description}}</p>
                                                    @include('stage.includes.group.mission-card', ['group' => $group, 'mission' => $mission])
                                                </li>
                                            @endforeach()
                                            @if(date('Y-m-d') >= '2021-08-02')
                                                <li class="groups__list__item__body__bar__item groups__list__item__body__bar__item--in-progress">
                                                    <div></div>
                                                    <p>Concurso</p>
                                                    <a href="#" target="_etapa-concurso" class="groups-participate btn-concurso">Participar</a>
                                                </li>
                                            @else
                                                <li class="groups__list__item__body__bar__item groups__list__item__body__bar__item--desactived">
                                                    <div></div>
                                                    <p> Inscreva-se<br> no Concurso</p>
                                                    <a href="#" target="_blank" onClick="return false;" class="group-alert">a partir de 02/08</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="groups__list__item__footer">
                                        <div class="groups__list__item__footer__buttons">
                                            <a href="#" class="btn-excluir-group trash btn btn--black btn btn--small" data-group-id=":id">
                                                <i class="icon-trash-alt"></i>
                                                excluir grupo
                                            </a>
                                            <a href="{{route('stage.group.edit', $group->id)}}" class="edit btn btn btn--small">
                                                <i class="icon-edit"></i> Editar Grupo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @include('stage.includes.delete-group-modal', ['group_id' => $group->id])
                                {{--TODO: move modal to footer--}}
                            </section>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('stage.includes.concurso-modal')
@endsection
