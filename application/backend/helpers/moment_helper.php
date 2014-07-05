<?php

function moment($ptime){
    if(!isTimestamp($ptime)){
        $ptime = strtotime($ptime);
        if(!isTimestamp($ptime)){return false;}
    }

    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'año',
                30 * 24 * 60 * 60       =>  'mes',
                24 * 60 * 60            =>  'dia',
                60 * 60                 =>  'hora',
                60                      =>  'minuto',
                1                       =>  'segundo'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            if($str=="mes"){
                $pl = "es";
            }else{
                $pl = "s";
            }
            return 'hace '. $r . ' ' . $str . ($r > 1 ? 's' : '');
        }
    }
}

function isTimestamp( $string ) {
    return ( 1 === preg_match( '~^[1-9][0-9]*$~', $string ) );
}  

?>