function fakepost()
{
	var abs={};
	var data={};
	data['email']='tarun@imfundo.io';
	data['password']='hahaha';

	$.post("http://localhost/ERMS-Engine/erms/index.php",
	{
		type:'user',
		request:'login',
		data:JSON.stringify(data)
	},
	function(data,status)
	{
		console.log(data);
	});
	
}