init();
var institutes_table;
var institutes_courses1;
var course_table2;
function init()
{
	institutes_table=$("#institutes_table").DataTable();
	institutes_courses1=$("#institutes_courses").DataTable();
	findInstitutes();
	courses_table2=$("#courses_table").DataTable();
	$("#exam1").DataTable();
	$("#session").DataTable();
}

// ***********************Manage Institutes*****************************
var institutemode1=0;
var clicknew1=0;
var institutes1=[];
var courses1=[];
var newcourses1=[];
var all_courses=[];
var deleted_courses=[];
var deleted_institutes=[];
var newcourse_selected=false;
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
				institutes_table.row.add([institutes[i],
					`<button id='button_`+i+`' onclick='add_course1(this.id)' data-toggle="modal" data-target="#myModal" class='btn btn-info pull-right'>Add/Edit</button>`]);
			}
			institutes_table.draw();
		}
	});
}

function add_course1(id)
{
	var type= id.substring(0, id.indexOf("_"));
	var no=id.substring(id.indexOf("_")+1,id.length);
	var selected_insti;
	if(type=='button')
	{
		selected_insti=institutes[no];
	}
	else
	{
		newcourse_selected=true;
	}
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_courses';
	post_arguments['value']=selected_insti;	
	console.log(post_arguments);
	console.log(selected_insti);
	$.post("http://localhost/ERMS-Engine/erms/index.php",
			post_arguments,
			populate_courses1
			);
}

function newinstitute()
{
	if(institutemode1==0)
	{
		var i=institutes.length;
		institutes_table.row.add([`<input id='new_text' type='text'>`,
			`<button id='new_button' onclick='add_course1(this.id)' data-toggle="modal" data-target="#myModal" class='btn btn-info pull-right'>Add</button>`]);
		institutes_table.draw();
		institutemode1=1;
	}
	else
	{

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
			for(var i=0; i<courses.length;i++)
			{
				institutes_courses1.row.add([courses[i],
					`<button id='buttoncourses1_`+i+`' onclick='remove_course1(this.id)'  class='btn btn-info pull-right'>Remove Course</button>`
					]);	
			}
			institutes_courses1.draw();	
		}
	}
}

function new_course1()
{
	if(state_newcourse==0)
	{
		course_table1.row.add([`<input id='courses_new' type='text'>`,
			`<button id='courses_button_new' onclick='delete_course(this.id)'>Delete </button>`]).draw();		
		state_newcourse=1;
	}
	else
	{

	}	
}
function findall_courses1()
{
	$.post("http://localhost/ERMS-Engine/erms/index.php",
		{
				type:'lists',
				request:'all_courses',	
		},
		function all_courses_reply(data,status)
		{
			if(replay=='success')
			{
				datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					all_courses=datah['reply'];
				}
			}
		});
}

function new_courses1()
{

}
function remove_course1(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var indextemp=new_courses1.indexof(courses[no]);
	if(indextemp!=-1)
		new_courses1.splice(indextemp,1);
	else
		courses_remove=courses[no];
	courses.splice(no,1);
	institutes_courses1.row($('#'+id).parents('tr')).remove().draw();
}
function submit_courses1()
{
	if(newcourse_selected)
	{
		if(courses_new.length>0)
		{

		}
		else
		{
			institutes_table.row($('#new_button').parents('tr')).remove().draw();
		}
	}
	else
	{

	}
}





/**************************************************** Manage Courses ********************************************/