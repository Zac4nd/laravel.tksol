@extends('layouts.app')


@section('htmlheader_title')
{{$cliente->ragione_sociale}}
@endsection
@section('contentheader_title')
{{$cliente->id . " - " . $cliente->ragione_sociale}}
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Contratti</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                     
                <a class="btn btn-default" href="{{ action('ContrattoController@create',['cli' => $cliente->id]) }}" title="Aggiungi Nuovo ">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="contratti_search" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <table id="contratti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td>Opzioni</td>
                    <td>Id_Contratto</td>
                    <td>Commessa</td>
                    <td>Progetto</td>
                    <td>Descrizione Breve</td>
                    <td>Inizio</td>
                    <td>Durata</td>
                    <td>Stato</td>
                    <td>Documento</td>
                    <td>Planner</td>
                </tr>
            </thead>
            <tbody>
                @foreach($cliente->contratti as $contratto)
                <tr>
                    <td>
                        <a href="{{ action('ContrattoController@edit',$contratto->id) }}" data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
                        <a href="{{ action('ContrattoController@destroy',$contratto->id) }}" data-method="DELETE" data-confirm="Eliminare il contratto?" data-token="{{csrf_token()}}" data-skin="skin-blue" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                        @endif
                    </td>
                    <td>{{$contratto->id}}</td>                                                        
                    <td>{{ $contratto->progetto->id . "_" . $cliente->id }}</td>
                    <td>{{ $contratto->progetto->nome }}</td>
                    <td>{{ $contratto->desc_breve }}</td>
                    <td>{{ $contratto->data_avvio_progetto }}</td>
                    <td>{{ $contratto->data_validita_contratto }}</td>
                    <td>{{ $contratto->stato }}</td>
                    <td>@if($contratto->link_pdf <> '')<a href='{{ $contratto->link_pdf }}' target="_blank">Documento</a>@endif</td>
                    <td>@if($contratto->link_planner <> '')<a href='{{ $contratto->link_planner }}' target="_blank">Planner</a>@endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Rubrica</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <a class="btn btn-default" href="{{ action('ClienteController@associa',$cliente->id) }}" title="Aggiungi Nuovo ">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="clienti_search" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->

    <!-- /.box-body -->
    <div class="box-body">
        <table id="clienti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td>Opzioni</td>
                    <td>Azienda</td>
                    <td>Contatto</td>
                    <td>Ruolo</td>
                    <td>Email</td>
                    <td>Telefono</td>
                    <td>Telefono 2</td>
                    <td>Referente Commerciale</td>
                </tr>
            </thead>
            <tbody>
                @foreach($cliente->rubrica as $contatto)
                <tr>
                    <td>
                        <?php if (!empty($contatto->user)) $btnclass = 'btn-primary';
                        else $btnclass = 'btn-default'; ?>
                        <!--a onclick="toggleUser({{$contatto->id}})" id="consulente_{{$contatto->id}}"
                                data-skin="skin-blue" class="btn btn-xs {{$btnclass}}"><i
                                        class="glyphicon glyphicon-user"></i></a-->
                        <a href="{{ action('ContattoController@edit',$contatto->id) }}" data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="{{ action('ContattoController@destroy',[$contatto->id, $cliente->id]) }}" data-method="DELETE" data-confirm="Eliminare il contatto?" data-token="{{csrf_token()}}" data-skin="skin-blue" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                    <td>{{ $contatto->azienda }}</td>
                    <td>{{ $contatto->descrizione }}</td>
                    <td>{{ $contatto->ruolo }}</td>
                    <td><a href="mailto:{{ $contatto->email }}" target="_blank">{{ $contatto->email }}</a></td>
                    <td><a href="tel:{{ $contatto->telefono }}" target="_blank">{{ $contatto->telefono }}</a></td>
                    <td><a href="tel:{{ $contatto->telefono2 }}" target="_blank">{{ $contatto->telefono2 }}</a></td>
                    <td>{{ $contatto->rifCommerciale}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        $('.dataTables_filter').hide();
        //Script Tabella Rubrica
        var clientiTable = $('#clienti').DataTable({
            "scrollY": "600px",
            "scrollCollapse": false,
            "paging": false,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "fnDrawCallback": function() {
                $('#clienti').removeClass('hide');
            }

        });
        $('#clienti_search').keyup(function() {
            clientiTable.search($(this).val()).draw();
        })
        //Script Tabella Contratti
        var contrattiTable = $('#contratti').DataTable({
            "scrollY": "600px",
            "scrollCollapse": false,
            "paging": false,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "columnDefs": [{
                "width": "80px",
                "targets": 0
            }],
            "fnDrawCallback": function() {
                $('#contratti').removeClass('hide');
            }
        });
        $('.dataTables_filter').hide();
        $('#contratti_search').keyup(function() {
            contrattiTable.search($(this).val()).draw();
        })
    });

    function toggleUser(id) {
        var request = $.ajax({
            url: "/ajax/toggleUser",
            type: "post",
            data: {
                'tipo_utente': 2,
                'id': id
            },
            dataType: "JSON"
        }).done(function(data) {
            if (data['status'] == 'success') {
                if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                console.log(data['msg']);
            } else console.log(['Errore!!', data]);
        }).fail(function(jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    }
</script>
@endsection