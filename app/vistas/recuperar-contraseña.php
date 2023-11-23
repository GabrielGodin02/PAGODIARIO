<body>
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
                      <div class="panel-body">
        
                        <form id="register-form" role="form" autocomplete="off" class="form" action="./php/actualizar-contraseña.php" method="post">
        
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                              <input id="email" name="id" placeholder="id usuario" class="form-control"  type="number">
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
</body>
