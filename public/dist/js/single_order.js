function load_map_modal(lat, long)
{	   
    var _lat = parseFloat(lat);
    var _long = parseFloat(long);
    var dialog = bootbox.dialog({
            message: '<div style="height:500px; width:100%" id="map_canvas"></div>',
            closeButton: true
    });

    var map = new google.maps.Map(document.getElementById('map_canvas'), {
         center: {lat: _lat, lng: _long},
         scrollwheel: false,
         zoom: 4
    });

    var markerBounds = new google.maps.LatLngBounds();
    var marker;

    marker = new google.maps.Marker({
          position: {lat: parseFloat(_lat), lng: parseFloat(_long)},
          map: map,

    });  



    setTimeout(function(){google.maps.event.trigger(map, 'resize');
        markerBounds.extend(marker.getPosition());
        map.fitBounds(markerBounds);
    }, 1000);

}

$("#btn_reschedule").on('click', function(){
    $('#reschedule').modal({backdrop: 'static', keyboard: false})
});

$('#datepicker').datepicker({
    dateFormat: 'dd, mm, yy'
});

//check for date selected if permitted or not
$('#datepicker').on('changeDate', function () {
    $('#my_hidden_input').val(
        $('#datepicker').datepicker('getFormattedDate')
    );

    var date = $(this).datepicker('getDate');

    var today = new Date();
    today.setHours(0);
    today.setMinutes(0);
    today.setSeconds(0);
    if(Date.parse(date) < Date.parse(today)) {
        $(".day_error").removeClass("hidden");
    } else {
        $(".day_error").addClass("hidden");
    }
});

function reschedule(url, e)
{
    e.preventDefault();
    var today = new Date();
    var start;
    today.setHours(0);
    today.setMinutes(0);
    today.setSeconds(0);
    var date = $("#datepicker").datepicker('getDate');
    var new_date = String(date).substring(4, 24);  //get only date
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
        $.ajax({
            method: "POST",
            url: url,
            data: {order_id:order_id, date:new_date},
            success: function(response)
            {
                $("#flash_message").html(response.html);
                setTimeout(function(){ $("#flash_message").html("");}, 10000);
            },
            error: function(response)
            {
                console.log(response);
            }
        });
        return true;

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

function search_technicians(url, id, phone_number, name,job_type)
{   
    $.ajax({
        url: url,
        data:{id:id, name:name, phone_number:phone_number, job_type:job_type},
        success: function(response){
            $("#tech_table_content").html(response.html);
            technicians_datatable();
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
    bootbox.prompt({
        title:"Reason of rejection",
        onEscape:false,
        closeButton:false,

        callback:function(reason_of_reject)
        {
                //$(".btn btn-primary").click();
                if(reason_of_reject != null && reason_of_reject != "")
                {
                	change_job_status(url, e, status, job_id, list_all,  reason_of_reject);
            	}
            
        }
    });	       
}
function finish_order(e, url, list_all, payment_url)
{
    var job_id = $(e).closest('ul').attr('id');
    var status = $(e).attr('status');

    bootbox.prompt({
        title:"Enter payment amount",
        onEscape:false,
        closeButton: false,
        inputType:'number',
        callback:function(amount)
        {
        	if(amount != null && amount != "")
	        {
	            save_payment(job_id, amount, payment_url);
	            change_job_status(url, e, status, job_id, list_all);
		}
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
        
            if((response.new_status == 'rejected' || response.new_status == 'canceled') && list_all == true)
            {
                $("tr#"+job_id).find('ul').find('li').not(':first').remove();
            }
            else if((response.new_status == 'rejected' || response.new_status == 'canceled') && list_all == false)
            {

                $("tr#"+job_id).find('ul').parent().remove();
            }
            else 
            {
                if(response.new_status == 'inprogress')
                {
                    
                    var li_finish = '<li id="li_finish"><a type="button" status="2"  id="btn_finish" job_id="'+job_id+'">Finish</a></li>';
                    var inprogress = $("input[name='inprogress']").attr('value');
                    $("tr#"+job_id).find('ul').append(li_finish);

                    //means that I am not in single order page
                    if(list_all == true)
                    {
                        $("tr#"+job_id).find('ul').find('li').not(':first').not("#li_cancel").not('#li_finish').remove();
                    }
                    else
                    {

                        $('ul#'+job_id).find('li').not("#li_cancel").remove(); 
                        var li_finish = '<li id="li_finish"><a type="button" status="2"  id="btn_finish" job_id="'+job_id+'">Finish</a></li>';
                        $('ul#'+job_id).append(li_finish);
                    }
                }
                else if(response.new_status == 'finished')
                {
                    if(list_all == true)
                    {
                       $("tr#"+job_id).find('ul').find('li:not(:first)').remove();
                    }
                    else
                    {
                        $(".glyphicon-menu-hamburger").parent().parent().remove();
                    }
                }
            }   
           $("tr#"+job_id).find("td#"+job_id).text(response.new_status);
           $("#flash_message").html(response.html);
           setTimeout(function(){$("#flash_message").html("");},10000);
        }
    }); 
}

function save_payment(job_id, amount, payment_url)
{
    $.ajax({
        method: "POST", 
        //is_function >> indicates that save_payment is just a function and not a return html as in single order page
        data: {amount: amount, job_id:job_id},
        dataType: 'json',
        url: payment_url,

        success: function(response){
            return false;	            
        }
    });
}