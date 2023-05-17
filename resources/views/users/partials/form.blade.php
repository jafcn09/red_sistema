<div class="form-group">
    {!! Form::label('nombres', 'Nombre del usuario') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email del usuario') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
</div>

<hr>
<h3>Lista de roles</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach($roles as $role)
        <li>
            <label for="">
                {{ Form::checkbox('roles[]', $role->id, null) }}
                {{ $role->name }}
                <em>{{ $role->description ?: '(sin descripcion)' }}</em>
            </label>
        </li>
        @endforeach
    </ul>
</div>

<div class="form-group">
    {!! Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) !!}
</div>