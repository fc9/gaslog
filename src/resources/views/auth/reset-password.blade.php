@extends('layouts.base')

@section('title', 'Resetar Senha')

@section('content')
<main class="login bg-login reset-password spaced">
    <div class="limit-grid">
    <a href="#"><img src="/images/logo-cde.png" alt="Grupo de Pesquisa" class="login__logo"></a>
       <div class="login__header forgot-password__header">
          <h1>Redefina sua senha</h1>
       </div>
       <div class="forgot-password__wrapper">

        @if($tokenValid)
          <form action="" class="form">
              <input type="hidden" name="token" value="{{$token}}" />
             <label class="form-group">
                <p>Nova senha:</p>
                <input type="password" name="password" required>
                <p class="form-group__error__msg">Não pode ficar em branco</p>
             </label>
             <label class="form-group">
                <p>Confirmar senha:</p>
                <input type="password" name="password_confirmation" required>
                <p class="form-group__error__msg">Não pode ficar em branco</p>
             </label>
             <button type="submit" class="btn btn--border-primary btn-send">Salvar</button>
          </form>
        @else
            <p>Infelizmente houve um problema ao resetar sua senha!</p>
        @endif
       </div>
    </div>
 </main>

 @include('stage.includes.password-reset-modal');
@endsection
