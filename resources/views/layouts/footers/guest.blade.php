  <div id="colorlib-subscribe" class="subs-img" style="background-image: url({{ asset('img') }}/tecnologia-internet.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
          <h2>Suscribete a nuestros boletines informativos</h2>
          <p>Suscribete y mantente al día de las últimas actualizaciones e información</p>
        </div>
      </div>
      <div class="row animate-box">
        <div class="col-md-6 col-md-offset-3">
          <div class="row">
            <div class="col-md-12">
            <form class="form-inline qbstp-header-subscribe" method="post" action="/contacto_store">
            @csrf
            <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-8">
                
                  <input onkeyup="mayus(this);" style="width: 100%;" class="form-control text-white" type="email" id="input-email"  name="email" id="email" placeholder="Ingrese su dirección de correo" required>
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                </div>
                <input type="text" name="es_suscripcion" value="1" hidden>
              </div>

              <div class="col-one-third">
                <div class="form-group">
                  <button type="submit" class="btn btn-warning">Suscribete Ahora</button>
                </div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  <footer id="colorlib-footer">
    <div class="container">
      <div class="row row-pb-md">
        <div class="col-md-3 colorlib-widget">
          <h4>información de Contacto</h4>
          <ul class="colorlib-footer-links">
            <li>Panamericana norte con tila maria, <br> Oe8-290. Quito Ecuador</li>
            <li><a href="tel://+59322023703"><i class="icon-phone"></i> + 593 2 202 37 93</a></li>
            <li><a href="tel://+593985786064"><i class="icon-phone"></i> + 593 098 578 60 64</a></li>
            <li><a href="mailto:franklinsmartinez@gmail.com"><i class="icon-envelope"></i> franklinsmartinez@gmail.com</a></li>
            <li><a href="https://www.redsotec.com"><i class="icon-location4"></i> www.redsotec.com</a></li>
          </ul>
        </div>
        <div class="col-md-2 colorlib-widget">
          <h4>Planes</h4>
          <p>
            <ul class="colorlib-footer-links">
              <li><a href="/planes"><i class="icon-check"></i> Hogar Basic</a></li>
              <li><a href="/planes"><i class="icon-check"></i> Negocio Basic </a></li>
              <li><a href="/planes"><i class="icon-check"></i> Empresa Basic</a></li>
              <li><a href="/planes"><i class="icon-check"></i> Hogar Medium</a></li>
              <li><a href="/planes"><i class="icon-check"></i> Comercio Medium</a></li>
              <li><a href="/planes"><i class="icon-check"></i> Empresa Medium</a></li>
              <li><a href="/planes"><i class="icon-check"></i> Hogar Advance</a></li>
              <li><a href="/planes"><i class="icon-check"></i> Comercio Advance</a></li>
              <li><a href="/planes"><i class="icon-check"></i> Empresa Advance</a></li>
            </ul>
          </p>
        </div>
        <div class="col-md-2 colorlib-widget">
          <h4>Nuestros Servicios</h4>
          <p>
            <ul class="colorlib-footer-links">
              <li><a href="/servicios"><i class="icon-check"></i> Reparación PC</a></li>
              <li><a href="/servicios"><i class="icon-check"></i> Reparación Laptop</a></li>
              <li><a href="/servicios"><i class="icon-check"></i> Electrónica</a></li>
              <li><a href="/servicios"><i class="icon-check"></i> Sistemas Incendios</a></li>
              <li><a href="/servicios"><i class="icon-check"></i> Telefonía</a></li>
              <li><a href="/servicios"><i class="icon-check"></i> Telecomunicaciones</a></li>
            </ul>
          </p>
        </div>

        <div class="col-md-2 colorlib-widget">
          <h4>Productos</h4>
          <p>
            <ul class="colorlib-footer-links">
              <li><a href="/productos"><i class="icon-check"></i> Routers</a></li>
              <li><a href="/productos"><i class="icon-check"></i> Switchs</a></li>
              <li><a href="/productos"><i class="icon-check"></i> Cable UTP &amp; RJ45</a></li>
              <li><a href="/productos"><i class="icon-check"></i> Reguladores</a></li>
              <li><a href="/productos"><i class="icon-check"></i> Canaletas</a></li>
              <li><a href="/productos"><i class="icon-check"></i> UPS y mas</a></li>
            </ul>
          </p>
        </div>

        <div class="col-md-3 colorlib-widget">
          <h4>Agregados Recientemente</h4>
          <div class="f-blog">
            <a href="promociones" class="blog-img" style="background-image: url({{ asset('front-end') }}/images/blog-1.jpg);">
            </a>
            <div class="desc">
              <h2><a href="promociones">Plan Empresarial Advance</a></h2>
              <p class="admin"><span>22 Octubre 2019</span></p>
            </div>
          </div>
          <div class="f-blog">
            <a href="promociones" class="blog-img" style="background-image: url({{ asset('front-end') }}/images/blog-2.jpg);">
            </a>
            <div class="desc">
              <h2><a href="promociones">Plan Comercio Medium</a></h2>
              <p class="admin"><span>20 Octubre 2019</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copy">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <p>
              <small class="block">&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Creative Commons &copy;<script>document.write(new Date().getFullYear());</script> Derechos reservados | Este proyecto fue elaborado con <i class="icon-heart" aria-hidden="true"></i> por <a href="https://www.redsotec.com" target="_blank">REDSOTEC</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></small><br> 
              <small class="block">Autor: <a href="https://www.facebook.com/franklinsmartinez" target="_blank">Franklin Santiago Martinez</a></small>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>

<div class="gototop js-top">
  <a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
</div>
@push('js')
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>
@endpush