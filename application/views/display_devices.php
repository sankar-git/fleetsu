<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>REST Service and Simple Frontend</title>
	<link href='<?php echo base_url().'css/style.css';?>' rel='stylesheet'>
</head>
<body>
<div id="error_msg" class="error_msg"></div>
<form name="frmDevice" action="" id="frmDevice" method="post">
	<fieldset>
		<legend>Add Device</legend>
		<ol>
			<li>
				<label for="device_id">Device ID:</label>
				<input id="device_id" name="device_id" class="text" type="text" />
			</li>
			<li>
				<label for="device_label">Device Label:</label>
				<input id="device_label" name="device_label" class="text" type="text" />
			</li>
			<li>
				<label for="last_reported_date">Reported Date Time:</label>
				<input id="last_reported_date" name="last_reported_date" placeholder="yyyy-mm-dd h:m:s" class="text" type="text" /><small>(UTC)</small>
			</li>
			<li><input class="submit" type="submit" value="Create New Device" /></li>
		</ol>
	</fieldset>
</form>
<div id="results" class="table">
	<div class="row header blue">
		<div class="cell">Device ID</div>
		<div class="cell">Device Label</div>
		<div class="cell">Last Reported</div>
		<div class="cell">Status</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.0.js"></script>
<script>
    var site_url = "<?php echo base_url();?>";
    function loaddata(){
        $('.rowdata').remove();
        $('#error_msg').html('');
        $.ajax({
            url:site_url+'api/telematics/devices',
            type: "GET",
            data: "",
            dataType: "json",
            success: function(data){
                $.each(data, function(key, result){
                    if(result.status == 'OK')
                        var color = 'green';
                    else
                        var color = 'red';
                    $("#results").append('<div class="row rowdata">' +
                        '<div class="cell">' + result.device_id +"</div>"+
                        '<div class="cell">'+ result.device_label +"</div>"+
                        '<div class="cell">' + result.last_reported_date +"</div>"+
                        '<div class="cell '+color+'">' + result.status +"</div>"+
                        "</div>");
                });
            }
        });
    }
	$(document).ready(function(){
	    $('#frmDevice').submit(function(){
	        if($('#device_id').val()!='' && $('#device_label').val() && $('#last_reported_date').val()){
                $.ajax({
                    url:site_url+'api/telematics/devices',
                    type: "POST",
                    data: $('#frmDevice').serialize(),
                    dataType: "json",
                    success: function(data){
                        $('#device_id').val('');
                        $('#device_label').val('');
                        $('#last_reported_date').val('');
                        $('#error_msg').html(data.message);
                        loaddata();
                    }
                });
            }else{
	            alert('Please enter all the fields');
            }
            return false;
        });

	    loaddata();
	});

</script>
</body>
</html>