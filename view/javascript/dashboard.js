var address="http://localhost/ERMS-Engine/erms/index.php";
var user_id;
var user_type;
function generateDashboard()
{
	//check if user is logged 
	//get user module lists
	$.post("http://localhost/ERMS-Engine/erms/index.php",
	{
		type:"access",
		request:"type"
	},setview);
}
function setview(data,status)
{
	console.log(data);
	var datah=JSON.parse(data);
	if(datah['type']=='success')
	{
		var user_info=datah['reply'];
		user_id=user_info['email'];
		user_type=user_info['type'];
		$.post('http://localhost/ERMS-Engine/view/dashboardGenerator.php',
		{
				access:user_type
		},function setdashboard(data,status)
		{
				$(data).appendTo("#page-top");
		});	
	}
	else if(datah['type']=='error')
	{
		window.location='http://localhost/ERMS-Engine/view/login.php';
	}
}
