$(document).ready(function(){
	var Registro = false;

	// [ENTER] CHEQUEO INVITACION
	$("input[name='DInvitCode']").keypress(function(e){
		if (e.which == 13) {
			$("#check_invitcode").click();
		}
	});

	//CHEQUEO INVITACION
	$("#check_invitcode").click(function(){
		var InvitCode = $("input[name='DInvitCode']").val();

		$.ajax({
          	type: "POST",
          	url: domain+"/checkInvitCode",
          	data: {
            	InvitCode: InvitCode,
          	},
          	dataType: "json"
        }).done(function( data ) {
		  	if(data.estado==1){
		  		$("input[name='InvitCode']").val(InvitCode);

		  		$("#InvitFor").html("<b>"+data.invitacion.UsuarioNick+"</b>");
		  		$("#minecraft_avatar").attr("src",domain+"/avatar/"+data.invitacion.UsuarioNick+"/1");

		  		enableSignUp(data);
		  	}else{
		  		showNotify(data);
		  	}
		});
	});

	//HABILITAR REGISTRO
	function enableSignUp(data){
		$("#SignUp-Lock").fadeOut("fast",function(){
  			//DESHABILITAMOS FORMULARIO DE INVITACIONES
  			$("input[name='DInvitCode']").attr("readonly",true);
  			var InvitCode = $("#check_invitcode");
  			$(InvitCode).removeClass("btn-info");
  			$(InvitCode).unbind("click");

  			//ENFOCAMOS USUARIO Y ACTIVAMOS
  			var UsuarioNick = $("input[name='DUsuarioNick']");
  			$(UsuarioNick).removeAttr("readonly");
  			$(UsuarioNick).focus();

  			//ACTIVAMOS CHEQUEO DE USUARIO
  			var ISubmit = $("#check_username");
  			$(ISubmit).removeClass("btn-default");
  			$(ISubmit).addClass("btn-success");

  			
  			//MOSTRAMOS INFO OK
  			$("#checkStatusInvit").html("<i class='fa fa-check' style='color:#58d68d'></i>&nbsp;&nbsp;");
  			$("#InvitInfo").html("Invitación asociada al correo: <b>"+data.invitacion.InvitacionEmail+"</b>");

  			// [ENTER] CHEQUEO INVITACION
  			$("input[name='DUsuarioNick']").keypress(function(e){
				if (e.which == 13) {
					$("#check_username").click();
				}else{
					$("input[name='UsuarioNick']").val("");
					Registro = false;
				}
			});

  			//CHEQUEAR USUARIO
  			$("#check_username").click(function(){
				var UsuarioNick = $("input[name='DUsuarioNick']").val();

				$.ajax({
		          	type: "POST",
		          	url: domain+"/checkAvailable",
			        data: {
			            UsuarioNick: UsuarioNick,
			        },
		          	dataType: "json"
		        }).done(function( data ) {  	
				  	if(data.estado==1){
				  		$("input[name='UsuarioNick']").val(UsuarioNick);
					  	$("#FUser").submit();
				  	}else{
				  		showNotify(data);
				  	}
				});
			});
  		});
	}
});