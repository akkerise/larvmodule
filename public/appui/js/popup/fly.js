//Init fly
fly = function(params){
    params = $.extend(params);
};

//Navigate
fly.navigate = function(df){
    params = $(location).attr("hash").replace('#', '').split('/');
    if(params.length <= 1 && params[0] == ''){
        params = df.split('/');
    }
    fly.navigate.action(params);
    $(window).bind('hashchange', function() {
        params = $(location).attr("hash").replace('#', '').split('/');
        /*if(params.length <= 1 && params[0] == ''){
            params = df.split('/');
        }*/
        fly.navigate.action(params);
    });
};
    
fly.navigate.action = function(params){
    for(var i = params.length; i > 0; i--){
        try{
            var action = window[params[0]];
        }
        catch(err){}
        for(var j = 1; j < i; j++){
            try{
                action = action[params[j]];
            }
            catch(err){}
        }
        try{
            action(params);
            break;
        }
        catch(err){
            console.log(err);
            //document.location = '#';
        }
    }
};

//Build template
fly.template = function(template, data){
    return new EJS({
        url: fly.assetsUrl + fly.templatePath + template
    }).render(data);
};

//Ajax call
fly.ajax = function(params){
    params = $.extend({
        method:'get',
        loading: true
    }, params);
    if(params.loading){
        loading.show();
    }
    $.ajax({
        url: baseUrl + params.service,
        type: params.method,
        data: params.data,
        dataType: 'json',
        async: params.async,
        success:function(result){
            if(params.loading){
                loading.hide();
            }
            if(!result.status && result.message == '-signin'){
                viewer = null;
                document.location = '#auth';
            }
            else{
                params.success(result);
            }
        },
        error:function(){
            if(params.loading){
                loading.hide();
            }
            popup.msg('Có lỗi xảy ra trong quá trình truyền dữ liệu, xin hãy kiểm tra lại kết nối mạng!');
        }
    });
};

//Ajax submit form
fly.submit = function(params){
    para = {
        data:$('#'+params.id).serialize(), 
        success:function(result){
            if(result.success){
                params.success(result);
            }
            else{
                var $form = $('#'+params.id);
                var formData = $form.serialize().split('&');
                $(formData).each(function () {
                        $(this).parent().parent().removeClass('error');
                        $(this).next('.help-block').remove();
                        if($(this).attr('name') && result.data[$(this).attr('name').replace(/.*\[/,'').replace(/\].*/,'')]){
                            $(this).parent().parent().addClass('error');
                            $(this).after('<span class="help-block">'+result.data[$(this).attr('name').replace(/.*\[/,'').replace(/\].*/,'')]+'</span>');
                        }
                });
                params.success(result);
            }
        }, 
        service: params.service, 
        method:'post'
    };
    fly.ajax(para);
};


//Ajax submit form
fly.submitWithFile = function(params){
    var action = baseUrl + params.service + '.json';
    if (!$('#upload-iframe-submit').length){
        $('body').append('<iframe id="upload-iframe-submit" name="upload-iframe-submit" style="display:none" />');
    }
    $('#'+params.id).attr('target', 'upload-iframe-submit');
    $('#'+params.id).attr('action', action);
    $('#'+params.id).attr('method', 'post');
    $('#'+params.id).attr('enctype', 'multipart/form-data');
    $('#'+params.id).submit();
    $('#upload-iframe-submit').load(function (){
        try{
            var result = $('#upload-iframe-submit').contents().find('body');
            result = $.parseJSON(result.text());
            if(params.loading){
                loading.hide();
            }
            if(result.success){
                params.success(result);
            }else{
                if(result.message){
                    popup.msg(result.message);
                }
            }
        }
        catch(err){
            if(params.loading){
                loading.hide();
            }
            popup.msg('Lỗi trong quá trình xử lý, thông báo kỹ thuật để được hỗ trợ.');
        }
    });
};