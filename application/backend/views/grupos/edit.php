<div class="container-full">
	<div class="row">
	    <div class="col-lg-12">
	      <h2>
	      	<i class="fa fa-edit"></i> <?= $grupo->GrupoNombre ?>
	      	<?php if($CI->auth('manage.group.roles',true)){ ?>
	      		<a href="<?= base_url('permisos-grupo/'.$grupo->GrupoNombre)?>" class="pull-right btn btn-primary btn-sm visible-md visible-lg"><i class="fa fa-rocket"></i>  &nbsp;Permisos</a>
	      	<?php } ?>
	      </h2>
	      <form action="<?= base_url('grupo/'.$grupo->GrupoNombre) ?>" method="post" enctype="multipart/form-data">
		      <div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-2 center">
								<?php
									$cn= "<small><b>Dimensiones mínimas:</b><br><i>".$this->config->item('img_config_gavatar')['width']."px x ".$this->config->item('img_config_gavatar')['height']."px</i><br><b>Extensiones permitidas:</b><br>".$this->config->item('img_config_gavatar')['allowed_types']."</small>";
								?>

								<div class="fileupload fileupload-new" data-provides="fileupload">
									<i class="fileupload-info fa fa-bookmark fa-2x hrtip" title="<?= $cn ?>"></i>
									<div class="fileupload-preview thumbnail" >
										<img class="img-responsive" src="<?= avatar('gavatar/'.$grupo->GrupoId) ?>" />
									</div>
									<div>
										<span class="btn btn-inverse btn-file">
											<span class="fileupload-new">Seleccionar Avatar</span><span class="fileupload-exists">Cambiar</span><input type="file" name="GrupoAvatar" />
										</span>

										<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Borrar</a>
									</div>
								</div>
							</div>

							<div class="col-lg-10">
								<div class="row">
									<div class="col-lg-10">
										<div class="form-group">
											<input type="text" autofocus required name="GrupoNombre" class="form-control input-lg" placeholder="Nombre del Grupo" value="<?= $grupo->GrupoNombre ?>" maxlength="45" />
											<span class="input-icon fui-user"></span>
										</div>
									</div>

									<div class="col-lg-2">
										<div class="form-group">
										<input type="number" required name="GrupoRango" class="form-control input-lg" placeholder="Rango del Grupo" value="<?= $grupo->GrupoRango ?>" maxlength="2" />
											<span class="input-icon fui-lock"></span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<textarea name="GrupoDescripcion" class="form-control noresize" maxlength="500" placeholder="Descripcion del Grupo"><?= $grupo->GrupoDescripcion ?></textarea>
									</div>
								</div>

								<?php if($CI->auth('manage.user.roles',true)){ ?>
							    	<br />
								    <div class="row visible-xs visible-sm">
									    <div class="col-sm-12 col-xs-12">
									    	<a href="<?= base_url('permisos-grupo/'.$grupo->GrupoNombre)?>" class="btn btn-primary btn-block"><i class="fa fa-rocket"></i>  &nbsp;Permisos</a>
									    </div>
								    </div>
							    <?php } ?>

								<br />
								
								<div class="row visible-lg visible-md">
									<div class="col-lg-12">
										<div class="pull-right">
											<input type="submit" class="btn btn-inverse btn-block" value="Editar Grupo" />
										</div>
									</div>
								</div>

								<div class="row visible-sm visible-xs">
									<div class="col-lg-12">
										<input type="submit" class="btn btn-inverse btn-block" value="Editar Grupo" />
									</div>
								</div>

								<br />
							</div>
						</div>
					</div>
				</div>
			</form>
	    </div>
	</div>
</div>