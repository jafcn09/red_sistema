@extends('layouts.app', ['activePage' => 'emby-management', 'titlePage' => __('Emby Peliculas')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="card card-plain">
        <div class="card-header card-header-warning">
          <h4 class="card-title">Emby Peliculas</h4>
          <p class="card-category">Lista de peliculas para disfrute de nuestros clientes
            <a target="_blank" href="https://allcalidad.net/" class="text-info" >VER EN VENTANA NUEVA</a>
          </p>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="iframe-container">
                <iframe src="https://allcalidad.net/">
                  <p>Your browser does not support iframes.</p>
                </iframe>
              </div>
              <div class="col-md-12 d-none d-sm-block d-md-block d-lg-none d-block d-sm-none text-center ml-auto mr-auto">
                <h5>Lista de peliculas para disfrute de nuestros clientes
                  <a href="https://allcalidad.net/" target="_blank">Emby Server</a>
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