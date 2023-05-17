
@extends('layouts.app', ['activePage' => 'role-management', 'titlePage' => __('Role Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title ">{{ __('Roles') }}</h4>
                <p class="card-category"> {{ __('Aqui administras los roles') }}</p>
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
                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-warning">{{ __('Agregar Rol') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="card-header-warning">
                      <th>
                          {{ __('NOMBRE') }}
                      </th>
                      <th>
                        {{ __('SLOGAN') }}
                      </th>
                      <th>
                        {{ __('DESCRIPCIÓN') }}
                      </th>
                      <th>
                        {{ __('PERMISO ESPECIAL') }}
                      </th>
                      <th class="text-right">
                        {{ __('ACCIÓN') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($roles as $role)
                        <tr>
                          <td>
                            {{ $role->name }}
                          </td>
                          <td style="width:250px">
                            {{ $role->slug }}
                          </td>
                          <td style="width:350px">
                            {{ $role->description }}
                          </td>
                          <td>
                            {{ $role->special }}
                          </td>
                          <td class="td-actions text-right">
                              <form action="{{ route('roles.destroy', $role) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('roles.show', $role) }}" data-original-title="" title="">
                                    <i class="material-icons">face</i>
                                    <div class="ripple-container"></div>                              
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('roles.edit', $role) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("¿Esta seguro de eliminar el Rol?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>

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