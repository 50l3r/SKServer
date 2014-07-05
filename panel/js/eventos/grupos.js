var inte = false;

$(document).ready(function(){
    //ELIMINAR PERMISO USUARIO
    $(".actionGroup").click(function(event){ 
        event.preventDefault();
        inte = true;
        
        var action = $(this);

        $("#popEdit").fadeIn("fast",function(){
            var GrupoId = $(action).attr("data-id");
            var GrupoNombre = $(action).attr("data-nick");
       
            $("#MTitle").html(GrupoNombre);
            $("#MAvatar").attr("src",domain+"/gavatar/"+GrupoId);

            $("#MEditGroup").attr("href",domain+"/grupo/"+GrupoNombre);
            $("#MPermGroup").attr("href",domain+"/permisos-grupo/"+GrupoNombre);

            $("#FMDelGroup").children("input[name=GrupoId]").val(GrupoId);

            inte = false;
        });
    });

    $("#popEdit").click(function(){
        if(!inte){$("#popEdit").fadeOut("fast");}
    })
});