function checktoken()
{
	$.post("http://localhost/ERMS-Engine/erms/index.php",
		{type:"user"}, function (data,status)
		{
			var res=json.parse(data);
			if (res['type']=='success')
			{
				window.location="http://localhost/ERMS-Engine/view/dashboard.php";
			}
		});
	
}
function goto($address)
{
	if ($address=="register")
	{
		window.location="http://localhost/ERMS-Engine/view/register.php"
	}
}
function login()
{

}
