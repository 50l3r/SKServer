var domain = "http://"+document.domain+"/panel";
var domain_parent = "http://"+document.domain;

$(document).ajaxSend(function(e, xhr, options) {
  var csrf_token = $("meta[name=csrf-token]").attr("content");
  options.data = options.data+"&"+$("meta[name=csrf-name]").attr("content")+"="+csrf_token;
});

$(document).ready(function(){
    /////////////////////////
    // FORMS
    /////////////////////////
    $("button.alink, a.alink").click(function(event){
        event.preventDefault();
        if($(this).attr('rel')){
            if($(this).hasClass('advertise')){
                if (confirm('¿Estas seguro de querer realizar esta accion?')) {
                    document.location.href=$(this).attr('rel');
                }
            }else{
                document.location.href=$(this).attr('rel');
            }
        }
    });

    $("button.slink, a.slink").click(function (event) {
        event.preventDefault();
        if($(this).hasClass('advertise')){
            if (confirm('¿Estas seguro de querer realizar esta accion?')) {
               $(this).closest("form").submit();
            }
        }else{
            $(this).closest("form").submit();
        }
    });

    $("button.srlink, a.srlink").click(function (event) {
        event.preventDefault();
        var scope = $(this).attr("data-scope");
        
        if(scope){
            if($(this).hasClass('advertise')){
                if (confirm('¿Estas seguro de querer realizar esta accion?')) {
                   $("#"+scope).closest("form").submit();
                }
            }else{
                $("#"+scope).closest("form").submit();
            }
        }
    });

    $("input").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $(this).closest('form').submit();
        }
    });

    $("select.select").selectpicker({style: 'btn-primary', menuStyle: 'dropdown-inverse'});

    /////////////////////////
    // TOOLTIP
    /////////////////////////
    $('.tip').tooltip({
        animation: true,
        html: false,
        placement: 'top',
    });

    $('.hrtip').tooltip({
        animation: true,
        html: true,
        placement: 'right',
    })

    $('.htip').tooltip({
        animation: true,
        html: true,
        placement: 'top',
    })
});

function showNotify(data){
    if(data){
        if(data.mensaje){
          var nclass = "info";
          var ntitle = "Info";

          if(data.estado==1){
            nclass = "success";
            ntitle = "Hecho";
          }else if(data.estado==0){
            nclass = "error";
            ntitle = "Error";
          }

          $.pnotify({
              title: ntitle,
              text: data.mensaje,
              addclass: 'pine_mobile',
              type: nclass,
              mouse_reset: false
          });
        }
    }
}