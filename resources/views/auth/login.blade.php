
    <div class="modal"  role="dialog" tabindex="-1" id="modal-login">
    <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                  <div class="card card-login card-hidden mb-3">
                          <div class="card-header card-header-warning text-center">
                            <h4 class="card-title"><strong>{{ __('Login') }}</strong></h4>
                            <div class="social-line">
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                              <i class="fa fa-facebook-square"></i>
                            </a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                              <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                              <i class="fa fa-google-plus"></i>
                            </a>
                          </div>
                        </div>
                        <div class="card-body">
                          <h3 class="card-description text-center">{{ __('Ingrese su correo seguido su contraseña ') }} </h3>
                          <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">email</i>
                                </span>
                              </div>
                              <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="{{ old('email', 'franklinsmartinez@gmail.com') }}" required>
                            </div>
                            @if ($errors->has('email'))
                              <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                <strong>{{ $errors->first('email') }}</strong>
                              </div>
                            @endif
                          </div>
                          <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">lock_outline</i>
                                </span>
                              </div>
                              <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" value="{{ !$errors->has('password') ? "secret" : "" }}" required>
                            </div>
                            @if ($errors->has('password'))
                              <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                <strong>{{ $errors->first('password') }}</strong>
                              </div>
                            @endif
                          </div>
                          <div class="form-check mr-auto ml-3 mt-3">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recuerdame') }}
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </div>
                        <div class="card-footer justify-content-center">
                          <button type="submit" class="btn btn-warning btn-link btn-lg">{{ __('Entrar') }}</button>
                        </div>
                        
                  </div>
                    <div class="row">
                      <div class="col-6">
                          @if (Route::has('password.request'))
                              <a href="{{ route('password.request') }}" class="text-light">
                                  <small>{{ __('¿Olvido su contraseña?') }}</small>
                              </a>
                          @endif
                      </div>
                      <div class="col-6 text-right">
                          <a href="{{ route('register') }}" class="text-light">
                              <small>{{ __('Cree su cuenta') }}</small>
                          </a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </form>
</div>  


