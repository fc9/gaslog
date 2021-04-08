@extends('layouts.base')

@section('title', 'Redefinir Senha')

@section('content')
<main class="login  bg-login forgot-password spaced">
    <div class="limit-grid">
    <a href=""><img src="/images/logo-cde.png" alt="Grupo de Pesquisa" class="login__logo"></a>
       <div class="login__header login__header--small forgot-password__header">
          <h1>Redefina sua senha</h1>
          <p>Enviar instruções de redefinição de senha para o e-mail:</p>
       </div>
       <div class="forgot-password__wrapper">
          <form action="" class="form">
             <label class="form-group">
                <p>E-mail:</p>
                <input type="email" name="email" required>
                <p class="form-group__error__msg">Não pode ficar em branco</p>
             </label>
             <button type="submit" class="btn btn--primary btn-send">Enviar</button>
          </form>
       </div>
    </div>
 </main>

 @include('stage.includes.email-sent-modal');
@endsection
