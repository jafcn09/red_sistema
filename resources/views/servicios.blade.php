@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'servicios', 'title' => __('REDSOTEC')])

@push('style')
<link rel="stylesheet" href="{{asset('front-end/css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{asset('front-end/css/icomoon.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{asset('front-end/css/bootstrap.css') }}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('front-end/css/magnific-popup.css') }}">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{asset('front-end/css/flexslider.css') }}">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="{{asset('front-end/css/owl.carousel.min.css') }}">

	
	<!-- Flaticons  -->
	<link rel="stylesheet" href="{{asset('front-end/fonts/flaticon/font/flaticon.css') }}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{asset('front-end/css/style.css') }}">

@endpush
        <!--    Alertas al registrar en la tabla contacto-->
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    <!--    FIN Alertas al registrar en la tabla contacto-->
<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url({{asset('img/linea-conexion-fondo.jpg') }});">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-sm-12 col-md-offset-3 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h1>Nuestros Servicios</h1>
				   					<h2 class="breadcrumbs"><span><a href="/">Home</a></span> | <span>Servicios</span></h2>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
    @section('content')
		
		<div class="colorlib-trainers">
			<div class="container">
            @foreach($services as $servicio)
            <div class="col-md-4 col-sm-4 animate-box">
				<div class="row row-pb-md">
						<div class="trainers-entry">
							<div class="desc">
								<h3>{{$servicio->nombre}}</h3>
								<span>realizado por expertos por tan solo <strong class="text-warning">{{$servicio->precio}}</strong> Dólares</span>
							</div>
							<div class="trainer-img" style="background-image: url({{ asset('uploads') }}/servicios/{{$servicio->imagen}})"></div>
							<div class="desc">
								<p>
									<ul class="colorlib-social-icons">
										<li><a class="btn btn-warning"><i class="material-icons">emoji_objects</i></a></li>
										<li><a class="btn btn-info"><i class="material-icons">gavel</i></a></li>
										<li><a class="btn btn-warning"><i class="material-icons">build</i></a></li>
										<li><a class="btn btn-info"><i class="material-icons">thumb_up_alt</i></a></li>
                                        <li><a class="btn btn-warning"><i class="material-icons">emoji_objects</i></a></li>
										<li><a class="btn btn-info"><i class="material-icons">gavel</i></a></li>
										<li><a class="btn btn-warning"><i class="material-icons">build</i></a></li>
										<li><a class="btn btn-info"><i class="material-icons">thumb_up_alt</i></a></li>
									</ul>
								</p>
								<p>{{$servicio->descripcion}}</p>
                <button data-target="#signupModal{{$servicio->id}}" data-toggle="modal" style="display: block; margin-left: auto; margin-right: auto;" class="btn btn-info">Solicitar</button>

							</div>
						</div>
				</div>
            </div>
                    @endforeach
			</div>
		</div>
        @push('js')
<script>
  <script src="{{asset('front-end/js/modernizr-2.6.2.min.js')}}"></script>
  <!-- jQuery -->
	<script src="front-end/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="front-end/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="front-end/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="front-end/js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="front-end/js/jquery.stellar.min.js"></script>
	<!-- Flexslider -->
	<script src="front-end/js/jquery.flexslider-min.js"></script>
	<!-- Owl carousel -->
	<script src="front-end/js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="front-end/js/jquery.magnific-popup.min.js"></script>
	<script src="front-end/js/magnific-popup-options.js"></script>
	<!-- Counters -->
	<script src="front-end/js/jquery.countTo.js"></script>
	<!-- Main -->
	<script src="front-end/js/main.js"></script>
</script>
@endpush
@endsection
<!--    Modal al registrar en la tabla contacto datos de servicios y productos-->
    @foreach($services as $servicio)
    <div class="modal fade" id="signupModal{{$servicio->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-signup" role="document">
    <div class="modal-content">
      <div class="card card-signup card-plain">
        <div class="modal-header">
          <h3 class="modal-title card-title" style="display: block; margin-left: auto; margin-right: auto;">Ingrese sus los siguientes datos</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="material-icons">clear</i>
          </button>
        </div>

              <form class="form" method="post" action="/contacto_store">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <input type="text" name="nombres" class="form-control" placeholder="Ingrese sus 2 nombres..." required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">how_to_reg</i>
                        </span>
                        <input type="text" name="apellidos" class="form-control" placeholder="Ingrese sus 2 apellidos..." required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone_android</i>
                        </span>
                        <input type="number" name="celular" class="form-control" placeholder="Ingrese su número celular..." required>
                    </div>
                  </div>

                <div class="form-group">
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="material-icons">email</i>
                      </span>
                      <input type="email" name="email" class="form-control" placeholder="Ingrese su dirección de correo...">
                  </div>
                </div>

                <input type="text" name="servicio_id" value="{{$servicio->id}}" hidden/>
                <input type="text" name="es_servicio" value="1" hidden/>

                <div class="form-check">
                  <label class="form-check-label">
                      Ha seleccionado un <a class="text-info">{{$servicio->nombre}}</a>.
                  </label>
                </div>
                </div>
              <div class="modal-footer justify-content-center">
              <button type="submit" class="btn btn-warning">Solicitar</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
<!--    FIN Modal al registrar en la tabla contacto-->