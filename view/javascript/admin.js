init();
function init()
{
	
	$("#institutes_courses").DataTable();
	findInstitutes();
}

// ***********************Manage Institutes*****************************

var institutes=[];
function findInstitutes()
{
	$.post("http://localhost/ERMS-Engine/erms/index.php",
	{
		type:'lists',
		request:'all_institutes'
	},
	function institutes_fill(data,status)
	{
		console.log(data);
		datah=JSON.parse(data);
		
		if(datah['type']=='success')
		{
			var institutes=datah['reply'];
			var entry;
			for (var i=0; i<institutes.length;i++)
			{
				entry=`<tr id=institute_`+i+`>
		           <td id='instiname_`+i+`'>`+institutes[i]+`</td>
		           <td ><button id='button_`+i+`' onclick='subject(this.id)'>Add/Edit</button></td> 
		             </tr>`;
		        $(entry).appendTo("#institutes_entry");
			}
			$("#institutes_table").DataTable();

		}

	});
}
