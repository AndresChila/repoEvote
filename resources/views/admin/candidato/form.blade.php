<div class="form-group {{ $errors->has('nombrecandidato') ? 'has-error' : ''}}">
    <label for="nombrecandidato" class="control-label">{{ 'Nombre Candidato' }}</label>
    <input class="form-control" name="nombrecandidato" type="text" id="nombrecandidato" value="{{ isset($candidato->nombrecandidato) ? $candidato->nombrecandidato : ''}}" >
    {!! $errors->first('nombrecandidato', '<p class="alert alert-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('apellidocandidato') ? 'has-error' : ''}}">
    <label for="apellidocandidato" class="control-label">{{ 'Apellido Candidato' }}</label>
    <input class="form-control" name="apellidocandidato" type="text" id="apellidocandidato" value="{{ isset($candidato->apellidocandidato) ? $candidato->apellidocandidato : ''}}" >
    {!! $errors->first('apellidocandidato', '<p class="alert alert-danger">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('foto') ? 'has-error' : ''}}">
    <label for="foto" class="control-label">{{ 'Foto' }}</label>
   
        @if(isset($candidato->foto))
        <br/>
           <img src="{{ asset('storage').'/'. $candidato->foto }}" alt="" width="150" class="img-thumbnail img-fluid">
        <br/>
        @endif 
   
    <input class="form-control" name="foto" type="file" id="foto" value="{{ isset($candidato->foto) ? $candidato->foto : ''}}" >
    {!! $errors->first('foto', '<p class="alert alert-danger">:message</p>') !!}
</div>




<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Actualizar' : 'Crear' }}">
</div>
