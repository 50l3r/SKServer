$(document).ready(function(){
    ////////////////////////
    // USUARIOS
    ////////////////////////

    //ELIMINAR PERMISO USUARIO
    $(".delScope").click(function(event){ 
        event.preventDefault();
 
        var form = $(this);

        $.ajax({
          type: "POST",
          url: domain+"/roles/UserScope",
          data: {
            UsuarioId: $(form).attr("data-user"),
            RolId: $(form).attr("data-role"),
            Type: 2
          },
          dataType: "json"
        }).done(function( data ) {
            if(data.estado==1){
                var fat = $(form).closest(".btn-auth");
                var but = $(fat).children(".btn-authInfo");

                $(fat).children(".authScope,.banScope").remove();
                $(fat).children(".delScope").html("<i class='fa fa-info-circle'></i>");
                $(form).attr("data-original-title","<small>Este permiso ha sido <b>ELIMINADO</b> recientemente. Actualice la pagina para ver los cambios.</small>");

                $(but).removeClass("btn-success btn-danger btn-default");$(but).addClass("btn-default");

                $(fat).children(".delScope").removeClass(".delScope");
            }else{showNotify(data);}
        });
    });

    //AUTORIZAR PERMISO
    $(".authScope").click(function(event){ 
        event.preventDefault();
 
        var form = $(this);

        $.ajax({
          type: "POST",
          url: domain+"/roles/UserScope",
          data: {
            UsuarioId: $(form).attr("data-user"),
            RolId: $(form).attr("data-role"),
            Type: 1
          },
          dataType: "json"
        }).done(function( data ) {
            if(data.estado==1){
                var fat = $(form).closest(".btn-auth");
                var but = $(fat).children(".btn-authInfo");

                $(fat).children(".delScope,.banScope").remove();
                $(fat).children(".authScope").html("<i class='fa fa-info-circle'></i>");
                $(form).attr("data-original-title","<small>Este permiso ha sido <b>AUTORIZADO</b> recientemente. Actualice la pagina para ver los cambios.</small>");

                $(but).removeClass("btn-success btn-danger btn-default");$(but).addClass("btn-success");

                $(fat).children(".authScope").removeClass(".authScope");
            }else{showNotify(data);}
        }); 
    });

    //PROHIBIR PERMISO
    $(".banScope").click(function(event){ 
        event.preventDefault();
 
        var form = $(this);

        $.ajax({
          type: "POST",
          url: domain+"/roles/UserScope",
          data: {
            UsuarioId: $(form).attr("data-user"),
            RolId: $(form).attr("data-role"),
            Type: 3
          },
          dataType: "json"
        }).done(function( data ) {
            if(data.estado==1){
                var fat = $(form).closest(".btn-auth");
                var but = $(fat).children(".btn-authInfo");

                $(fat).children(".delScope,.authScope").remove();
                $(fat).children(".banScope").html("<i class='fa fa-info-circle'></i>");
                $(form).attr("data-original-title","<small>Este permiso ha sido <b>PROHIBIDO</b> recientemente. Actualice la pagina para ver los cambios.</small>");

                $(but).removeClass("btn-success btn-danger btn-default");$(but).addClass("btn-danger");

                $(fat).children(".banScope").removeClass(".banScope");
            }else{showNotify(data);}
        }); 
    });


    ////////////////////////
    // GRUPOS
    ////////////////////////


    //ELIMINAR PERMISO GRUPO
    $(".delGScope").click(function(event){ 
        event.preventDefault();
 
        var form = $(this);

        $.ajax({
          type: "POST",
          url: domain+"/roles/GroupScope",
          data: {
            GrupoId: $(form).attr("data-group"),
            RolId: $(form).attr("data-role"),
            Type: 2
          },
          dataType: "json"
        }).done(function( data ) {
            if(data.estado==1){
                var fat = $(form).closest(".btn-auth");
                var but = $(fat).children(".btn-authInfo");

                $(fat).children(".delGScope").html("<i class='fa fa-info-circle'></i>");
                $(form).attr("data-original-title","<small>Este permiso ha sido <b>ELIMINADO</b> recientemente. Actualice la pagina para ver los cambios.</small>");

                $(but).removeClass("btn-success btn-default");$(but).addClass("btn-default");

                $(fat).children(".delGScope").removeClass(".delGScope");
            }else{showNotify(data);}
        });
    });

    //AUTORIZAR PERMISO
    $(".authGScope").click(function(event){ 
        event.preventDefault();
 
        var form = $(this);

        $.ajax({
          type: "POST",
          url: domain+"/roles/GroupScope",
          data: {
            GrupoId: $(form).attr("data-group"),
            RolId: $(form).attr("data-role"),
            Type: 1
          },
          dataType: "json"
        }).done(function( data ) {
            if(data.estado==1){
                var fat = $(form).closest(".btn-auth");
                var but = $(fat).children(".btn-authInfo");

                $(fat).children(".delScope").remove();
                $(fat).children(".authGScope").html("<i class='fa fa-info-circle'></i>");
                $(form).attr("data-original-title","<small>Este permiso ha sido <b>AUTORIZADO</b> recientemente. Actualice la pagina para ver los cambios.</small>");

                $(but).removeClass("btn-success btn-default");$(but).addClass("btn-success");

                $(fat).children(".authGScope").removeClass(".authGScope");
            }else{showNotify(data);}
        }); 
    });
});