Handlebars.registerHelper('if_eq', function(a, b, opts) {
    if(a == b) // Or === depending on your needs
        return opts.fn(this);
    else
        return opts.inverse(this);
});

Handlebars.registerHelper('if_greather', function(a, b, opts) {
    if(a > b) // Or === depending on your needs
        return opts.fn(this);
    else
        return opts.inverse(this);
});

Handlebars.registerHelper('if_less', function(a, b, opts) {
    if(a < b) // Or === depending on your needs
        return opts.fn(this);
    else
        return opts.inverse(this);
});

Handlebars.registerHelper('substring', function(a, b, opts) {
    if(a.length>b){
        return new Handlebars.SafeString(a.substring(0,b)+"...");
    }else{
        return new Handlebars.SafeString(a);
    }
});

Handlebars.registerHelper('implode', function(a, b, opts) {
    return matriz = a.split(b);
});

var plantilla = new Array();

function getPlantilla(template,data,callback){
    if(data===null){data = "";}
    if(plantilla[template]){
        if(callback){callback();}
    }else{
        $.ajax({
          type: "POST",
          url: domain+"/mustache",
          data: {tmp: template, data: data},
          dataType: "json"
        }).done(function(dtp) {
            if(dtp.estado==1){
                plantilla[template] = Handlebars.compile(dtp.template);
                if(callback){callback();}
            }
        });
    }
}