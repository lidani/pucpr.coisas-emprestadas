@extends('layouts.app') @section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session("status") }}
        </div>
        @endif

        <div class="card-header" style="display: flex;">
          Objetos emprestados
          <a href="{{ route('relatorio') }}" style="margin-left: auto; cursor: pointer;" title="Relatório">
            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-list-task" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
              <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
              <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
            </svg>
          </a>
          <div id="newBorrow" style="margin-left: 24px; cursor: pointer;" title="Emprestar objeto">
            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Objeto</th>
                <th scope="col">Emprestado em</th>
                <th scope="col">Contato</th>
                <th scope="col">Emprestado para</th>
                <th scope="col">Devolução combinada</th>
                <th scope="col">Devolvido?</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($emprestimos as $emprestimo)
              <tr class="@if($emprestimo->devolvido) text-success @elseif(!$emprestimo->devolucao_combinada || $emprestimo->devolucao_combinada->isPast()) text-danger @endif">
                <td>{{ $emprestimo->objeto }}</td>
                <td>{{ $emprestimo->created_at->format('d/m/Y H:i:s') }}</td>
                <td>{{ $emprestimo->contato }}</td>
                <td>{{ $emprestimo->emprestado_para }}</td>
                <td>{{ $emprestimo->devolucao_combinada ? $emprestimo->devolucao_combinada->format('d/m/Y') : '' }}</td>
                <td>
                  @if ($emprestimo->devolvido)
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                  </svg>
                  {{ $emprestimo->devolvido_em->format('d/m/Y H:i:s') }}
                  @else
                  <form action="{{ route('devolver_emprestimo') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $emprestimo->id }}">
                    <button type="submit" class="btn btn-primary btn-sm">Devolvido</button>
                  </form>
                  @endif
                </td>
              </tr>
              @endforeach
              @if(count($emprestimos) === 0)
              <tr>
                <td colspan="20">Nenhum item emprestado.</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div id="newBorrowModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <form method="POST" action="{{route('novo_emprestimo')}}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Emprestar item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="objeto">Descrição do objeto</label>
              <input required autofocus type="text" class="form-control" name="objeto" id="objeto">
            </div>
            <div class="form-group">
              <label for="emprestado_para">Emprestado para</label>
              <input required type="text" class="form-control" name="emprestado_para" id="emprestado_para">
            </div>
            <div class="form-group">
              <label for="contato">Contato</label>
              <input required type="text" class="form-control" name="contato" id="contato">
            </div>
            <div class="form-group">
              <label for="devolucao_combinada">Data de devolução*</label>
              <input type="date" class="form-control" name="devolucao_combinada" id="devolucao_combinada">
            </div>
          </div>
          <div class="modal-footer">
            <small style="margin-right: auto;">Campos marcados com * são opcionais.</small>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Emprestar!</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(() => {

    $('#newBorrow').click(event => {
      $('#newBorrowModal').modal();
    })

  })
</script>
@endsection
