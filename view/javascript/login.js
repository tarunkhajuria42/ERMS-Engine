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
	var email_input= $('#input_email').val();
	var password_input= $('#input_password').val();
	console.log(email_input);
	var datav={};
	datav['email']=email_input;
	datav['password']=password_input;
	console.log(datav);
	var a={};
	a['type']='user';
	a['request']='login';
	a['data']=JSON.stringify(datav);

	console.log(a);
	$.post("http://localhost/ERMS-Engine/erms/index.php",
	a,
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
