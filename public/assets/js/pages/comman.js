
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});


function update_delivery(element,field,id){
    var data = {'id':id};
    data[field] = element.value;
    var block_ele =$(element).closest('td');

    $.ajax({
        'method':'post',
        'data':data,
        'url':'/delivery-schedule/ajax-update',
        //'headers':{'X-CSRF-TOKEN':'{{ csrf_token() }}'},
        beforeSend:function(){
            $(block_ele).block({
                message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp;</div>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                },
                onBlock: function(){
                    clearTimeout();
                }
            });
        },
        success:function(res){
            onAjaxSuccess(res);

            if($(block_ele).hasClass('alert-success') && element.value == 'No') {
                $(block_ele).addClass('alert-danger');
                $(block_ele).removeClass('alert-success');
            }

            if($(block_ele).hasClass('alert-danger') && element.value == 'Yes') {
                $(block_ele).addClass('alert-success');
                $(block_ele).removeClass('alert-danger');
            }

            $(document).trigger('delivery_update',[element,field]);

        },
        complete:function(){
            onAjaxComplete(block_ele);
        },
        error:onAjaxErrorSweetAlert
    })
}

function beforeAjaxBlockUi(ele){
    $(ele).block({
        message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp;</div>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        },
        onBlock: function(){
            clearTimeout();
        }
    })
}

function onAjaxComplete(ele){
    $(ele).unblock();
}

function onAjaxSuccess(res){
    if(res.hasOwnProperty('msg')){
        $.blockUI({
            message: res.msg,
            fadeIn: 700,
            fadeOut: 700,
            timeout: 50000,
            showOverlay: false,
            centerY: false,
            css: {
                width: '400px',
                top: '20px',
                left: '',
                right: '20px',
                border: 'none',
                padding: '15px 5px',
                backgroundColor: '#16D39A',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: 0.9,
                color: '#fff'
            }
        });
        window.setTimeout(function () {
            $.unblockUI()
        }, 2000);
    }
}

function onAjaxErrorSweetAlert(xhr,statusText,thid){
    var errroMsg = "";

    if(xhr.status == 422){
        for (var property in xhr.responseJSON) {
            errroMsg += "<p>" + xhr.responseJSON[property] + "</p>"
        }
    }

    if(errroMsg == ""){
        errroMsg = 'There was an error while processing your request';
    }

    swal({
        title:'Error',
        text:errroMsg,
        html:'true',
        icon: "error",
        showCancelButton:false,
        confirmButtonText:'OK',
    })
}

