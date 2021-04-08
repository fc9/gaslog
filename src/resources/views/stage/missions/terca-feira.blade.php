@extends('layouts.base-model ')

@section('title', $missionEnum->description)

@section('content')
    <div class="missao">
        <div class="limit-grid">
            <div class="missao__title">
                <h4>Grupo de Pesquisa</h4>
                <h2>{{$missionEnum->description}}</h2>
            </div>

            <div class="missao__wrapper" id="carregaMissao">
                <div class="missao__content">
                    <p>Formado o grupo, agora é hora de <strong>conversar com os colegas para escolher um problema ou tema</strong> que vocês querem começar a transformar ou melhorar ainda mais. </p>
                    <p>Para cumprir esta missão, vocês devem <strong>responder 3 perguntas no formulário abaixo</strong>. Uma delas deve ser um nome criativo que resuma o problema que vocês escolheram em até 4 palavras.</p>
                </div>
                <div class="missao__help">
                    <h3>precisa de <span>ajuda?</span></h3>
                    <p>Clique no botão abaixo e confira conteúdos de apoio para essa missão</p>
                    <a href="" class="btn btn--red">ver conteúdo</a>
                </div>
            </div>
        </div>

        <section class="inscricao">
            <div class="limit-grid">
                <div class="titulo-insc">
                    <img src="/images/mission.svg" alt="">
                    <h2>
                        Agora é a hora de cumprir a missão!
                    </h2>
                </div>
                <div class="limit-grid2">
                    <div class="form_padrao">
                        @if($group && !$mission )
                            <form action="" id="inscricao" enctype="multipart/form-data">
                                @endif
                                <input type="hidden" name="group_id" value="{{$group ? $group->id : ''}}">
                                <input type="hidden" name="title" value="na-pista">
                                <input type="hidden" name="code" value="{{$missionEnum->value}}">
                                <div class="form-group tipo" id="tipo-texto">
                                    <label for="text_field_1">Como o grupo investigou o problema?</label>
                                    <textarea name="text_field_1" cols="30" rows="10" placeholder="" id="text_field_1"
                                              {{$group && !$mission ? 'required': 'disabled'}}>{{ $mission ? $mission->text_field_1 : '' }}</textarea>
                                </div>
                                <div class="form-group tipo" id="tipo-texto">
                                    <label for="text_field_2">Descreva e cite quais são as pessoas ou grupos mais afetados por este problema?s</label>
                                    <textarea name="text_field_2" cols="30" rows="10" placeholder="" id="text_field_2"
                                              {{$group && !$mission ? 'required': 'disabled'}}>{{ $mission ? $mission->text_field_2 : '' }}</textarea>
                                </div>
                                <div class="form-group tipo" id="tipo-video">
                                    <label for="video">Crie um vídeo de até 2 minutos contando as causas do problema.</label>
                                    <p>Insira abaixo o link do vídeo que você criou, lembrando que é necessário que o vídeo esteja publicado no YouTube.</p>
                                    <input type="text" class="form-control" name="video_link" id="video" placeholder="Link"
                                           {{$group && !$mission ? 'required': 'disabled'}} value="{{$mission ? $mission->video_link : ''}}">
                                    <span class="invalid-feedback">Por favor, insira apenas links do Youtube</span>
                                </div>
                                @includeWhen($group && !$mission, 'stage.includes.missions.terms')
                                <div class="text-center pt-4">
                                    <button class="btn btn-secundary text-uppercase text-white fw-900 form_padrao__submit">
                                        {{($group && !$mission) ? 'Enviar missão' : 'Voltar'}}</button>
                                </div>
                                @if($group && !$mission )
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <div class="limit-grid">
            <section class="conteudo_pagina">

            </section>
        </div>
    </div>

    @include('stage.includes.confirm-mission-modal')
    @include('stage.includes.generic-modal')
@endsection