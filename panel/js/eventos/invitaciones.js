var inte = false;

$(document).ready(function(){
    $(".actionInvit").click(function(event){ 
        event.preventDefault();
        inte = true;
        
        var action = $(this);

        $("#popEdit").fadeIn("fast",function(){
            var InvitacionId = $(action).attr("data-id");
            var UsuarioNick = $(action).attr("data-nick");
            var InvitacionEstado = $(action).attr("data-status");
            var InvitacionEmail = $(action).attr("data-mail");

            $("#MTitle").html(UsuarioNick);
            $("#MEmail").html(InvitacionEmail);
            $("#MAvatar").attr("src",domain_parent+"/avatar/"+UsuarioNick);

            $("#MStatus").removeClass("label-danger,label-warning,label-success,label-default");
            if(InvitacionEstado==2){
                $("#MStatus").html("Caducada");
                $("#MStatus").addClass("label-warning");
            }else if(InvitacionEstado==1){
                $("#MStatus").html("Usada");
                $("#MStatus").addClass("label-danger");
            }else if(InvitacionEstado==0){
                $("#MStatus").html("Activa");
                $("#MStatus").addClass("label-success");
            }else{
                $("#MStatus").html("Desconocido");
                $("#MStatus").addClass("label-default");
            }   

            $("#FMDelInvi").children("input[name=InvitacionId]").val(InvitacionId);

            inte = false;
        });
    });

    $("#popEdit").click(function(){
        if(!inte){$("#popEdit").fadeOut("fast");}
    })



    $(".actionAdd").click(function(event){ 
        event.preventDefault();
        inte2 = true;

        $("#popAdd").fadeIn("fast",function(){
            inte2 = false;
        });
    });

    $(".closePop").click(function(){
        if(!inte2){$(this).closest('.popAction').fadeOut("fast");}
    })
});