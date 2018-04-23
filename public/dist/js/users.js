function update_user(userid, url, is_admin = false)
{
    var data = status == null ? {userid:userid}: {userid:userid, is_admin:is_admin};
    var result = null;
    $.ajax({
        method: "POST",
        url: url,
        data: data,
        async: false,
        success: function (response) {
            if (response.is_updated == 'success') {
                result = response;
            }
        }
    });
    return result;
}

function users_datatable()
{
    $('#list').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        columnDefs: [
            { orderable: false, targets: [-1, -2, -3, -4] }
        ],
        "language": {
            "zeroRecords": "There are no records found",
        }
    });

    $('#data_table_id').DataTable( {

    } );
}

function filter_users(url, name, status, role)
{
    $.ajax({
        method: "POST",
        url: url,

        data: {status: status, name:name, role:role},
        success: function(response)
        {
            $('#list').dataTable().fnDestroy();
            $("#users_content").empty();
            $("#users_content").html(response.html);
            users_datatable();
        }
    });
}
