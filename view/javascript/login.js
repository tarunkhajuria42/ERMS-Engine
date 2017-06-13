function checktoken()
{
	$.post("http://localhost/ERMS-Engine/erms/index.php",
		{
			type:"access",
			request:"type"
		}, function (data,status)
		{
			var res=JSON.parse(data);
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
	var email_input= $('#email_input').val();
	var password_input= $('#password_input').val();
	var datav={};
	datav['email']=email_input;
	datav['password']=password_input;
	var a={
		type:'user',	
		request:'login',
		data:datav
	}
	console.log(a);
	$.post("http://localhost/ERMS-Engine/erms/index.php",
	{
		type:'user',	
		request:'login',
		data:datav
	},
	function login_result(data,status)
	{
		console.log(data);
		var datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			window.location="http://localhost/ERMS-Engine/view/dashboard.php";
		}
		else
		{
			var entry=`<div class='encap'><p id='message' class='link'>Invalid email/password</p></div>`;
			$(entry).appendTo('#main');
		}
	});

}
