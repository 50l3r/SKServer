<div class="container-full">
	<div class="row">
	    <div class="col-lg-12">
	      <h3><i class="fa fa-plus-square"></i> Nuevo Grupo</h3>
	      <form action="<?= base_url('grupos/nuevo') ?>" method="post" enctype="multipart/form-data">
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
										<img class="img-responsive" src="<?= base_url('img/recursos/nogavatar.jpg') ?>" />
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
											<input type="text" autofocus required name="GrupoNombre" class="form-control input-lg" placeholder="Nombre del Grupo" maxlength="45" />
											<span class="input-icon fui-user"></span>
										</div>
									</div>

									<div class="col-lg-2">
										<div class="form-group">
										<input type="number" required name="GrupoRango" class="form-control input-lg" placeholder="Rango del Grupo" maxlength="2" />
											<span class="input-icon fui-lock"></span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<textarea name="GrupoDescripcion" class="form-control noresize" maxlength="500" placeholder="Descripcion del Grupo"></textarea>
									</div>
								</div>

								<br />
								
								<div class="row visible-md visible-lg">
									<div class="col-lg-12">
										<div class="pull-right">
											<input type="submit" class="btn btn-success btn-block" value="Crear Grupo" />
										</div>
									</div>
								</div>

								<input type="submit" class="btn btn-success btn-block visible-xs visible-sm" value="Crear Usuario" />
							</div>
						</div>
					</div>
				</div>

				<!-- PROXIMA IMPORTACION DE GRUPOS MASIVA -->
			</form>
	    </div>
	</div>
</div>