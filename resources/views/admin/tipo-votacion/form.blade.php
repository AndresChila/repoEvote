<div class="form-group {{ $errors->has('nombretipo') ? 'has-error' : ''}}">
    <label for="nombretipo" class="control-label">{{ 'Nombre tipo' }}</label>
    <input class="form-control" name="nombretipo" type="text" id="nombretipo" value="{{ isset($tipovotacion->nombretipo) ? $tipovotacion->nombretipo : ''}}" >
    {!! $errors->first('nombretipo', '<p class="alert alert-danger">El campo nombre tipo es requerido.</p>') !!}
</div>
<div class="form-group {{ $errors->has('ocupacionpermitida') ? 'has-error' : ''}}">
    <label for="ocupacionpermitida" class="control-label">{{ 'Ocupación permitida' }}</label>
    <br/>
    <br/>
    
    @foreach($collection1 as $key => $value)
        <label class="btn" style="background-color: #9c9c9c"> <input type="checkbox" name="{{ $key }}" id="{{ $key }}"> {{ $value }}</label><br/>
    @endforeach
    {!! $errors->first('ocupacionpermitida', '<p class="alert alert-danger">El campo ocupación permitida es requerido.</p>') !!}
    
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>
