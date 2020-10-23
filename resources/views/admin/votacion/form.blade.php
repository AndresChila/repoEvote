
<div class="form-group {{ $errors->has('nombrevotacion') ? 'has-error' : ''}}">
    <label for="nombrevotacion" class="control-label">{{ 'Nombre Votación' }}</label>
    <input class="form-control" name="nombrevotacion" type="text" id="nombrevotacion" value="{{ isset($votacion->nombrevotacion) ? $votacion->nombrevotacion : ''}}" >
    {!! $errors->first('nombrevotacion', '<p class="alert alert-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tiposVotaciones') ? 'has-error' : ''}}">
    <label for="idvotacion" class="control-label">Tipo de votación </label>
    <select name="tipovotacion" class="form-control" id="tipovotacion" >    
        <option value=""> --seleccione una opcion-- </option>
        @foreach( $roles as $key => $value )
            @if(isset($votacion->tipovotacion))
                @if($key == $votacion->tipovotacion)
                    <option value="{{ $votacion->tipovotacion }}" selected>{{ $value }}</option>
                @endif
            @endif
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach 
    </select>
    {!! $errors->first('tipovotacion', '<p class="alert alert-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fechainicio') ? 'has-error' : ''}}">
    <label for="fechainicio" class="control-label">{{ 'Fecha inicio' }}</label>
    
    <input class="date form-control" type="text" name="fechainicio" id="fechainicio" value="{{ isset($votacion->fechainicio) ? $votacion->fechainicio : ''}}">
    {!! $errors->first('fechainicio', '<p class="alert alert-danger">:message</p>') !!}
</div>
<div class="form-group">
    <label for="horainicio" class="control-label">{{ 'Hora inicio' }}</label>
    <br/>
    <input class="time form-control" type="time" name="horainicio" id="horainicio" value="{{ isset($votacion->horainicio) ? $votacion->horainicio : ''}}"> </input>
</div>
<div class="form-group {{ $errors->has('duracion') ? 'has-error' : ''}}">
    <label for="duracion" class="control-label">{{ 'Duración' }}</label>
    
    <select class="form-control" name="duracion" id="duracion" value="{{ isset($votacion->duracion) ? $votacion->duracion : ''}}" >
        <option value="">-Duracion-</option>
        @for($i=1;$i<=12;$i++){
            @if(isset($votacion->duracion))
                @if($i == $votacion->duracion)
                    <option value="{{ $votacion->duracion }}" selected>{{ $i }}</option>
                @endif
            @endif
            <option value={{$i}}>{{$i}}</option>
        }@endfor
    </select>
    {!! $errors->first('duracion', '<p class="alert alert-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>

