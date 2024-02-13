<main>
  <style>
    @import url(public/css/style-recovery.css);
  </style>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <div class="form-gap"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Perdiste tu Contraseña?</h2>
              <p>Puede restablecer su contraseña aquí.</p>
              <div class="panel-body login">
                <form id="register-form" role="form" autocomplete="off" class="form" action="/recuperacion" method="post">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope color-blue"></i></span>
                      <input id="email" name="ident" placeholder="Numero de documento" class="form-control" min="1" type="number">
                    </div>
                  </div>
                  <div class="form-group">
                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                  </div>
                  <input type="hidden" class="hide" name="token" id="token" value="">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>