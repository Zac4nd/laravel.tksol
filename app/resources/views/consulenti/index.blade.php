@extends('layouts.app')


@section('htmlheader_title')
    Consulenti
@endsection
@section('contentheader_title')
    Consulenti
    <a class="btn btn-default navbar-btn"
           href="{{action('ConsulenteController@create')}}" title="Aggiungi Nuovo">
        <i class="fa fa-plus"></i>&nbsp; Aggiungi Nuovo
    </a>
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Elenco consulenti</h3>

            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="consulenti_search" name="table_search" class="form-control pull-right"
                           placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="consulenti"
                   class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap"
                   cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>CF</th>
                    <th>CDC</th>
                    <th>Area</th>
                    <th>Nominativo</th>
                    <th>Tipo</th>
                    <th>Sesso</th>
                    <th>Mail</th>
                    <th>Telefono</th>                   
                    <th>Data di Nascita</th>                   
                    <th>Rapporto</th>                   
                    <th>Data Assunzione</th>                   
                    <th>Data Cessazione</th>                   
                    <th>CV</th>                   
                    <th>Sito</th>                   
                </tr>
                </thead>
                <tbody>
                @foreach( $consulenti as $consulente)
                    <tr>
                        <td>{{ $consulente->codice_fiscale }}</td>
                        <td>{{ $consulente->CDC }}</td>
                        <td>{{ $consulente->area }}</td>
                        <td>
                            <?php if (!empty($consulente->user) ) $btnclass = 'btn-primary'; else $btnclass = 'btn-default'; ?>
                            <a onclick="toggleUser('{{$consulente->id}}')" id="consulente_{{$consulente->id}}"
                               data-skin="skin-blue" class="btn btn-xs {{$btnclass}}"><i
                                        class="glyphicon glyphicon-user"></i></a>
                            <a href="{{ action('ConsulenteController@edit',$consulente->id) }}" data-skin="skin-blue"
                               class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                            {{ $consulente->nome . " " . $consulente->cognome }}
                        </td>
                        <td>{{ $consulente->tipo }}</td>
                    <td>{{ $consulente->sesso == 'Non Specificato' ? '' : $consulente->sesso }}</td>
                    <td><a href="mailto:{{ $consulente->user->email or ''}}" target="_blank">{{ $consulente->user->email or ''}}</a></td>
                    <td><a href="tel:{{ $consulente->mobile . ' ' . $consulente->mobile2  }}" target="_blank">{{ $consulente->mobile . " " . $consulente->mobile2  }}</a></td>
                    <td>{{ $consulente->data_nascita }}</td>            
                    <td>{{ $consulente->rapporto }}</td>            
                    <td>{{ $consulente->data_assunzione }}</td>            
                    <td>{{ $consulente->data_cessazione }}</td>            
                    <td><a href="{{ $consulente->CV or ''}}" target="_blank">{{ $consulente->CV or ''}}</a></td>
                    <td><a href="{{ $consulente->sito or ''}}" target="_blank">{{ $consulente->sito or ''}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@section('page_scripts')
    <script>
        $(document).ready(function () {
            var oTable = $('#consulenti').DataTable({
                "scrollY": "600px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
            $('.dataTables_filter').hide();
            $('#consulenti_search').keyup(function () {
                oTable.search($(this).val()).draw();
            })
        });
        function toggleUser(id) {
            var conferma = true;
            if ($('#consulente_' + id).hasClass('btn-primary')) {
                conferma = confirm("Disabilitare l'accesso al programma per questo Consulente?");
            }
            if (conferma) {
                var request = $.ajax({
                    url: "/ajax/toggleUser",
                    type: "post",
                    data: {'tipo_utente': 1, 'id': id},
                    dataType: "JSON"
                }).done(function (data) {
                    if (data['status'] == 'success'){
                        if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                        else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                        console.log(data['msg']);
                        console.log(data['utente']);
                    }
                    else if(data['status'] == 'warning') {

                        if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                        else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                        alert(data.msg.replace(/(?:\\r\\n|\\r|\\n)/g, '\n'));
                        console.log(['Warning!', data]);
                    }
                    else console.log(['Errore!!', data]);
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            }
        }

    </script>
@endsection
