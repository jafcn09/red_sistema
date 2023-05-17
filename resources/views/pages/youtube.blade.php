@extends('layouts.app', ['activePage' => 'youtube-management', 'titlePage' => __('YouTube')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="card card-plain">
        <div class="card-header card-header-warning">
          <h4 class="card-title">Youtube Premium</h4>
          <p class="card-category">Visualiza youtube sin restricciones ni publicidad
            <a target="_blank" href="https://www.youtube.com/?hl=es-419" class="text-info" >VER EN VENTANA NUEVA</a>
          </p>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="iframe-container d-none d-lg-block">
                <iframe src="https://www.youtube.com/embed/Fhhnr1eZR28">
                  <p>Your browser does not support iframes.</p>
                </iframe>
              </div>
              <div class="col-md-12 d-none d-sm-block d-md-block d-lg-none d-block d-sm-none text-center ml-auto mr-auto">
                <h5>Visualiza youtube sin restricciones ni publicidad
                  <a href="https://www.youtube.com/?hl=es-419" target="_blank">YouTube Premium En Nueva Ventana</a>
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection