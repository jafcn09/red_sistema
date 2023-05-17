<div class="form-group">
    {!! Form::label('name', 'NOMBRE DEL ROL') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'onkeyup' => 'mayus(this);' ]) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'SLOGAN DEL ROL') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'onkeyup' => 'mayus(this);' ]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'DESCRIPCIÓN DEL ROL') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'onkeyup' => 'mayus(this);' ]) !!}
</div>

<hr>
<h3>PERMISO ESPECIAL</h3>
<div class="form-group">
    <label for="">{{ Form::radio('special', 'all-access') }}  ACCESO TOTAL</label>
    <label for="">{{ Form::radio('special', 'no-access') }}  SIN ACCESO</label>
    
</div>
<hr>
<h3>LISTA DE PERMISOS</h3>
<div class="form-group">
    <ul class="list-unstyled">
    @foreach($permissions as $permission)
        <li>
            <label for="">
                {{ Form::checkbox('permissions[]', $permission->id, null) }}
                {{ $permission->name }}
                <em>( {{ $permission->description ?: 'Sin descripcion' }} )</em>
            </label>
        </li>
    @endforeach
    </ul>
</div>

<div class="form-group">
    {!! Form::submit('Guardar', ['class' => 'btn btn-sm btn-warning']) !!}
</div>