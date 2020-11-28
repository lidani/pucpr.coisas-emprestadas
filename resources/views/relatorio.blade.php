@extends('layouts.app') @section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" style="display: flex;">
          <div title="Voltar" style="cursor: pointer;" onclick="location.href='{{ route('dashboard') }}'">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
          </div>
          <div style="margin-left: auto;"></div>
          <div>
            Relatório dos objetos emprestados pendentes
          </div>
          <div style="margin-right: auto;"></div>
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
              </tr>
            </thead>
            <tbody>
              @foreach ($emprestimos as $emprestimo)
              <tr class="text-danger">
                <td>{{ $emprestimo->objeto }}</td>
                <td>{{ $emprestimo->created_at->format('d/m/Y H:i:s') }}</td>
                <td>{{ $emprestimo->contato }}</td>
                <td>{{ $emprestimo->emprestado_para }}</td>
                <td>{{ $emprestimo->devolucao_combinada ? $emprestimo->devolucao_combinada->format('d/m/Y') : '' }}</td>
              </tr>
              @endforeach
              @if(count($emprestimos) === 0)
              <tr>
                <td colspan="20">Nenhum item emprestado pendende.</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
