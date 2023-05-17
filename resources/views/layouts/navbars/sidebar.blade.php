<div class="sidebar" data-color="orange" data-background-color="black" data-image="{{ asset('material') }}/img/sidebar-7.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal">
      <img style="width:200px" src="{{ asset('img/redsotec-transparente.png') }}">
    </a>
  </div> 
  <div class="sidebar-wrapper">
    <ul class="nav">
      @if(auth()->user()->can('home')) 
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('mikrotik.index'))
      <li class="nav-item{{ $activePage == 'mikrotik_management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('mikrotik.index') }}">
          <i class="material-icons">widgets</i>
            <p>{{ __('Mikrotik Dashboard') }}</p>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('users.index'))
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management' || $activePage == 'role-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="false" class="nav-link" >
          <i><img style="width:25px; background-color:white;" src="{{ asset('material') }}/img/account_box-24px.svg"></i>
          <p>{{ __('Administrar Usuarios') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExample">
          <ul class="nav">
          @if(auth()->user()->can('profile.edit'))
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Usuario perfil') }} </span>
              </a>
            </li>
          @endif
          @if(auth()->user()->can('users.index'))
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('users.index') }}">
                <span class="sidebar-mini"> UA </span>
                <span class="sidebar-normal"> {{ __('Usuarios Administrar') }} </span>
              </a>
            </li>
          @endif
          @if(auth()->user()->can('roles.index'))
            <li class="nav-item{{ $activePage == 'role-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('roles.index') }}">
                <span class="sidebar-mini"> RA </span>
                <span class="sidebar-normal"> {{ __('Roles Administrar') }} </span>
              </a>
            </li>
          @endif
          </ul>
        </div>
      </li>
      @endif
      @if(auth()->user()->can('clientes.index'))
      <li class="nav-item {{ ($activePage == 'cliente-management' || $activePage == 'contrato-management' || $activePage == 'plane-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#AdminCliente" aria-expanded="false" class="nav-link" >
          <i><img style="width:25px; background-color:white;" src="{{ asset('material') }}/img/perm_identity-24px.svg"></i>
          <p>{{ __('Administrar Clientes') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="AdminCliente">
          <ul class="nav">
          @if(auth()->user()->can('clientes.index'))
            <li class="nav-item{{ $activePage == 'cliente-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('clientes.index') }}">
                <i class="material-icons">filter_1</i>
                  <p>{{ __('Clientes') }}</p>
              </a>
            </li>
          @endif
          @if(auth()->user()->can('contratos.index'))
            <li class="nav-item{{ $activePage == 'contrato-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('contratos.index') }}">
                <i class="material-icons">filter_2</i>
                  <p>{{ __('Contratos') }}</p>
              </a>
            </li>
          @endif
          @if(auth()->user()->can('planes.index'))
            <li class="nav-item{{ $activePage == 'plane-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('planes.index') }}">
                <i class="material-icons">filter_3</i>
                  <p>{{ __('Planes') }}</p>
              </a>
            </li>
          @endif
          </ul>
        </div>
      </li>
      @endif
      @if(auth()->user()->can('categorias.index'))
      <li class="nav-item {{ ($activePage == 'categoria' || $activePage == 'producto-management' || $activePage == 'servicio-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#AdminInventario" aria-expanded="false" class="nav-link" >
          <i><img style="width:25px; background-color:white;" src="{{ asset('material') }}/img/drag_indicator-24px.svg"></i>
          <p>{{ __('Administrar Inventario') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="AdminInventario">
          <ul class="nav">
          @if(auth()->user()->can('categorias.index'))  
            <li class="nav-item{{ $activePage == 'categoria_management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('categorias.index') }}">
                      <i class="material-icons">filter_1</i>
                        <p>{{ __('Categorias') }}</p>
                    </a>
            </li>
          @endif
          @if(auth()->user()->can('productos.index'))
            <li class="nav-item{{ $activePage == 'producto_management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('productos.index') }}">
                      <i class="material-icons">filter_2</i>
                        <p>{{ __('Productos') }}</p>
                    </a>
            </li>
          @endif
          @if(auth()->user()->can('productos.inventario'))
            <li class="nav-item{{ $activePage == 'inventario' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('productos.inventario') }}">
                      <i class="material-icons">filter_3</i>
                        <p>{{ __('Productos Inventario') }}</p>
                    </a>
            </li>
          @endif
          @if(auth()->user()->can('servicios.index'))
            <li class="nav-item{{ $activePage == 'servicio_management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('servicios.index') }}">
                      <i class="material-icons">filter_3</i>
                        <p>{{ __('Servicios') }}</p>
                    </a>
            </li>
          @endif
            </ul>
      </li>
      @endif
      @if(auth()->user()->can('enlaces.index'))
      <li class="nav-item {{ ($activePage == 'enlace-management' || $activePage == 'nodo-management' || $activePage == 'torre-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#AdminDispositivo" aria-expanded="false" class="nav-link" >
          <i><img style="width:25px;background-color:white;" src="{{ asset('material') }}/img/group_work-24px.svg"></i>
          <p>{{ __('Administrar Dispositivos') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="AdminDispositivo">
          <ul class="nav">
          @if(auth()->user()->can('enlaces.index'))
            <li class="nav-item{{ $activePage == 'enlace-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('enlaces.index') }}">
                      <i class="material-icons">filter_1</i>
                        <p>{{ __('Enlaces') }}</p>
                    </a>
            </li>
            @endif
            @if(auth()->user()->can('nodos.index'))
            <li class="nav-item{{ $activePage == 'nodo-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('nodos.index') }}">
                      <i class="material-icons">filter_2</i>
                        <p>{{ __('Nodos') }}</p>
                    </a>
            </li>
            @endif
            @if(auth()->user()->can('torres.index'))
            <li class="nav-item{{ $activePage == 'torre-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('torres.index') }}">
                      <i class="material-icons">filter_3</i>
                        <p>{{ __('Torres') }}</p>
                    </a>
            </li>
            @endif

            </ul>
      </li>
      @endif
      @if(auth()->user()->can('facturas.index'))
      <li class="nav-item{{ $activePage == 'facturas' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('facturas.index') }}">
                <i class="material-icons">content_paste</i>
                  <p>{{ __('Facturas') }}</p>
              </a>
      </li>
      @endif
      @if(auth()->user()->can('tareas.index'))
      <li class="nav-item{{ $activePage == 'tarea-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('tareas.index') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Lista de Tareas') }}</p>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('empleados.index'))
      <li class="nav-item{{ $activePage == 'empleado-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('empleados.index') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Listado de empleados') }}</p>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('empresas.index'))
      <li class="nav-item{{ $activePage == 'empresa-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('empresas.index') }}">
          <i class="material-icons">account_balance</i>
            <p>{{ __('Datos Empresa') }}</p>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('pages.youtube'))
      <li class="nav-item{{ $activePage == 'youtube-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pages.youtube') }}">
        <i><img style="width:28px; height:25px" src="{{ asset('img/youtube.jpg') }}"></i>
            <p>{{ __('YouTube Premiun') }}</p>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('pages.emby'))
      <li class="nav-item{{ $activePage == 'emby-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pages.emby') }}">
        <i><img style="width:30px; height:25px" src="{{ asset('img/emby.png') }}"></i>
          <p>{{ __('Emby Peliculas') }}</p>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('pages.emby'))
      <li class="nav-item{{ $activePage == 'emby-musica-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pages.emby-musica') }}">
        <i><img style="width:30px; height:25px" src="{{ asset('img/emby-music.png') }}"></i>
          <p>{{ __('Emby Música') }}</p>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('pages.notifications'))
      <li class="nav-item{{ $activePage == 'notificationes' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pages.notifications') }}">
        <i class="material-icons">notifications</i>
          <p>{{ __('Notificationes') }}</p>
        </a>
      </li>
      @endif

    </ul>
  </div>
</div>