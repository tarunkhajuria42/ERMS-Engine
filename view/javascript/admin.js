init();
function init()
{
	$("#institutes_table").DataTable();
	$("#institutes_courses").DataTable();
	findinstitutes();
}

// ***********************Manage Institutes*****************************
var institutes=[];
function findInstitutes()
{
	$.post("http://localhost/ERMS-Engine/erms/index.php",
	{
		type:'list'
		request:'institues'
	},
	function institutes_fill(data,status)
	{
		datah=json.parse('data');
		if(datah['type']=='success')
		{
			console.log(datah['reply']);
		}

	});
}