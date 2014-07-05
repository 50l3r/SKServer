<?php

	function upload_img($filename,$config,$urlpath = false,$folderpath, $Current_image=null){
		$CI =& get_instance();

		if(empty($filename) || empty($config)){return false;}
		list($ancho, $alto, $tipo, $atributos) = @getimagesize($_FILES[$filename]['tmp_name']);
            
        $limits = $CI->config->item($config);
        if($ancho>=$limits['width'] && $alto>=$limits['height']){
            $gconfig = $CI->config->item('img_config');

            if(!empty($limits['allowed_types'])){$gconfig['allowed_types'] = $limits['allowed_types'];}
            
            $CI->load->library('upload', $gconfig);

            if (!$CI->upload->do_upload($filename)){
                $err = $CI->upload->display_errors();
                if($urlpath){set_error($err,$urlpath,true,2);}else{exitError("003");}
            }else{
                $imgdata = array('upload_data' => $CI->upload->data());

                $user_path = $CI->config->item('imgrack_apath')."/".$folderpath;

                $ifinalname = rand(0,99).time().$imgdata['upload_data']['file_ext'];
                $finalname = $user_path."/".$ifinalname;
                
                if(!empty($Current_image)){unlink($user_path."/".$Current_image);}
            
                if($ancho==$limits['width'] && $alto==$limits['height']){
                	if (!copy($imgdata['upload_data']['full_path'],$finalname)) {
                		deleteTmpImage($imgdata['upload_data']['full_path']);
					    if($urlpath){set_error('019',$urlpath,false,2);}else{exitError("019");}
					}else{
						deleteTmpImage($imgdata['upload_data']['full_path']);
                        return $ifinalname;
					}
                }else{
                    if($limits['maxsize']){
                        if(empty($CI->image_moo)){$CI->load->library('image_moo');}
                        $avatar_thumb = $CI->image_moo
                                        ->load($imgdata['upload_data']['full_path'])
                                        ->set_background_colour("#000")
                                        ->resize_crop($limits['width'],$limits['height'])
                                        ->save($finalname);
                        
                        deleteTmpImage($imgdata['upload_data']['full_path']); 

                        if(empty($CI->image_moo->error)){
                            return $ifinalname;
                        }else{
                             if($urlpath){set_error('019',$urlpath,false,2);}else{exitError("019");}
                        }
                    }else{
                        if (!copy($imgdata['upload_data']['full_path'],$finalname)) {
                            deleteTmpImage($imgdata['upload_data']['full_path']);
                            if($urlpath){set_error('019',$urlpath,false,2);}else{exitError("019");}
                        }else{
                            deleteTmpImage($imgdata['upload_data']['full_path']);
                            return $ifinalname;
                        }
                    }
                }
            }
        }else{
            if($urlpath){set_error('022',$urlpath,false,2);}else{exitError("022");}
        }

        echo "asasdasda";
	}

	function deleteTmpImage($path){
		unlink($path);
	}

?>