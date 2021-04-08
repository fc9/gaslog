@extends('layouts.base')

@section("title", "Login")

@section('content')
    <?php
      if( isset($_GET['dash']) ){
        $param = $_GET['dash'];
        Session::put('dash', $param);
      }
    ?>
    <main class="login bg-login spaced">
        <div class="limit-grid">
            <a href="#"><img src="/images/logo-cde.png" alt="Grupo de Pesquisa" class="login__logo"></a>
            <div class="login__header">
                <h1 class="spaced">Entrar/Cadastro</h1>
            </div>

            <div class="login__wrapper">
                <section class="login__social">
                    <p><strong>Conectar com:</strong></p>
                    <a href="#" id="facebookProvider" class="btn btn--noborder">facebook login</a>
                    <a href="#" id="googleProvider" class="btn btn--noborder">Google login</a>
                </section>
                <section class="login__or">
                    <p>OU</p>
                </section>
                <section class="login__email">
                    <form class="form" autocomplete="off">
                        <label class="form-group">
                            <p>E-mail:</p>
                            <input type="email" name="email" required>
                            <p class="form-group__error__msg">Não pode ficar em branco</p>
                        </label>
                        <label class="form-group">
                            <p>Senha:</p>
                            <input type="password" name="password">
                            <p class="form-group__error__msg">Senha invalida</p>
                        </label>
                        <button type="submit" class="btn btn--red btn--noborder">Entrar</button>
                    </form>
                    <div class="forgot">
                    <a href="{{route('auth.forgot-password')}}">Esqueci a minha senha</a>
                    </div>
                </section>
            </div>

            <section class="login__create">
            <p>Não possui cadastro? <a href="{{route('auth.register')}}" class="primary">clique aqui para se cadastrar</a></p>
            </section>
        </div>
    </main>
@include('stage.includes.generic-modal')
@endsection
