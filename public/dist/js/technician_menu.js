function change_status(e, parameters)
{
    var li = $(parameters.element);
    var status = li.find('a').attr('value');


    if (li.attr('value') === parameters.edit)
    {
        // redirect to edit
        location.href = parameters.edit_url;
    } 

    if ($(e).attr('value') === parameters.view)
    {
        // redirect to view
        window.location = parameters.tech_url;
    } 
    if ($(e).attr('value') === parameters.payment)
    {
        // redirect to payment
        window.location = parameters.payment_url;
    } 
    if (status == parameters.block ||
        status == parameters.activate) 
    {     
        //e.preventDefault();
        $.ajax({
            method: "post",
            data: {status: status, tech_id: parameters.tech_id, confirm: 0},
            url: parameters.change_status_url,
            success: function (response) {
                if(response.is_activated == "success"){ //activated
                        window.location = parameters.tech_url;
                }

                else if(response.is_blocked == "success")
                {
                        window.location = parameters.tech_url;
                }

                    bootbox.alert(response.message);

            },
            error: function (response) {
            }
        });  
    }
    else if(status == parameters.delete)
    {
        e.preventDefault();
        bootbox.confirm("Are you sure you want to delete e technician?", function(result)
        {  
            if(result == true)
            {
                $.ajax({
                    method: "post",
                    data: {tech_id: parameters.tech_id},
                    url: parameters.delete_url,
                    success: function (response)
                    {
                        if(response.is_deleted == 'success')
                        {
                               setTimeout(function(){ window.location = response.url; }, 5); //5 millesecond
                        }
                        else if(response.is_deleted == 'error') 	
                        {
                            bootbox.alert(response.message);	                             
                        }   
                    }
                });
            }
       });
    }
} 
