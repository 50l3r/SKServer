<div class="container-full">
	<div class="row">
	    <div class="col-lg-12">
	      <h2><i class="fa fa-plus-square"></i> Nuevo Usuario</h2>
	      <form action="<?= base_url('usuarios/nuevo') ?>" method="post" enctype="multipart/form-data">
		      <div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-2 center">
								<?php
									$cn= "<small><b>Dimensiones mínimas:</b><br><i>".$this->config->item('img_config_avatar')['width']."px x ".$this->config->item('img_config_avatar')['height']."px</i><br><b>Extensiones permitidas:</b><br>".$this->config->item('img_config_avatar')['allowed_types']."</small>";
								?>

								<div class="fileupload fileupload-new" data-provides="fileupload">
									<i class="fileupload-info fa fa-bookmark fa-2x hrtip" title="<?= $cn ?>"></i>
									<div class="fileupload-preview thumbnail" >
										<img class="img-responsive" src="<?= base_url('img/recursos/noavatar.jpg') ?>" />
									</div>
									<div>
										<span class="btn btn-inverse btn-file">
											<span class="fileupload-new">Seleccionar Avatar</span><span class="fileupload-exists">Cambiar</span><input type="file" name="UsuarioAvatar" />
										</span>

										<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Borrar</a>
									</div>
								</div>
							</div>

							<div class="col-lg-10">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<input type="text" autofocus required name="UsuarioNick" class="form-control input-lg" placeholder="Nick de Usuario" maxlength="20" />
											<span class="input-icon fui-user"></span>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
										<input type="text" name="UsuarioNombre" class="form-control input-lg" placeholder="Nombre de Usuario" maxlength="45" />
											<span class="input-icon fui-new"></span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<input required type="password" name="UsuarioClave" class="form-control input-lg" placeholder="Clave de acceso" maxlength="20" />
													<span class="input-icon fui-lock"></span>
												</div>

											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<input required type="password" name="UsuarioClave2" class="form-control input-lg" placeholder="Repite la clave" maxlength="20" />
													<span class="input-icon fui-lock"></span>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="form-group">
											<input type="email" required name="UsuarioCorreo" class="form-control input-lg" placeholder="Dirección de correo" maxlength="360" />
											<span class="input-icon fui-mail"></span>
										</div>
									</div>
								</div>

								
								<div class="row">
									<div class="col-lg-12">
										<div class="pull-right visible-md visible-lg">
											<input type="submit" class="btn btn-success btn-block" value="Crear Usuario" />
										</div>

										<div class="row">
											<div class="col-lg-3">
												<?php if(!empty($grupos) && $CI->auth('add.groups',true)){ ?>
													<select class="select select-block" name="Grupo">
											            <option value="0" selected="selected">Asignar Grupo</option>
											            <?php foreach($grupos as $grupo){ ?>
											           		<option value="<?= $grupo->GrupoId ?>"><?= $grupo->GrupoNombre ?></option>
											            <?php } ?>
											          </select>
										        <?php } ?>
									        </div>
									    </div>

									    <br />
									    
										<input type="submit" class="btn btn-success btn-block visible-xs visible-sm" value="Crear Usuario" />
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- PROXIMA IMPORTACION DE USUARIOS MASIVA -->
			</form>
	    </div>
	</div>
</div>