$(document).ready(function(){
	$("#check_username").click(function(){
		var UsuarioNick = $("input[name='UsuarioNick']").val();

		$.ajax({
          	type: "POST",
          	url: domain+"/checkAvailable",
	        data: {
	            UsuarioNick: UsuarioNick,
	        },
          	dataType: "json"
        }).done(function( data ) {  	
		  	if(data.estado==1){
				$("#FUser").submit();
		  	}else{
		  		showNotify(data);
		  	}
		});
	});
});