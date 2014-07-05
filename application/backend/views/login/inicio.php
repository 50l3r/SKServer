<div class="login-bg hidden-xs hidden-sm">
  <div class="login-screen">
    <div class="row login-title">
      <div class="col-md-4 col-md-offset-4">
          <center>
              <img src="<?= base_url('img/recursos/logo.png') ?>" alt="Logo">
          </center>
      </div>
    </div>

    <br />

    <div class="row">
      <div class="col-md-5">
        <div class="login-icon">
          <img id="login-icon" src="<?= base_url('img/icons/Bag.png') ?>" alt="Welcome to Mail App">
          <img id="login-icon-1" src="<?= base_url('img/icons/Love.png') ?>" alt="Welcome to Mail App" style="display:none">
          <img id="login-icon-2" src="<?= base_url('img/icons/Lock.png') ?>" alt="Welcome to Mail App" style="display:none">
        </div>
      </div>

      <div class="col-md-7">
        <div class="login-form">
          <form action="<?= base_url('login') ?>" method="post">
            <div class="form-group">
              <input id="username" name="username" autofocus type="text" class="form-control login-field" value="" placeholder="Introduce tu usuario" maxlength="20" autocomplete="off" keyev="true" clickev="true" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); padding-right: 0px; background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat no-repeat;">
              <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="form-group">
              <input id="password" name="password" type="password" class="form-control login-field" value="" placeholder="Contraseña" maxlength="20" autocomplete="off" keyev="true" clickev="true" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); padding-right: 0px; background-attachment: scroll; cursor: auto; background-position: 100% 50%; background-repeat: no-repeat no-repeat;">
              <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>

            <input type="submit" class="btn btn-inverse btn-lg btn-block" value="Entrar">
            <a class="login-link" href="#">¿Olvidaste tu contraseña?</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="hidden-md hidden-lg login-bg-sm">
  <div class="row login-title">
      <div class="col-sm-12"><center><img class="img-responsive" src="<?= base_url('img/recursos/logo.png') ?>" alt="Login" /></center></div>
  </div>

  <p>&nbsp;</p>

  <div class="col-sm-12">
    <form action="<?= base_url('login') ?>" method="post">
      <div class="form-group">
        <input id="username" name="username" autofocus type="text" class="form-control login-field" value="" placeholder="Introduce tu usuario" maxlength="20" autocomplete="off" keyev="true" clickev="true" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); padding-right: 0px; background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat no-repeat;">
      </div>

      <div class="form-group">
        <input id="password" name="password" type="password" class="form-control login-field" value="" placeholder="Contraseña" maxlength="20" autocomplete="off" keyev="true" clickev="true" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); padding-right: 0px; background-attachment: scroll; cursor: auto; background-position: 100% 50%; background-repeat: no-repeat no-repeat;">
      </div>

      <input type="submit" class="btn btn-inverse btn-lg btn-block" value="Entrar">
      <a class="login-link" href="#">¿Olvidaste tu contraseña?</a>
    </form>
  </div>
</div>

<script>
  $(document).ready(function(){
      $("#username").keypress(function() {
        $("#login-icon").hide("fast",function(){
            $("#login-icon-2").hide("fast",function(){
              $("#login-icon-1").show("fast");
            });
        });
      });  

      $("#password").keypress(function() {
        $("#login-icon-1").hide("fast",function(){
          $("#login-icon").hide("fast",function(){
            $("#login-icon-2").show("fast");
          });
        });
      });
  });
</script> 
