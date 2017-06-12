function generateDashboard()
{
	//check if user is logged 
	//get user module lists
	$.post("http://localhost/ERMS-Engine/erms/test.php",
	{
		type='user',
		request='access'
	},userset);
}
function setview(data,status)
{
	var datah=JSON.parse(data);
	if(datah['type']==success)
	{

		$.post('http://localhost/ERMS-Engine/view/dashboardGenerator.php',
		{
				access:datah['message'];
		},function setdashboard(data,status)
		{
				$(data).appendTo("#page-top");
		}	
	}
	else if(resobj['type']=='error'])
	{
		window.location='http://localhost/ERMS-Engine/view/error.php';
	}
	}
}
