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

	var datah=JSON.parse(data);
	if(datah['type']=='success')
	{

		$.post('http://localhost/ERMS-Engine/view/dashboardGenerator.php',
		{
				access:datah['reply']
		},function setdashboard(data,status)
		{
				$(data).appendTo("#page-top");
		});	
	}
	else if(datah['type']=='error')
	{
		//window.location='http://localhost/ERMS-Engine/view/error.php';
	}
}
