@extends('layouts.app') @section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session("status") }}
        </div>
        @endif

        <div class="card-header" style="display: flex;">
          Itens emprestados
          <div id="newBorrow" style="margin-left: auto; cursor: pointer;">
            <svg width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Item</th>
                <th scope="col">Data</th>
                <th scope="col">Contato</th>
                <th scope="col">Usuário</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($borroweds as $borrowed)
              <tr>
                <td>{{ $borrowed->description }}</td>
                <td>{{ $borrowed->created_at }}</td>
                <td>{{ $borrowed->contact }}</td>
                <td>{{ $borrowed->from }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div id="newBorrowModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Emprestar item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary">Emprestar!</button>
        </div>
      </div>
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
