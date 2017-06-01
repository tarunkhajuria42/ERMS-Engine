function generateDashboard()
{
	//check if user is logged 
	//get user module lists
	$.post("http://localhost/ERMS-Engine/erms/test.php",
	{
		type='access',
		request='module'
	},userset);
}
function userset(data,status)
{
	var resobj=JSON.parse(data);
		if(resobj['type']=='success')
		{
			$.POST('http://localhost/ERMS-Engine/view/dashboardTest.php',{code=resobj['code']},viewCallback);
		}
		else if(resobj['type']=='error'])
		{
			window.location='http://localhost/ERMS-Engine/view/error.php';
		}
	}
}

function viewCallback(data,status)
{

var moduleList=resdata['list'];
			
	for (var i=0; i<modulelist.length; i++)
	{
		if(i==0)
		{
			$("<li class='nav-item><p class='nav-link' onClick='changeTab(this)'"+"active"+">abc</p></li>").appendTo("#navlist");
			$(modulecode[i]).appendTo("#")
		}
		else
		{
			$("<li class='nav-item><p class='nav-link' onClick='changeTab(this)'>abc</p></li>").appendTo("#navlist");
		}
		
	}
}