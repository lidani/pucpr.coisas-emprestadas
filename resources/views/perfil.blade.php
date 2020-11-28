@extends('layouts.app') @section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header" style="display: flex;">
          <div title="Voltar" style="cursor: pointer;" onclick="location.href='{{ route('dashboard') }}'">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
          </div>
          <div style="margin-left: auto;"></div>
          <div>
            Perfil
          </div>
          <div style="margin-right: auto;"></div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('alterar_usuario') }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>
              <div class="col-md-6">
                  <input id="name" type="name" class="form-control" name="name" value="{{ $user->name }}" autofocus>
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
              <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" autocomplete="email" autofocus>
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
              <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" autocomplete="current-password">
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Salvar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
