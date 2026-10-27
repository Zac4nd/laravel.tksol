<?php
if (isset($listinoIntervento))
{
    $tipo_iva = $listinoIntervento->tipo_iva;
    if ($listinoIntervento->tariffa_giornata == '1')
        $tariffa_giornata = true;
    else $tariffa_giornata = false;
                    
} else
{
    $tipo_iva = '';
    $tariffa_giornata = true;
}
?>
<div class="box-body">
    <input type="hidden" name="contratto_id" value= {{$contratto->id}}>
    <div class="form-group">
        <label>Descrizione</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-pencil"></i>
            </div>
            {!! Form::text('descrizione', null,['class'=>'form-control  pull-right', 'id'=>'descrizione', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Tariffa Oraria</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            {!! Form::text('tariffa_ora', null,['class'=>'form-control  pull-right', 'id'=>'tariffa_ora', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>IVA</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="glyphicon"><b> % </b></i>
            </div>
            {!! Form::text('iva', null,['class'=>'form-control  pull-right', 'id'=>'iva', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Tipo IVA</label>
        {!! Form::select('tipo_iva',
            array('NORMALE' => 'Normale','SPLIT' => 'Split'),
            $tipo_iva,
            ['id'=>'tipo_iva','style'=>'width:100%', 'class'=>'form-control'])
        !!}
    </div>
    <div class="form-group">
        <label>Ore Previste*</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
            {!! Form::text('ore_previste', null,['class'=>'form-control  pull-right', 'id'=>'ore_previste', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>ODA</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            {!! Form::text('ODA', null,['class'=>'form-control  pull-right', 'id'=>'ODA', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>CIG</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            {!! Form::text('CIG', null,['class'=>'form-control  pull-right', 'id'=>'CIG', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Doc</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            {!! Form::text('doc', null,['class'=>'form-control  pull-right', 'id'=>'doc', 'placeholder'=>'']) !!}
        </div>
    </div>
        <div class="form-group">
            <label>data_inizio</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('data_inizio', null,['class'=>'datepicker form-control  pull-right', 'id'=>'data_inizio', 'placeholder'=>'gg/mm/aaaa']) !!}
            </div>
        </div>
        <div class="form-group">
            <label>data_fine</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('data_fine', null,['class'=>'datepicker form-control  pull-right', 'id'=>'data_fine', 'placeholder'=>'gg/mm/aaaa']) !!}
            </div>
        </div>
        <div class="checkbox icheck">
            <label>
                {{Form::hidden('tariffa_giornata',0)}}
                {!!  Form::checkbox('tariffa_giornata', 1, $tariffa_giornata) !!} Calcola Tariffa Giornata
            </label>
        </div>
</div><!-- /.box-body -->

<div class="box-footer">
    @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
        <button type="submit" class="btn btn-primary">Submit</button>
    @endif
</div>
