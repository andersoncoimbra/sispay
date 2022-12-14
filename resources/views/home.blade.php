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
                    <div id="notification" class="alert alert-success col-md-12" style="display: none" role="alert">
                    </div>
                          <div class="col-md-6">
                            <div class="card">
                                 <div class="card-header">
                                      <h5>
                                        <i class="fa fa-user-circle"></i>
                                        Saldo
                                      </h5>
                                 </div>
                                 <div class="card-body">
                                    <h2>
                                       R$ {{ Auth::user()->getBalance() }}
                                      </h2>
                                 </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                     <h5>
                                       <i class="fa fa-user-circle"></i>
                                       Fazer TransferĂȘncia
                                     </h5>
                                </div>
                                <div class="card-body">

                                        <div class="form-group">
                                            <label for="">
                                                <strong>
                                                    Conta
                                                </strong>
                                            </label>
                                            <select name="account_id" id="account_id" class="form-control">
                                                <option value="">
                                                    Selecione uma conta
                                                </option>
                                                @foreach($accounts as $account)
                                                    <option value="{{ $account->id }}">
                                                        {{ $account->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">R$</span>
                                            </div>
                                            <input type="text" name="value" id="value" placeholder="Valor" class="form-control" onkeyup=" transactionOn(this.value);">
                                        </div>
                                        <div class="form-group">
                                            <button onclick="transaction();" class="btn btn-success tranferir">
                                                <i class="fa fa-send"></i>
                                                Transferir
                                            </button>
                                        </div>
                                </div>
                           </div>
                          </div>
                          <div class="col-md-6">
                            <div class="card">
                                 <div class="card-header">
                                      <h5>
                                        <i class="fa fa-user-circle"></i>
                                        Extrato de TransaĂ§Ă”es
                                      </h5>
                                 </div>
                                 <div class="card-body">
                                      <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>DescriĂ§ĂŁo</th>
                                                <th>Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactions as $transaction)
                                                <tr style="color: {{ $transaction->value >= 0? 'green':'red' }}">
                                                    <td>
                                                        {{ $transaction->dataBr() }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->description }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->value }}
                                                    </td>
                                                </tr>
                                            @endforeach
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
        let value = $('#value');
        $(document).ready(function(){
            value.mask('000.000.000.000.000,00', {reverse: true});
            transactionOn();
        });
    </script>
    <script>
        function transaction(){
            let account_id = $('#account_id').val();
            let value = $('#value').val();
            let player_id = {{ Auth::user()->id }};

            $.post('{{ route('transaction.store') }}', {
                payee: account_id,
                value: value,
                player: player_id
            }, function(data){
                    $('#notification').show();
                    $('#notification').html(data.message);
                    setTimeout(function(){
                        $('#notification').hide();
                        //update page
                        window.location.reload();
                    }, 3000);
                    $('#value').val('');
                    $('#account_id').val('');

            }).fail(function(data) {
                $('#notification').removeClass("alert-success");
                $('#notification').addClass("alert-danger");
                $('#notification').show();
                    $('#notification').html(data.responseJSON.message);
                    setTimeout(function(){
                        $('#notification').hide();

                    }, 3000);
                    $('#value').val('');
                    $('#account_id').val('');
            });
        }
    </script>
    <script>
        function transactionOn(value='0') {
            let btntransferir = $('.tranferir');
            //validaĂ§ĂŁo para saldo negativo
            let balance = {{ Auth::user()->getBalance() }};
            let vl =parseFloat(value.replace('.', '').replace(',', '.'));
            console.log($('#account_id').val());
            if(vl > balance ){
                btntransferir.prop('disabled', true);
                notification('warning', 'Saldo insuficiente');

            }
            else if(!$('#account_id').val() && value != 0){
                notification('warning', 'Selecione uma conta');
            }
            else if(value == 0){
                btntransferir.prop('disabled', true);
            }
            else{
                btntransferir.prop('disabled', false);
            }
        }

        function notification(type, message){
            let notification = $('#notification');
            notification.removeClass('alert-success');
            notification.removeClass('alert-danger');
            notification.addClass('alert-'+type);
            notification.html(message);
            notification.show();
            setTimeout(function(){
                notification.hide();

            }, 3000);
        }
    </script>

@endsection
