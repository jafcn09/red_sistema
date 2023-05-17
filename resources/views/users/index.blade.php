@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Usuarios') }}</h4>
                <p class="card-category"> {{ __('Aqui podemos administrar todos los usuarios del sistema') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-warning">{{ __('Agregar usuario') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table" >
                    <thead class="card-header-warning">
                      <th>
                          {{ __('NOMBRES Y APELLIDOS') }}
                      </th>
                      <th>
                        {{ __('CORREO') }}
                      </th>
                      <th>
                        {{ __('ROL DEL SISTEMA') }}
                      </th>
                      <th>
                        {{ __('ESTATUS') }}
                      </th>
                      <th class="text-right">
                        {{ __('ACCIONES') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr>
                          <td>
                            {{ $user->nombres }} {{ $user->apellidos }}
                          </td>
                          <td>
                            {{ $user->email }}
                          </td>
                          <td>                          
                            @foreach($user->roles as $role)
                                {{ $role->name }}                          
                            @endforeach                            
                          </td>
                          <td>
                          @if($user->esta_activo == 1)
                              ACTIVO
                          @elseif($categoria->esta_activo == 0)
                              INACTIVO
                          @endif
                          </td>
                          <td class="td-actions text-right">
                            @if ($user->id != auth()->id())
                              <form action="{{ route('users.destroy', $user) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('users.show', $user) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>                               
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('users.editar_persona', $user) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                    <a rel="tooltip" class="btn btn-warning btn-link" href="{{ route('users.edit_clave', $user) }}" data-original-title="" title="">
                                    <i class="material-icons">lock_open</i>
                                    <div class="ripple-container"></div>
                                  </a></a>

                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Seguro quieres eliminar este usuario?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>
                            @else
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('profile.edit') }}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection