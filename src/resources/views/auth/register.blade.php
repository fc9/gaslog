@extends('layouts.base')

@section('title', 'Criar Conta')

@section('content')
<main class="register bg-login spaced">
    <div class="limit-grid">
       <a href="{{route('auth.login')}}"><img src="/images/logo-cde.png" alt="Grupo de Pesquisa" class="login__logo"></a>
       <div class="login__header login__header--small">
          <h1>Primeiro acesso</h1>
          <p>Preencha os dados abaixo para efetuar o cadastro</p>
       </div>
       <div class="create__wrapper first">
          <p><strong>Você é:</strong></p>
          <div class="create__wrapper__flex">
             <label class="radio radio--circle">
                <input type="radio" name="role" value="educator">
                <span></span>
                <p>Educador(a)</p>
             </label>
             <label class="radio radio--circle">
                <input type="radio" name="role" value="student">
                <span></span>
                <p>Estudante</p>
             </label>
          </div>
       </div>
       <div class="create__wrapper create__content create__wrapper--disabled">
          <section class="create__social">
             <p><strong>Cadastre-se com:</strong></p>
             <div class="create__social__wrapper">
                <a href="" id="facebookProvider" class="btn">facebook login</a>
                <a href="" id="googleProvider" class="btn">Google login</a>
             </div>
          </section>
          <section class="create__or">
             <p>OU</p>
          </section>
          <section class="create__email">
             <form class="form">
                <div class="create__email__wrapper">
                   <label class="form-group">
                      <p>E-mail de cadastro:</p>
                      <input type="email" name="email" required>
                      <p class="form-group__error__msg"></p>
                   </label>
                   <label class="form-group">
                      <p>Confirmar E-mail:</p>
                      <input type="email" name="confirm_email" required>
                      <p class="form-group__error__msg"></p>
                   </label>
                   <label class="form-group">
                      <p>Senha de cadastro:</p>
                      <input type="password" name="password" required>
                      <p class="form-group__error__msg"></p>
                   </label>
                   <label class="form-group">
                      <p>Confirmar Senha:</p>
                      <input type="password" name="confirm_password" required>
                      <p class="form-group__error__msg"></p>
                   </label>
                </div>
                <button type="submit" class="btn btn--primary">Cadastrar</button>
             </form>
          </section>
       </div>
    </div>
 </main>
@endsection
