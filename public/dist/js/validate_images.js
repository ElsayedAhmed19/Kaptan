function validate_image(e, old_path){
	alert("aaaaaaaaaaaaaaaaa");
	console.log("fsdfdsf");
        var ext =  $("input[type='file']").val().split('.').pop().toLowerCase();
	if($.inArray(ext, ['gif','png','jpg','jpeg', 'svg']) == -1) 
	{
	    $('#img_error').removeClass('hidden');
	    alert("vsvsd");
	    var old_path = $("input[name='old_path']").attr('value');
	    $('#blah').attr('src', 'http://myservice.fekracomputers.net/public/dist/img/58a42d4e16722.png');
	}
}
