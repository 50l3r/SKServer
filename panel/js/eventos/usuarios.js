var inte = false;

$(document).ready(function(){
    //ELIMINAR PERMISO USUARIO
    $(".actionUser").click(function(event){ 
        event.preventDefault();
        inte = true;
        
        var action = $(this);

        $("#PopEdit").fadeIn("fast",function(){
            var UsuarioId = $(action).attr("data-id");
            var UsuarioNick = $(action).attr("data-nick");
            var UsuarioEstado = $(action).attr("data-status");
       
            $("#MTitle").html(UsuarioNick);
            $("#MAvatar").attr("src",domain_parent+"/avatar/"+UsuarioNick);

            $("#MEditUser").attr("href",domain+"/usuario/"+UsuarioNick);
            $("#MPermUser").attr("href",domain+"/permisos-usuario/"+UsuarioNick);

            $("#FMStatUser").children("input[name=UsuarioId]").val(UsuarioId);
            $("#FMStatUser").children("a").removeClass("btn-danger,btn-warning");
            if(UsuarioEstado==2){
                $("#FMStatUser").children("a").addClass("btn-danger");
                $("#FMStatUser").children("a").html("Desbloquear");
            }else{
                $("#FMStatUser").children("a").addClass("btn-warning");
                $("#FMStatUser").children("a").html("Bloquear");
            }

            $("#MStatus").removeClass("label-danger,label-warning,label-success,label-default");
            if(UsuarioEstado==2){
                $("#MStatus").html("Bloqueado");
                $("#MStatus").addClass("label-danger");
            }else if(UsuarioEstado==1){
                $("#MStatus").html("Activo");
                $("#MStatus").addClass("label-success");
            }else if(UsuarioEstado==0){
                $("#MStatus").html("Inactivo");
                $("#MStatus").addClass("label-warning");
            }else{
                $("#MStatus").html("Desconocido");
                $("#MStatus").addClass("label-default");
            }   

            $("#FMDelUser").children("input[name=UsuarioId]").val(UsuarioId);

            inte = false;
        });
    });

    $("#PopEdit").click(function(){
        if(!inte){$("#PopEdit").fadeOut("fast");}
    })
});