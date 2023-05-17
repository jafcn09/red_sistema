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
  <link rel="stylesheet" href="{{asset('front-end/sass/style.css') }}">

@endpush


<!-- Navbar -->
<!-- <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('welcome') }}">{{ $title }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="col-md-10 text-right menu-1">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="material-icons">dashboard</i> {{ __('Dashboard') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Register') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
        <li class="nav-item ">
          <a href="{{ route('profile.edit') }}" class="nav-link">
            <i class="material-icons">face</i> {{ __('Profile') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav> -->
<!-- Navbar -->
<!--  -->
<nav class="colorlib-nav" role="navigation">

<div class="top-menu">
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <div id="colorlib-logo"><img style="width:200px" src="{{ asset('img') }}/redsotec-transparente.png" alt="REDSOTEC"><a href="home"></a></div>
          </div>
          <div class="col-md-10 text-right menu-1">
            <ul>
              <li class=""><a href="{{ route('welcome') }}">Home</a></li>
              <li><a href="{{route('sobre_nosotros')}}">Sobre Nosotros</a></li>
              <li class="has-dropdown">
                <a href="{{route('planes')}}">Planes</a>
                <ul class="dropdown">
                @foreach ($planes as $plan)
                  <li class=""><a class="" href="{{route('planes')}}">{{ $plan->nombre }}</a></li>
                @endforeach
                </ul>
              </li>
              <li class="has-dropdown">
                <a href="{{route('servicios')}}">Servicios</a>
                <ul class="dropdown">
                  @foreach ($servicios as $servicio)
                    <li class=""><a class="" href="{{route('servicios')}}">{{ $servicio->nombre }}</a></li>
                  @endforeach
                </ul>
                <li class="has-dropdown">
                <a href="{{route('productos')}}">Productos</a>
                <ul class="dropdown">
                  @foreach ($productos as $producto)
                    <li class=""><a class="" href="{{route('productos')}}">{{ $producto->nombre }}</a></li>
                  @endforeach
                </ul>
              <li><a href="/promociones">Promociones</a></li>
              <li class="off-canvas-sidebar"><a href="/contacto">Contacto</a></li>
              <li class="btn-cta">
              <a href="" data-target="#modal-login" data-toggle="modal">
                            <button class="btn btn-info"> Acceso Clientes </button>
              </a>
            
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    </nav>
<!-- End Navbar -->

  <div class="colorlib-search">
    <div class="container">
      <div class="row">
        <div class="col-md-12 search-wrap">
          <div class="search-wrap-2">
          
            <h3 class="text-warning">Seleccione su plan ideal de Internet</h3><br>
                    <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <!-- <label for="course">Category Course</label> -->
                        <i style="color:#A0A6A5;">¿Necesita para?</i>
                        <div class="form-field">
                          <i class="icon icon-arrow-down3"></i>
                          <select name="categoria" id="categoria" class="custom-select" style="color:gray;height:40px">
                            <option value="Hogar">Hogar</option>
                            <option value="Negocio">Negocio</option>
                            <option value="Empresa">Empresa</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <!-- <label for="course">Category Course</label> -->
                        <i style="color:#A0A6A5;">¿El tamaño del area es?</i>
                        <div class="form-field">
                          <i class="icon icon-arrow-down3"></i>
                          <select name="tamanio" id="tamanio" class="custom-select" style="color:gray;height:40px">
                            <option value="pequenio">Pequeño</option>
                            <option value="mediano">Mediano</option>
                            <option value="grande">Grande</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <!-- <label for="difficulty">Difficulty</label> -->
                        <i style="color:#A0A6A5;">¿Cuantos dispositos tiene?</i>
                        <div class="form-field">
                          <i class="icon icon-arrow-down3"></i>
                          <select name="cantidad" id="cantidad" class="custom-select" style="color:gray;height:40px">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="21">Mas de 20</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                    <p></p>
                      <input type="submit" name="submit" id="submit" value="Buscar Plan" class="btn btn-warning btn-block">
                    </div>
                  </div>
              </div>
        </div>
      </div>
    </div>
  </div>
  @push('js')

<script>
    $(document).ready(function(){
         //Asignar productos
        $('#submit').click(function(){
            agregar();
        })
        
    });
    
    
    function agregar(){
        //Obtener datos de formulario 
        cat = $('#categoria').val();
        tam = $('#tamanio').val();
        can = $('#cantidad').val();
        can = Number(can); //If you need it back as a Number
        //Validar campos vacios
        if(cat != "" && tam != "" && can > 0)
        {
            //Comprobar categorias
            if(cat == "Hogar" && tam == "pequenio" && can < 5){
              $("#modal-delete-1").modal("show");
            }
            else if(cat == "Negocio" && tam == "pequenio" && can < 5){
              $("#modal-delete-2").modal("show");
            }
            else if(cat == "Empresa" && tam == "pequenio" && can < 5){
              $("#modal-delete-3").modal("show");
            }
            else if(cat == "Hogar" && tam == "mediano" && can > 0){
              $("#modal-delete-4").modal("show");
            }
            else if(cat == "Negocio" && tam == "mediano" && can > 0){
              $("#modal-delete-5").modal("show");
            }
            else if(cat == "Empresa" && tam == "mediano" && can > 0){
              $("#modal-delete-6").modal("show");
            }
            else if(cat == "Hogar" && tam == "grande" && can > 0){
              $("#modal-delete-7").modal("show");
            }
            else if(cat == "Negocio" && tam == "grande" && can > 0){
              $("#modal-delete-8").modal("show");
            }
            else if(cat == "Empresa" && tam == "grande" && can > 0){
              $("#modal-delete-9").modal("show");
            }
            else{
                alert('Error al ingresar los datos');    
            }
        }
    }

</script>
@endpush
<!-- Modal de muestra plan -->
@foreach($planes as $plan)
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$plan -> id}}">
    {{Form::open(array('action' => array('WelcomeController@contacto_store'), 'method' => 'post'))}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" style="display: block; margin-left: auto; margin-right: auto;">
                    <h4 class="modal-title">Su plan ideal es: <strong class="text-info">{{$plan -> nombre}}</strong> </h4>
                    <h4 class="modal-title">Con capacidad de: <strong class="text-info">{{$plan -> capacidad}} Mbps</strong> </h4>
                    <h4 class="modal-title">Al precio de: <strong class="text-info">{{$plan -> precio}} $</strong> </h4>
                </div>
       
                <form class="form" method="post" action="/contacto_store">
              @csrf
                <div class="card-body">
                <h4 class="text-gray" style="display: block; margin-left: auto; margin-right: auto;">Ingrese sus datos para contactarl@</h4>
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

                <input type="text" name="plan_id" value="{{$plan->id}}" hidden/>
                <input type="text" name="es_internet" value="1" hidden/>

                </div>
              <div class="modal-footer justify-content-center">
              <button type="submit" class="btn btn-warning">Solicitar</button>
              </div>
              </form>

            </div>
        </div>
    {{Form::close()}}
</div>
@endforeach
<!-- FIN Modal de muestra plan -->