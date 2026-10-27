@extends('layouts.app')


@section('htmlheader_title')
    Clienti
@endsection
@section('contentheader_title')
    Clienti
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Elenco clienti</h3>
            <div class="box-tools">
                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <a class="btn btn-default"
                            href="{{ action('ClienteController@create') }}" title="Aggiungi Nuovo ">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" id="clienti_search" name="table_search" class="form-control pull-right"
                               placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <!-- /.box-body -->
        <div class="box-body" style="min-height: 300px;">
            <table id="clienti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap"
                   cellspacing="0" width="100%">
                <thead>
                <tr>
                    <td>Opzioni</td>
                    <td width="10%">Codice Fiscale<br/>Partita IVA</td>
                    <td width="20%">Ragione Sociale</td>
                    <td width="20%">Sito Sharepoint</td>
                    <td width="20%">Sito Cliente</td>
                    <td>Settore</td>
                    <td>Fatturato</td>
                    <td width="20%">Città</td>
                    <td>Rating</td>
                </tr>
                </thead>
                <tbody>
                @foreach($clienti as $cliente)
                    <tr>
                        <td>
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">                                
                                <a href="{{ action('ClienteController@edit',$cliente->id) }}"
                                   data-token="{{csrf_token()}}" data-skin="skin-blue"
                                   class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i>
                                </a>
                             
                                @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
                                    <a href="{{ action('ClienteController@destroy',$cliente->id) }}"
                                       data-method="DELETE" data-confirm="Eliminare il Cliente?"
                                       data-token="{{csrf_token()}}" data-skin="skin-blue"
                                       class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td>{{ $cliente->codice_fiscale }}<br/>{{ $cliente->partita_iva }}</td>
                        <td>
                            <a href="{{ action('ClienteController@show',$cliente->id) }}">{{ $cliente->ragione_sociale}}</a>
                        </td>
                        <td>
                            <a href="{{ $cliente->sito }}" target="_blank">@if(filter_var($cliente->sito, FILTER_VALIDATE_URL)){{parse_url($cliente->sito)['path']}}@else {{$cliente->sito}} @endif</a>
                        </td>
                        <td>
                            <a href="{{ $cliente->sito_cliente }}" target="_blank">@if(filter_var($cliente->sito_cliente, FILTER_VALIDATE_URL)){{parse_url($cliente->sito_cliente)['host']}}@else {{$cliente->sito_cliente}}  @endif</a>
                        </td>
                        <td>{{ $cliente->settore }}</td>
                        <td class="pull-right"><i
                                    class="glyphicon glyphicon-euro"></i> {{ number_format($cliente->fatturato,0,',','.') }}
                            mln
                        </td>
                        <td>
                            <a href="http://maps.google.com/?q={{ $cliente->indirizzo . ', ' . $cliente->citta . ', ' . $cliente->ragione_sociale}}"
                               target="crm.tksol.map">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                {{ $cliente->citta }}
                            </a>
                        </td>
                        <td>{{ $cliente->rating }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        $(document).ready(function () {
            var oTable = $('#clienti').DataTable({
                "scrollY": "500px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "fnDrawCallback": function () {
                    $('#clienti').removeClass('hide');
                }
            });
            $('.dataTables_filter').hide();
            $('#clienti_search').keyup(function () {
                oTable.search($(this).val()).draw();
            })
        });
    </script>
@endsection
