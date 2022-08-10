@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Painel</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div class="row">
                          <div class="col-md-6">
                            <div class="card">
                                 <div class="card-header">
                                      <h5>
                                        <i class="fa fa-user-circle"></i>
                                        Saldo
                                      </h5>
                                 </div>
                                 <div class="card-body">
                                    <strong>
                                        R$ 2000,00
                                      </strong>
                                 </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                     <h5>
                                       <i class="fa fa-user-circle"></i>
                                       Fazer Transferência
                                     </h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">
                                                <strong>
                                                    Conta
                                                </strong>
                                            </label>
                                            <select name="account_id" id="account_id" class="form-control">
                                                <option value="">
                                                    Selecione
                                                </option>

                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">R$</span>
                                            </div>
                                            <input type="text" name="value" id="value" placeholder="Valor" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-send"></i>
                                                Transferir
                                            </button>
                                        </div>
                                    </form>
                                </div>
                           </div>
                          </div>
                          <div class="col-md-6">
                            <div class="card">
                                 <div class="card-header">
                                      <h5>
                                        <i class="fa fa-user-circle"></i>
                                        Extrato de Transações
                                      </h5>
                                 </div>
                                 <div class="card-body">
                                      <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Descrição</th>
                                                <th>Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01/01/2019</td>
                                                <td>Compra de produto</td>
                                                <td>R$ 100,00</td>
                                            </tr>
                                            <tr>
                                                <td>01/01/2019</td>
                                                <td>Compra de produto</td>
                                                <td>R$ 100,00</td>
                                            </tr>
                                        </tbody>
                                      </table>
                                 </div>
                            </div>
                          </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script>
        var value = $('#value');
        $(document).ready(function(){
            value.mask('000.000.000.000.000,00', {reverse: true});
        });
    </script>
@endsection
