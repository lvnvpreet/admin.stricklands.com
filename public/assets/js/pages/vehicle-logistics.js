var switches = document.querySelectorAll('.switchery');
var url = new URL(window.location.href);
var switchery = [];
for (i = 0; i < switches.length; i++) {
    //Assign Switchery to Them
    switchery[switches[i].name] = new Switchery(switches[i], { color: '#37BC9B',className: 'switchery switchery-sm' });

    //Add OnChange Event
    switches[i].addEventListener('change',function(){
        console.log(this.name);
        var params = {'stock_no':url.searchParams.get('stock_no')};
        params[this.name] = this.value;
        var input = this;
        var container  = $(this).closest('.row');
        $.ajax({
            url: '/vehicle-logistics/update-indication',
            method:'POST',
            data:params,
            beforeSend:function(){ beforeAjaxBlockUi(container) },
            complete:function(){ onAjaxComplete(container);},
            success:function(res){
                onAjaxSuccess(res);
            },
            error:onAjaxErrorSweetAlert
        })
    })
}

(function($){

    $(document).ready(function(){
        $("#date").datetimepicker({format:'YYYY-MM-DD'});
        $("#time").datetimepicker({format:'hh:mm',stepping:30});

        $("#add-note").click(function(){
            var note = $("#new-note").val();
            var v_stock_no = $("#v_stock_no").val();
            if(note != ""){
                var container = $(this).closest('.card-footer');

                $.ajax({
                    url:'/vehicle-logistics/add-note',
                    method:'POST',
                    data:{stock_no:v_stock_no,note:note},
                    beforeSend:function(){ beforeAjaxBlockUi(container)},
                    complete:function(){
                        onAjaxComplete(container);
                    },
                    success:function(res){
                        onAjaxSuccess(res);
                        $("#new-note").val('');

                        var ul = document.getElementById('vehicle-notes');
                        var li = ul.children[0].cloneNode(true);
                        li.firstElementChild.innerHTML = note;
                        li.children[1].innerHTML = "By <b>" + res.by + "</b> on <b>" + res.on + "</b>";
                        ul.insertBefore(li,ul.firstChild);
                    },
                    error:onAjaxErrorSweetAlert
                })
            }
        })


        //Submit a Transfer Request
        var TransferRequestForm = document.getElementById('tranfer-request');
        TransferRequestForm.addEventListener('submit',function(event){
            event.preventDefault();

            var container = $(TransferRequestForm).closest('.card-content');
            var param = {};
            for(var i=0;i<TransferRequestForm.elements.length;i++){
                if(TransferRequestForm.elements[i].name != "" && TransferRequestForm.elements[i].value != ""){
                    param[TransferRequestForm.elements[i].name] = TransferRequestForm.elements[i].value
                }
            }
            if(url.searchParams.get('stock_no')){
                param['stock_no'] = url.searchParams.get('stock_no');
            }else{
                param['stock_no'] = window.stock_no;
            }


            if(!param.hasOwnProperty('date')){
                $(TransferRequestForm.date).focus();
                return;
            }
            if(param.hasOwnProperty('date') && !param.hasOwnProperty('time')){
                $(TransferRequestForm.time).focus();
                return;
            }


            $.ajax({
                url:'/vehicle-logistics/add-transfer-request',
                method:'POST',
                data:param,
                beforeSend:function(){ beforeAjaxBlockUi(container)},
                complete:function(){
                    onAjaxComplete(container);
                },
                success:function(res){
                    onAjaxSuccess(res);
                    TransferRequestForm.reset();
                },
                error:onAjaxErrorSweetAlert
            })
        });
    })
})(jQuery);
