<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>jQuery circleProgressBar.js Plugin Demo</title>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!-- <style>
body { background-color:#ECF0F1;}
</style> -->
</head>
<body>
<!-- <div style="width:250px;height:250px;margin:18px auto;">
	<div class="percent" style="width:250px;height:250px;">
		<p style="display:none;">70%</p>
	</div>
</div> -->

<div class="percent" style="width:125px;height:125px;"><p>70%</p></div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="js/jQuery.circleProgressBar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
<script>
$(function () {
	$('.percent').percentageLoader({
		valElement: 'p',
		strokeWidth: 30,
		bgColor: '#d9d9d9',
		ringColor: '#d53f3f',
		textColor: '#2C3E50',
		fontSize: '14px',
		fontWeight: 'normal'
	});

});
</script>

</body>
</html>
