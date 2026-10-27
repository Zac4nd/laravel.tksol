<div class="box">
    <div class="box-header">
        <h3 class="box-title">Budget Ore</h3>
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

        <table id="OreInterventi"
               class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <td>Descrizione</td>
                <td>IVA</td>
                <td>Ore</td>
                <td>Giornate</td>
            </tr>
            </thead>
            <tbody>
            @foreach($listinoInterventi as $listinoIntervento)
                @if($listinoIntervento->tariffa_giornata == 1)
                <tr>                    
                    <td>{{ $listinoIntervento->descrizione }}</td>                    
                    <td>{{$listinoIntervento->iva}} %, {{ucfirst(strtolower($listinoIntervento->tipo_iva))}}</td>
                    <td>
                        {{ $listinoIntervento->ore_previste }}
                    </td>
                    <td>                        
                        {{$listinoIntervento->ore_previste / 8}}                        
                    </td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>    
</div>
@section('page_scripts')
    <script>
    /*
        $(document).ready(function () {
            var clientiTable = $('#oreInterventi').DataTable({
                "scrollY": "200px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    
                    {
                        "targets": [10],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "fnDrawCallback": function () {
                    $('#ore Interventi').removeClass('hide');
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
        */
    </script>
@append