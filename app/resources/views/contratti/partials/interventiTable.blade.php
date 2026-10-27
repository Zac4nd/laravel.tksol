<div class="box">
    <div class="box-header">
        <h3 class="box-title">Listini</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <a class="btn btn-default"
                        href="{{ action('ContrattoInterventoController@create',$contratto->id) }}"
                        title="Aggiungi Nuovo ">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="interventi_search" name="table_search" class="form-control pull-right"
                           placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        {{--
        Se si vogliono aggiungere nuove colonne alla tabella bisogna modificare lo script:
        La colonna hidden viene utilizzata per calcolare il totali tariffa * ore, viene nascosta utilizzando il valore posizionale della colonna 
        --}}
        <table id="listinoInterventi"
               class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <td>Opzioni</td>
                <td>Descrizione</td>
                <td>ODA</td>
                <td>CIG</td>
                <td>DOC</td>
                <td>DAL</td>
                <td>AL</td>
                <td>Tariffa h</td>
                <td>Tariffa Giornata</td>
                <td>Q*P</td>                
                <td>Toggle</td>
            </tr>
            </thead>
            <tbody>
            @foreach($listinoInterventi as $listinoIntervento)
                <tr>
                    <td id="opzioni_{{$listinoIntervento->id}}">
                        <a href="{{ action('ContrattoInterventoController@edit',[$contratto->id,$listinoIntervento->id]) }}"
                           data-skin="skin-blue" class="btn btn-default btn-xs disabled"><i class="glyphicon glyphicon-edit"></i></a>
                        @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
                            <a href="{{ action('ContrattoInterventoController@destroy',[$contratto->id,$listinoIntervento->id]) }}"
                               data-method="DELETE" data-confirm="Eliminare il listino?" data-token="{{csrf_token()}}"
                               data-skin="skin-blue" class="btn btn-danger btn-xs disabled"><i
                                        class="glyphicon glyphicon-trash"></i></a>
                        @endif

                    </td>
                    <td>{{ $listinoIntervento->descrizione }}</td>
                    <td>{{ $listinoIntervento->ODA}}</td>
                     <td>{{ $listinoIntervento->CIG}}</td>
                     <td>{{ $listinoIntervento->doc}}</td>
                    <td>{{ $listinoIntervento->data_inizio}}</td>
                    <td>{{ $listinoIntervento->data_fine}}</td>
                    <td align="right">
                        {{$listinoIntervento->tariffa_ora}}
                    </td>
                    <td align="right">
                        @if($listinoIntervento->tariffa_giornata == 1)
                            {{$listinoIntervento->tariffa_ora * 8}}
                        @endif
                    </td>
                    <td> @if($listinoIntervento->tariffa_giornata == 1)                            
                            {{ $listinoIntervento->tariffa_ora*$listinoIntervento->ore_previste }}
                        @endif
                    </td>
                    <td><button  ><i data-id="opzioni_{{$listinoIntervento->id}}" class="glyphicon glyphicon-lock"></i></button></td>
                </tr>
            @endforeach
            </tbody>
            <!--
            <tfoot>
            <tr>
                <td></td>
                <td></td>
                <th colspan="1" style="text-align: right;">Totale Previsto: 0 &euro;</th>
                <th colspan="1" style="text-align: right;">Totale Previsto: 0 &euro;</th>
                <th colspan="1" style="text-align: right;">Totale Previsto: 0 &euro;</th>
            </tr>
            </tfoot>
            -->
        </table>
    </div>    
</div>
@section('page_scripts')
    <script>
        $(document).ready(function () {
            /*
            var clientiTable = $('#listinoInterventi').DataTable({
                "scrollY": "200px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    
                    {
                        "targets": [8],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "fnDrawCallback": function () {
                    $('#listinoInterventi').removeClass('hide');
                },

                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        if (typeof i === 'string') i =(i.replace(/[\$,]/g, '') * 1);
                        if (typeof i === 'number') return i;
                        else return 0;
                    };

                    // Total over all pages
                    total = api
                        .column(10)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    // Update footer
                    $(api.column(5).footer()).html(
                        'Totale Previsto: ' + Number(total).toLocaleString() + ' &euro;'
                    );

                    total = api
                        .column(9)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    // Update footer
                    $(api.column(4).footer()).html(
                        'Ore Totali Previste: ' + Number(total).toLocaleString() + 'h'
                    );

                    total = api
                        .column(9)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0)/8;
                    $(api.column(3).footer()).html(
                        'Giornate Totali Previste: ' + Number(Math.round(total*100)/100).toLocaleString() + 'gg'
                    );
                    
                }
            });
            $('#interventi_search').keyup(function () {
                clientiTable.search($(this).val()).draw();
            })
            $('.dataTables_filter').hide();
*/
        });
    $("button").click(function(e){
        if($("#"+e.target.dataset.id+"> a").hasClass("disabled"))
        {
            if (confirm('Vuoi abilitare la modifica?')) {
            $("#"+e.target.dataset.id+"> a").toggleClass("disabled");
            console.log(e.target.dataset.id);
        }
        }
        else
        {
            $("#"+e.target.dataset.id+"> a").toggleClass("disabled");
            console.log(e.target.dataset.id);
        }
            });
        
    </script>
@append