function reschedule()
{
    var today = new Date();
    var start;
    today.setHours(0);
    today.setMinutes(0);
    today.setSeconds(0);
    var date = $("#datepicker").datepicker('getDate');
    var slot = $('input[name=slot]:checked').val();
    var slot_id = $('input[name=slot]:checked').attr('id');
    var order_id = $("input[name='job_id']").val();
    var now = today.getTime();
    if(Date.parse(date) < Date.parse(today) || date == null) 
    {
        $(".day_error").removeClass("hidden");
        return false;
    }
    else 
    {
        $(".day_error").addClass("hidden");
    } 
    
    if(typeof slot === "undefined")
    {
        alert('slot undefined');
        return false;
    }
    else
    {
        start = new Date("November 13, 2017 " + slot.substr(0,8));
        start = start.getTime();
    }
      
    if(now >= start)
    {
            alert("not allowed");
            $(".slot_error").removeClass("hidden");
            return false;
    }
    else
    {
        $.ajax({
            method: "POST",
            url: "{{url('orders/reschedule_order')}}",
            data: {order_id:order_id, slot_id:slot_id},
            success: function(response)
            {
                $("#flash_message").html(response.html);
                setTimeout(function(){ $("#flash_message").html("");}, 10000);
            },
            error: function()
            {
                    alert('error');
            }
        });	
    }
}

function assign_technician(url, job_type)
{
    $.ajax({
        url:url,
        data: {job_type:job_type},
        success: function(response){
            $("#assign").html(response.html).modal({backdrop: 'static', keyboard: false})                
        },
        error: function(){

        }
    }); 
}

function assign_technician_to_order(url, tech_id, order_id)
{
    $.ajax({
        method: "POST",
        url: url,
        data:{tech_id:tech_id, order_id:order_id},
        success: function(response){
            $(".close").click();
            $("#flash_message").html(response.html);
            setTimeout(function(){ $("#flash_message").html("");}, 10000);
        }, 
        error: function(){
            
        }
    });
}

function reject_order(e, url, list_all)
{
    var job_id = $(e).closest('ul').attr('id');
    var status = $(e).attr('status');
    var reason_of_reject = null;
    var reason_of_reject = null;
    bootbox.prompt({
            title:"Reason of rejection",
            onEscape:false,
            backdrop:false,
            closeButton:false,
            callback:function(reason_of_reject)
            {
                if(reason_of_reject != null && reason_of_reject != "")
                    change_job_status(url, list_all, e, status, job_id, reason_of_reject);
            }
    });	       
}

function finish_order(e, url, list_all, payment_url)
{
alert("finished");
    var job_id = $(e).closest('ul').attr('id');
    var status = $(e).attr('status');
    bootbox.prompt({
        title:"Enter payment amount",
        inputType:'number',
        onEscape:false,
        backdrop:false,
        closeButton:true,
        callback:function(amount)
        {
            var saved = save_payment(job_id, amount, payment_url);
            $(".bootbox-close-button.close").click();
            change_job_status(url, list_all, e, status, job_id);
        }
    });	       
}

function change_status_at_all(url, list_all, e)
{
    var job_id = $(e).closest('ul').attr('id');
    var status = $(e).attr('status');
    bootbox.confirm({message: "Are you sure you want to update the order status?",
       callback: function (result) {
           if(result === true)
           {
               change_job_status(url, e, status, job_id, list_all);
           }
       }
    });
}

function change_job_status(url, e, status, job_id, list_all, reason_of_reject = null)
{

   var ul = $(e);
   $.ajax({ 
        method: "post",
        data: {status: status, job_id: job_id, reason_of_reject: reason_of_reject},
        url: url, 
        success: function(response) 
        {     
        
            if((response.new_status == 'rejected' || response.new_status == 'canceled'))
            {

                $(e).closest('ul').find('li:not(:first)').remove();
            }
            else if((response.new_status == 'rejected' || response.new_status == 'canceled') && list_all == false)
            {

                $(e).closest('ul').remove();
            }
            else 
            {

                if(response.new_status == 'inprogress')
                {

                    var li_finish = '<li id="li_finish"><a type="button" status="'+status+ 'id="btn_finish" job_id="'+job_id+'">Finish</a></li>';
                    var inprogress = $("input[name='inprogress']").attr('value');
                    //$(e).closest('ul').append(li_finish);

                    //means that I am not in single order page
                    if(list_all == true)
                    {

                        $(e).closest('ul').find('li').not(':first').not("#li_cancel").not('#li_finished').remove();
                    }
                    else
                    {
                        $(e).closest('ul').find('li').not("#li_cancel").remove();  
                    }
                }
                else if(response.new_status == 'finished')
                {
                    if(list_all == true)
                    {
                       $(e).closest('ul').find('li:not(:first)').remove();
                    }
                    else
                    {
                        $(e).closest('ul').remove();
                    }
                }
            }    
            $(e).closest(".order").remove();
        }
    }); 
}

function save_payment(job_id, amount, payment_url, is_function = true)
{
    $.ajax({
        method: "POST", 
        //is_function >> indicates that save_payment is just a function and not a return html as in single order page
        data: {amount: amount, job_id:job_id, is_function: is_function},
        url: payment_url,
        success: function(response){
            is_function = response.is_function;
            alert(is_function);
        },
        error: function(response){
            return false;
        }
    });
    return is_function;
}