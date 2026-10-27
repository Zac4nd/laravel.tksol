<div class="box-body">
    @foreach($societas as $societa)
        <div class="form-group">
            <label>ID Gamma x {{$societa->nome}}</label>
            {!! Form::text('idGamma['.$societa->id.']',
            (($cs = collect($cliente_societa)->where('societa_id',(string)$societa->id)->first()) ? $cs->idGamma:null),
            ['class'=>'form-control', 'id'=>'idGamma_'.$societa->id, 'placeholder'=>'idGamma_'.$societa->id]) !!}            
        </div>
    @endforeach 
    @foreach($societas as $societa)
        @if($societa->id == 1)
            <div class="form-group">
                <label>ID Agente Gamma x {{$societa->nome}}</label>
            {!! Form::text('ID_AGENTE_GAMMA['.$societa->id.']',
                (($cs = collect($cliente_societa)->where('societa_id',(string)$societa->id)->first()) ? $cs->ID_AGENTE_GAMMA:null),
                ['class'=>'form-control', 'id'=>'idGamma_'.$societa->id, 'placeholder'=>'ID_AGENTE_GAMMA']) !!}
        
            </div>
        @endif
    @endforeach 

</div>