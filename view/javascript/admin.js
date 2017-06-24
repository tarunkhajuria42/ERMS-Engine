init();
var institutes_table;
var institutes_courses1;
var courses_table2;
var courses_subjects2;
var all_courses=[];
function init()
{
	institutes_table1=$("#institutes_table").DataTable();
	institutes_courses1=$("#institutes_courses").DataTable();
	load_institutes();
	//*** Tab 2*****
	courses_table2=$("#courses_table").DataTable();
	courses_subjects2=$("#courses_subjects").DataTable();
	$("#exam1").DataTable();
	$("#session").DataTable();
}

// ***********************Manage Institutes*****************************
var institutes1=[];
var courses1=[];
var new_courses1=[];
var selected_insti1;

var deleted_courses1=[];
var deleted_institutes1=[];
var new_institute_selected1=false;
var new_course_opened1=false;
var new_institute_opened1=false;
var click_new=false;
function load_institutes()
{
	institutes1=[];
	institutes_table1.clear();
	new_institute_opened1=false;

	$.post(address,
	{
		type:'lists',
		request:'all_institutes'
	},
	function institutes_fill(data,status)
	{
		datah=JSON.parse(data);
		
		if(datah['type']=='success')
		{
			institutes1=datah['reply'];
			var entry;
			for (var i=0; i<institutes1.length;i++)
			{
				institutes_table1.row.add([institutes1[i],
					`<button id='button_`+i+`' onclick='add_course1(this.id)' data-toggle="modal" data-target="#courses1" class='btn btn-info pull-right'>Add/Edit</button>`]);
			}
			institutes_table1.draw();
		}
	});
}



function new_institute1()
{
	if(!new_institute_opened1)
	{
		institutes_table1.row.add([`<input id='new_institute1' type='text'>`,
			`<button id='new_button' onclick='add_course1(this.id)' data-toggle="modal" data-target="#courses1" class='btn btn-info pull-right'>Add</button>`]);
		institutes_table1.draw();
		new_institute_opened1=true;
	}
	else
	{
		error_insitute1('One institute at a time Please');
	}
}
function add_course1(id)
{
	var type= id.substring(0, id.indexOf("_"));
	var no=id.substring(id.indexOf("_")+1,id.length);
	
	if(type=='button')
	{
		selected_insti1=institutes1[no];
	}
	else
	{
		selected_insti1=$('#new_institute1').val();
		new_institute_selected1=true;
	}
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_courses';
	post_arguments['value']=selected_insti1;	
	$.post(address,
			post_arguments,
			populate_courses1
			);
}
// Courses functions
function populate_courses1(data,status)
{
	if(status=='success')
	{
		var datah= JSON.parse(data);
		if(datah['type']=='success')
		{
			reset_all_courses();
			courses1=datah['reply'];
			for(var i=0; i<courses1.length;i++)
			{
				institutes_courses1.row.add([courses1[i],
					`<button id='buttoncourses1_`+i+`' onclick='remove_course1(this.id)'  class='btn btn-info pull-right'>Remove</button>`
					]);	
			}
			institutes_courses1.draw();	
		}
	}
}

function add_course_button1()
{
	if(!new_course_opened1)
	{
		institutes_courses1.row.add([`<input id='courses_new_input' type='text'>`,
			`<button id='courses_button_new' class='btn pull-right btn-info'onclick='new_course_add()'>Add </button>`]).draw();		
		new_course_opened1=true;
		error_courses1("");
	}
	else
	{
		error_courses1("One course a time please!!");
	}	
}

function new_course_add()
{
	var temp_new_course=$('#courses_new_input').val()
	if(temp_new_course!='')
	{
		if(courses1.indexOf(temp_new_course)==-1)
		{	
			courses1.push(temp_new_course);
			var temp_index_deleted=deleted_courses1.indexOf(temp_new_course)
			if(temp_index_deleted!=-1)
			{
				deleted_courses1.splice(temp_index_deleted,1);
			}
			else
			{
				new_courses1.push(temp_new_course);
			}
			institutes_courses1.row($('#courses_new_input').parents('tr')).remove().draw();
			institutes_courses1.row.add([temp_new_course,
				`<button id='buttoncourses1_`+courses1.length+`' onclick='remove_course1(this.id)'  class='btn btn-info pull-right'>Remove</button>`
				]).draw();
			new_course_opened1=false;	
			error_courses1("");
		}
		else
			error_courses1('Already in list');
	}
	else
	{
		error_courses1('Empty field');
	}
}

//Resets the courses
function reset_all_courses()
{
	institutes_courses1.clear();
	all_courses=[];
	new_courses1=[];
	courses1=[];
	deleted_courses1=[];

}

//Gets all courses for the dropdown menu
function fill_all_courses()
{
	$.post(address,
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

// Handles remove course button click
function remove_course1(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	console.log(new_courses1.length);
	if(new_courses1.length==0)
		var indextemp=new_courses1.indexOf(courses1[no]);
	if(indextemp!=-1)
		new_courses1.splice(indextemp,1);
	else
		deleted_courses1.push(courses1[no]);
	courses1.splice(no,1);
	institutes_courses1.row($('#'+id).parents('tr')).remove().draw();
}


/* Implementation of save button for courses*/
function save_courses1()
{
	var add_reply=0;
	var delete_reply=0;
	if(new_courses1.length>0)
	{
		add_reply=1;
		var post_arguments={};
		post_arguments['type']='lists';
		post_arguments['request']='add_courses';
		var temp_dict={};
		temp_dict['courses']=new_courses1;
		temp_dict['institute']=selected_insti1;
		post_arguments['data']=JSON.stringify(temp_dict);
		console.log(post_arguments);
		$.post(address,post_arguments,
			function handle_submit(data,status)
			{
				console.log(data);
				if(status=='success'){
					if(data!=null)
					{
						datah=JSON.parse(data);
						if(datah['type']=='success')
							add_reply=2;
						else
							add_reply=3;
					}
					else
						add_reply=3;
				}
				else
					add_reply=3;
			});
	}
	else
	{
		institutes_table1.row($('#new_button').parents('tr')).remove().draw();
	}
	if(deleted_courses1.length>0)
	{
		delete_reply=1;
		post_arguments={};
		post_arguments['type']='lists';
		post_arguments['request']='delete_courses';
		temp_dict={};
		temp_dict['institute']=selected_insti1;
		temp_dict['courses']=deleted_courses1;
		post_arguments['data']=JSON.stringify(temp_dict);
		$.post(address,
			post_arguments,
			function handle_submit_deleted(data,status)
			{
				if(status=='success')
				{
					if(data!='')
					{
						datah=JSON.parse(data);
						if(datah['type']=='success')
							delete_reply=2;
						else
							delete_reply=3;
					}
					else
						delete_reply=3;
				}
				else 
					delete_reply=3;
			});
	}	
	if(add_reply==3 || delete_reply==3)
		error_courses1("Error ! Could not save, Try later");
	else
		{
		
		error_courses1("Success");
		}
}

function error_courses1(text)	
{
	$('#info_courses').text(text);
}
function error_insitute1(text)
{
	$('#info_institute').text(text);
}
/**************************************************** Manage Courses ********************************************/

function fillCourses2()
{
	$.post(address,
	{
		type:'lists',
		request:'all_courses'
	},
	function courses_fill(data,status)
	{
		datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			all_courses=datah['reply'];
			for (var i=0; i<all_courses.length;i++)
			{
				courses_table2.row.add([all_courses[i],
					`<button id='coursesbutton_`+i+`' onclick='add_subject2(this.id)' data-toggle="modal" data-target="#subjects2" class='btn btn-info pull-right'>Add/Edit</button>`]);
			}
			courses_table2.draw();	
		}
	});
}


