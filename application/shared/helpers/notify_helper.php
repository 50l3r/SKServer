<?php

function showNotify($error,$titulo = "Informacion!") {
	if(!empty($error)){
        $CI =&get_instance();
        $sta = $CI->session->userdata('Error_Sta');
		$errores = explode("\n",$error); $errores = array_values(array_diff($errores, array(''))); $contador=0;$html = "";
        
        foreach($errores as $error){ $contador ++;
            if(empty($sta)){$sta="info";}
            $html.= "<script>
                        $.pnotify({
                            title: '".$titulo."',
                            text: '".str_replace(array("<p>","</p>"), "",$error)."',
                            addclass: 'pine_mobile',
                            type: '".$sta."',
                            mouse_reset: false,
                            //hide: false
                        });
                    </script>";
        }
		 
        unset_error();
		return $html;
	} 
}

function exitError($error){
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    die(json_encode(array("error" => getError($error,true))));
}

function getError($error,$string=false){ //Obtenemos codigo de error
    $CI =&get_instance();
    $msgerr = $CI->lang->line('msg_error');
    if(!empty($msgerr[$error])){if($string){return $msgerr[$error]["mensaje"];}else{return $msgerr[$error];}}else{return false;}
}

function set_error($error,$tolink,$act=false, $error_sta="error"){ //Establecemos en sesion el error
    if(empty($error)){return false;}
    if($act){
        $sess_array = array(
            'Error' => array(
                    'titulo' => 'Error!',
                    'mensaje' => $error
            ),'Error_Sta' => $error_sta

        );
    }else{
        $sess_array = array(
            'Error' => getError($error),
            'Error_Sta' => $error_sta
        );
    }

	$CI =&get_instance();
	$CI->session->set_userdata($sess_array);

	redirect(base_url($tolink));	
}

function unset_error(){ //Limpiamos la notificacion
	$CI =&get_instance();
    $array_items = array('Error' => '', 'Error_Sta' => '');
    $CI->session->unset_userdata($array_items);
}

function retrieve_error(){
	$CI =&get_instance();
	$error = $CI->session->userdata('Error');
	if(!empty($error)){ return $error;}else{return false;}
}

?>
