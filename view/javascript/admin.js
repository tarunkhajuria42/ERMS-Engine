init();
function init()
{
	
	$("#institutes_courses").DataTable();
	findInstitutes();
}

// ***********************Manage Institutes*****************************

var institutes=[];
var courses=[];
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
			institutes=datah['reply'];
			var entry;
			for (var i=0; i<institutes.length;i++)
			{
				entry=`<tr id=institute_`+i+`>
		           <td id='instiname_`+i+`'>`+institutes[i]+`</td>
		           <td ><button id='button_`+i+`' onclick='course1(this.id)' data-toggle="modal" data-target="#myModal" class='btn btn-info pull-right'>Add/Edit</button></td> 
		             </tr>`;
		        $(entry).appendTo("#institutes_entry");	
			}
			$("#institutes_table").DataTable();
		}
	});
}

function course1(id)
{
	var type= id.substring(0, id.indexOf("_"));
	var no=id.substring(id.indexOf("_")+1,id.length);
	if(type=='button')
	{
		$.post("http://localhost/ERMS-Engine/erms/index.php",
			{
				type:'lists',
				request:'get_courses',
				data: institute[no]	
			},
			populate_courses1
			);		
	}
	else
	{
		$.post("http://localhost/ERMS-Engine/erms/index.php",
			{
				type:'lists',
				request:'get_courses',
				data: $('instientry_'+i).value()
			},
			populate_courses1
			);	
	}
}


var institutemode=0;
function newinstitute()
{
	if(institutemode==0)
	{
		var i=institutes.length;
		var entry=`<tr id=institute_`+i+`>
		           <td id='instiname_`+i+`'><input type='text' id='instientry_`+i+`'></td>
		           <td ><button id='buttonnew_`+i+`' onclick='course1(this.id)' data-toggle="modal" data-target="#myModal2" class='btn btn-info pull-right'>Add</button></td> 
		             </tr>`;
		$(entry).appendTo("#institutes_entry");	
		newmode=1;	
	}
}
function populate_courses1(data,status)
{
	if(status=='success')
	{
		var datah= JSON.parse(data);
		if(datah['type']=='success')
		{
			courses=datah['reply'];
			var entry;
			for(var i=0; i<courses.length;i++)
			{

			}
		}
	}
}
var newcourses1=[];
function new_courses1()
{

}
function submit_courses1()
{

}
function new_submit_courses1()
{

}