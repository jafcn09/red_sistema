@extends('layouts.app', ['activePage' => 'emby-musica-management', 'titlePage' => __('Emby Musica')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="card card-plain">
        <div class="card-header card-header-warning">
          <h4 class="card-title">Emby Musica</h4>
          <p class="card-category">Lista de canciones para disfrute de nuestros clientes
            <a target="_blank" href="https://musicaeu.com/" class="text-info" >VER EN VENTANA NUEVA</a>
          </p>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="iframe-container d-none d-lg-block">
                <iframe src="https://musicaeu.com/">
                  <p>Your browser does not support iframes.</p>
                </iframe>
              </div>
              <div class="col-md-12 d-none d-sm-block d-md-block d-lg-none d-block d-sm-none text-center ml-auto mr-auto">
                <h5>Lista de canciones para disfrute de nuestros clientes
                  <a href="https://musicaeu.com/" target="_blank">Emby Server</a>
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