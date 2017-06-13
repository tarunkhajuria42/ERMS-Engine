function logout()
{
	$.post("http://localhost/ERMS-Engine/erms/index.php",
		{
			type:"user",
			request:"logout"
		}, function (data,status)
		{
			console.log(data);
			var res=JSON.parse(data);
			if (res['type']=='success')
			{
				window.location="http://localhost/ERMS-Engine/view/login.php";
			}
		});
}