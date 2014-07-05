<div class="container-full">
	<div class="row">
	    <div class="col-lg-12">
	      <h2>
	      	<i class="fa fa-edit"></i> <?= $usuario->UsuarioNombre ?>
	      	<?php if($CI->auth('manage.user.roles',true)){ ?>
	      		<a href="<?= base_url('permisos-usuario/'.$usuario->UsuarioNick)?>" class="pull-right btn btn-primary btn-sm visible-md visible-lg"><i class="fa fa-rocket"></i>  &nbsp;Permisos</a>
	      	<?php } ?>
	      </h2>
	        <form action="<?= base_url('usuario/'.$usuario->UsuarioNick) ?>" method="post" enctype="multipart/form-data">
		        <div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-2 center">
								<div class="fileupload-preview thumbnail" >
									<img class="img-responsive" src="<?= avatar('avatar/'.$usuario->UsuarioNick) ?>" />
								</div>
							</div>

							<div class="col-lg-10">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<input type="text" autofocus name="UsuarioNick" class="form-control input-lg" placeholder="Nick de Usuario" value="<?= $usuario->UsuarioNick ?>" disabled maxlength="20" />
											<span class="input-icon fui-user"></span>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										<input type="text" name="UsuarioNombre" class="form-control input-lg" placeholder="Nombre de Usuario" value="<?= $usuario->UsuarioNombre ?>" maxlength="45" />
											<span class="input-icon fui-new"></span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<input type="password" name="UsuarioClave" class="form-control input-lg" placeholder="Clave de acceso" maxlength="20" />
													<span class="input-icon fui-lock"></span>
												</div>

											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<input type="password" name="UsuarioClave2" class="form-control input-lg" placeholder="Repite la clave" maxlength="20" />
													<span class="input-icon fui-lock"></span>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
											<input type="email" name="UsuarioCorreo" class="form-control input-lg" placeholder="Dirección de correo" value="<?= $usuario->UsuarioCorreo ?>" maxlength="360" />
											<span class="input-icon fui-mail"></span>
										</div>
									</div>
								</div>

								
								<div class="row">
									<div class="col-lg-12">
										<div class="pull-right visible-md visible-lg">
											<input type="submit" class="btn btn-inverse btn-block" value="Editar Usuario" />
										</div>

										<div class="row">
											<div class="col-lg-3 col-sm-9 col-xs-9">
												<?php if(!empty($grupos) && $CI->auth('edit.users.group',true)){ ?>
													<select class="select select-block" name="Grupo">
											            <option value="0">Asignar Grupo</option>
											            <?php foreach($grupos as $grupo){ ?>
											           		<option value="<?= $grupo->GrupoId ?>" <?php if($usuario->GrupoId==$grupo->GrupoId){echo "selected";}?>><?= $grupo->GrupoNombre ?></option>
											            <?php } ?>
											          </select>
										        <?php } ?>
										    </div>

										    <?php if(!empty($grupos) && $CI->auth('edit.users.group',true)){ ?>
											    <div class="col-lg-1 col-sm-3 col-xs-3">
											        <i class="fa fa-exclamation-triangle htip fa-2x" style="color:red;margin-top: 5px;" title="<small><b>ATENCION: Si cambias el grupo de un usuario es muy posible que limites su acceso a la plataforma</b></small>"></i>
										        </div>
									        <?php } ?>
									    </div>

									    <?php if($CI->auth('manage.user.roles',true)){ ?>
									    	<br />
										    <div class="row visible-xs visible-sm">
											    <div class="col-sm-12 col-xs-12">
											    	<a href="<?= base_url('permisos-usuario/'.$usuario->UsuarioNick)?>" class="btn btn-primary btn-block"><i class="fa fa-rocket"></i>  &nbsp;Permisos</a>
											    </div>
										    </div>
									    <?php } ?>

									    <br />

									    <div class="row visible-xs visible-sm">
										    <div class="col-sm-12 col-xs-12">
										    	<input type="submit" class="btn btn-inverse btn-block" value="Editar Usuario" />
										    </div>
									    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
	    </div>
	</div>
</div>