init();
function init()
{
	$("#wtext").text("Welcome : "+user_id);
	init_tab1();
}

var courses_table1;
var users_table1;
var courses1=[];
var users1=[];
var selected_course1;
var is_new_opened1=false;
var institute1;

function init_tab1()
{
courses_table1=$('#courses_table1').DataTable();
users_table1=$('#users_table1').DataTable();
institute1='center';
load_courses1();
} 
function reset1()
{
	is_new_opened1=false;
	users1=[];
}
function load_courses1()
{
	courses1=[];
	courses_table1.clear();
	new_course_opened1=false;
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='all_courses';
	$.post(address,post_arguments,
	function courses_fill1(data,status)
	{
		console.log(data);
		datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			courses1=datah['reply'];
			for (var i=0; i<courses1.length;i++)
			{
				courses_table1.row.add([courses1[i],
					`<button id='insti_`+i+`' onclick='add_edit_user1(this.id)' data-toggle="modal" data-target="#users1" class='btn btn-info pull-right'>Add/Edit</button>`]);
			}
			courses_table1.draw();
		}
	});
}
function add_edit_user1(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	selected_course1=courses1[no];
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='get_users';
	temp={};
	temp['institute']=institute1;
	temp['course']=selected_course1;
	post_arguments['data']=JSON.stringify(temp);
	$.post(address,post_arguments,
		function populate_users(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					users_table1.clear();
					users1=datah['reply'];
					for(var i=0; i<users1.length;i++)
					{
						users_table1.row.add([
							users1[i],
							`<button onclick='remove_user1(this.id)' class='btn btn-warning pull-right'id='removeuser_`+i+`'>Remove</button>`]);
					}
					users_table1.draw();
				}
			}
		});
}
function new_user1()
{
	var no=users1.length;
	if(!is_new_opened1)
	{
		users_table1.row.add([
			`<input id='email_`+no+`' type='text'>`,
			`<button onclick='submit_new1(this.id)'' class='btn btn-info pull-right' id='adduser_`+no+`'>Add</button>`]);
		users_table1.draw();
		is_new_opened1=true;
	}
	else
	{
		message_user1("Add one user at a time!!");
	}
}
function submit_new1(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var value=$('#email_'+no).val();
	var data={};
	data['institute']=institute1;
	data['course']=selected_course1;
	data['email']=value;
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='add_user';
	post_arguments['data']=JSON.stringify(data);
	$.post(address,post_arguments,
		function reply_add1(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					var no=users1.length;
					users1.push($('#email_'+no).val());
					users_table1.row($('#email_'+no).parents('tr')).remove();
					users_table1.row.add([users2[no],
					`<button onclick='remove_user1(this.id)' class='btn btn-warning pull-right' id='removeuser_`+no+`'>Remove</button>`]);
					users_table1.draw();
					is_new_opened1=false;
				}
				else
				{

				}
			}
		})

}

function remove_user1(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var value=users1[no];
	current_remove=no;
	var data={};
	data['course']=selected_course1;
	data['email']=value;
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='remove_users';
	post_arguments['data']=JSON.stringify(data);
	$.post(address,post_arguments,
		function reply_remove1(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					users1.splice(current_remove,1);
					users_table1.row($('#removeuser_'+current_remove).parents('tr')).remove();
					users_table1.draw();
				}
			}
		})
}
function message_user1(text)
{
	$('#info_user1').text(text);
}