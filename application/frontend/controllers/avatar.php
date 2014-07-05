<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avatar extends CI_Controller{

    public function __construct() {
        parent::__construct();
    }

    public function getAvatar($UsuarioNombre,$NoCache=false){ //Obtener avatar de un usuario
        $this->load->helper('minecraftskin');
        getMinecraftHead($UsuarioNombre,$NoCache);
    }

    public function getAvatarGrupo($Grupo){ //Obtener avatar de un grupo
        
        if(!is_numeric($Grupo)){
            $Grupo = $this->roles_model->getGrupo(null,$Grupo);
            if($Grupo){
                $GrupoId = $Grupo->GrupoId;
            }else{
                $GrupoId = 0;
            }
        }else{
            $GrupoId = $Grupo;
        }

        error_reporting(0);
        if(!is_numeric($GrupoId)){exit;}

        header("Content-type: image/jpeg");
        $image_p = imagecreatetruecolor(200, 200);

        $gen = false;

        $avatar_image = $this->config->item('imgrack_apath')."/gavatares/".$GrupoId.".".$this->config->item('img_config_gavatar')['sext'];
        $avatar_default = $this->config->item('imgrack_apath')."/recursos/nogavatar.jpg";



        if(file_exists($avatar_image)){
            if(@GetImageSize($avatar_image)){
                $image = imagecreatefromjpeg($avatar_image);
            }else{
                $image = imagecreatefromjpeg($avatar_default);
            }
        }else{
            $image = imagecreatefromjpeg($avatar_default);
        }

        if(!$image){$gen = true;$image = imagecreatefrompng($avatar_image);}

        imagecopyresampled($image_p, $image, 0, 0, 0, 0, 200, 200, 200, 200);

        if($gen){imagejpeg($image_p,$avatar_image);}else{imagejpeg($image_p);}

        
        imagedestroy($image_p);
    }
}