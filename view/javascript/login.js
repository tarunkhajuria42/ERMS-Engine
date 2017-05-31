function checktoken()
{
	$.post("http://localhost/ERMS/exammanagement/ExamManagement/index.php",
		{type:"user"}, function (data,status)
		{
			var res=json.parse(data);
			if (res['type']=='success')
			{
				window.loaction="http://localhost/ERMS/exammanagement/view/dashboard.php";
			}
		});
	
}
function goto($address)
{
	if ($address=="register")
	{
		window.location=""
	}
}
function login()
{

}
