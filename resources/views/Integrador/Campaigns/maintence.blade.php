@extends('adminlte::page')

@section('title_postfix', '| Campanhas')

@section('content_header')
    <h1>Campanha {{$campaign->name}}    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <p>Data Final não pode ser menor que Data Inicial</p>
                    </div>
                @endif
            </div>
            <form class="d-flex row" action="{{route('campanhas.matience.sync',$campaign->id)}}" method="POST">
                @csrf

                <div class=" col-lg-4 form-group">
                    <label>Date Inicial:</label>
                    <input type="text" placeholder="AAAA-MM-DD" class="form-control pull-right" id="datetimepickerI"
                           name="data_inicial">
                </div>
                <div class="col-lg-4 form-group">
                    <label>Date Final:</label>
                    <input type="text" placeholder="AAAA-MM-DD" class="form-control pull-right" id="datetimepickerF"
                           name="data_final">
                </div>
                <div class="d-flex col col-lg-4 justify-content-center align-items-center from-group">
                    <button type="submit" class=" btn btn-block btn-primary btn-lg">
                        Sincronizar
                    </button>
                </div>
            </form>
        </div>
        <div class="card-body">

        </div>
        <div class="card-footer">


        </div>
    </div>
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
           <h1 class="display-2">{{$sales}}</h1>
        </div>

    </div>
@stop
@section('css')

@stop

@section('js')
    <script>
        $("#alert").fadeTo(2000, 500).slideUp(500, function () {
            $("#alert").slideUp(500);
        });

        var inputElements = document.querySelectorAll("input[data-format]");
        inputElements.forEach(input => {
            let m = new IMask(input, {
                mask: input.getAttribute("data-format")
            });
        });

        $(document).ready(function () {
            $("#datetimepickerI").mask('00/00/0000');
            $("#datetimepickerF").mask('00/00/0000');
        });


    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css"
          rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.pt-BR.min.js"></script>

@stop
