<?php
	
	function set_resources($source,$type=null){
		if(!empty($source) && ($type=="header" || $type=="footer")){
			$CI =&get_instance();
			$resources = $CI->config->item('resources');
			if(!empty($resources[$source])){
				if(is_array($resources[$source])){
					foreach($resources[$source] as $res){
						if($type=="header"){
							echo set_resource_header($res);
						}else{
							echo set_resource_footer($res);
						}
					}
				}
			}
		}
	}

	function set_resource_header($Recurso){
		if(!empty($Recurso)){
			switch($Recurso){
				case "UPLOAD":
					$css = "<!-- Image Upload -->
							<link href=\"".base_url('js/plugins/forms/jasny-fileupload/css/fileupload.css')."\" rel=\"stylesheet\">";
				break;

				case "NOTIFY":
					$css = "<!-- Pines Notifications Plugin -->
							<link href=\"".base_url('js/plugins/notifications/pines/jquery.pnotify.default.css')."\" rel=\"stylesheet\" />";
				break;

				default:
					return false;
			}

			echo $css;
		}else{
			return false;
		}
	}


	

	function set_resource_footer($Recurso){
		if(!empty($Recurso)){
			switch($Recurso){
				case "UPLOAD":
					$js = "<!-- Image Upload -->
							<script src=\"".base_url('js/plugins/forms/jasny-fileupload/js/bootstrap-fileupload.js')."\"></script>";
				break;

				case "NOTIFY":
					$js = "	<!-- Pines Notifications Plugin -->
							<script src=\"".base_url('js/plugins/notifications/pines/jquery.pnotify.js')."\"></script>
							<script>
								$.pnotify.defaults.styling = 'bootstrap';
								$.pnotify.defaults.history = false;
							</script>";
				break;

				case "MOMENT":
					$js = "<!-- pretty photo -->
							<script src=\"".base_url('js/plugins/date/moment+langs.min.js')."\" type=\"text/javascript\"></script>";
				break;

				case "HANDLEBARS":
					$js = "<!-- HandleBars -->
							<script src=\"".base_url('js/plugins/system/handlebars/handlebars-1.0.rc.1.min.js')."\"></script>
							<script src=\"".base_url('js/plugins/system/handlebars/handlebars_helpers.js')."\"></script>";
				break;

				case "ROLES":
					$js = "<!-- Roles -->
							<script src=\"".base_url('js/eventos/roles.js')."\"></script>";
				break;

				case "USUARIOS":
					$js = "<!-- Roles -->
							<script src=\"".base_url('js/eventos/usuarios.js')."\"></script>";
				break;

				case "GRUPOS":
					$js = "<!-- Roles -->
							<script src=\"".base_url('js/eventos/grupos.js')."\"></script>";
				break;

				case "INVITACIONES":
					$js = "<!-- Roles -->
							<script src=\"".base_url('js/eventos/invitaciones.js')."\"></script>";
				break;


				default:		
					return false;
			}

			echo $js;
		}else{
			return false;
		}
	}

	function avatar($URL){
		return "http://".$_SERVER['SERVER_NAME']."/".$URL;
	}
?>