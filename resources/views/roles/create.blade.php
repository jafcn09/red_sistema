@extends('layouts.app', ['activePage' => 'role-management', 'titlePage' => __('Role Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-warning">
                <h4 class="card-title">{{ __('Crear Rol') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('roles.index') }}" class="btn btn-sm btn-warning">{{ __('Regresar') }}</a>
                  </div>
                </div>
                <div>
                    {!! Form::open(['route' => 'roles.store']) !!}
                        @include('roles.partials.form')
                    {!! Form::close() !!}
              </div>
              </div>
            </div>
         </div>
        </div>
      </div>
    </div>
  </div>
 </div>
@push('js')
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>
@endpush
@endsection