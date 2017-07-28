init();
function init()
{
	init_tab1();
	init_tab2();
	init_tab4();
}
//******************************************** Tab1 Marks ******************************************
var batches1=[];
var marks1=[];
var institute1;
var courses1=[];
var semesters1=[];
var selected_list_course1='all';
var selected_list_semester1;
var edit_in_progress3=false;
var selected_subject1;
var batch_table1;
var marks_table1;
function init_tab1()
{
	batch_table1=$('#batch_table1').DataTable();
	marks_table1=$('#marks_table1').DataTable();
	get_institute1();
	$('#courses_list1').change(
		function change_courses1()
		{
			selected_list_course1=$('#courses_list1').val();
			load_semester1();
		});
}
function get_institute1()
{	
	$.post(address,
	{
		type:'access',
		request:'get_institute'
	},
	function institutes_fill1(data,status)
	{
		datah=JSON.parse(data);
		console.log(data);
		if(datah['type']=='success')
		{
			institute1=datah['reply'];
			load_courses1();
		}
	});
}

function load_courses1()
{
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_courses';
	post_arguments['value']=institute1;
	$.post(address,post_arguments,
		function list_courses1(data,status)
		{	
			if(status=='success')
			{
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					courses1=datah['reply'];
					$('#courses_list1').empty();
					$('#courses_list1').append($('<option>', {
    				value: 'all',
    				text: 'All'}));
					for(var i=0; i<courses1.length;i++)
					{
						$('#courses_list1').append($('<option>', {
    						value: courses1[i],
    						text: courses1[i]}));
					}
				selected_list_course1=$('#courses_list1').val();
				load_semester1();
				}
			}
		});
}
function load_semester1()
{
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_semesters';
	temp={};
	temp['institute']=institute1;
	temp['course']=selected_list_course1;
	post_arguments['data']=JSON.stringify(temp);
	$.post(address,post_arguments,
		function list_semesters1(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					semesters1=datah['reply'];
					$('#semester_list1').empty();
					for(var i=0; i<semesters1.length;i++)
					{
						$('#semester_list1').append($('<option>', {
    						value: semesters1[i]['semester'],
    						text: semesters1[i]['semester']}));
					}
				}
			}
		});
}
function select_submit1()
{
	console.log('abc');	
	selected_list_course1=$('#courses_list1').val();
	selected_list_semester1=$('#semester_list1').val();
	load_batch1();
}
function reset_tab1()
{
	edit_in_progress1=false;
	batches1=[];
	marks1=[];
}
function load_batch1()
{
	reset_tab1();
	var  post_arguments={};
	post_arguments['type']='marks';
	post_arguments['request']='get_subjects';
	var temp_dict={};
	temp_dict['course']=selected_list_course1;
	temp_dict['institute']=institute1;
	console.log(institute1);
	temp_dict['semester']=selected_list_semester1;
	post_arguments['data']=JSON.stringify(temp_dict);
	$.post(address,post_arguments,display_batch1)
}
function display_batch1(data,status)
{
	if(status=='success')
	{
		console.log(data);
		var datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			batch_table1.clear().draw();
			batches1=datah['reply'];
			for(var i=0; i<batches1.length; i++)
			{	
				batch_table1.row.add([batches1[i]['subject_code'],
					batches1[i]['institute'],
					batches1[i]['course'],
					optional_link(batches1[i]['internal_practical'],i,0),
					optional_link(batches1[i]['internal_theory'],i,1),
					optional_link(batches1[i]['practical'],i,2),
					optional_link(batches1[i]['theory'],i,3)
					]).draw();	
			}
		}
	}
}
function optional_link(available,index,type)
{
	if(available==0)
	{
		return 'N';
	}
	if(available==1)
	{
		return `<a id='batch_`+index+`' class='hand' data-toggle="modal" data-target="#marks1" onclick='load_marks1(this.id,`+type+`)'>Y</a>`;
	}
	if(available==-1)
	{
		return '-';
	}
}
// Marks functions
function load_marks1(id,type)
{
	marks_table1.clear();
	var no=id.substring(id.indexOf('_')+1,id.length);
	var post_arguments={};
	post_arguments['type']='marks';
	post_arguments['request']='get_marks';
	temp_dict={};
	selected_subject1=batches1[no]['subject'];
	selected_type1=type;
	temp_dict['institute']=batches1[no]['institute'];
	temp_dict['subject']=selected_subject1;
	temp_dict['type']=type;
	post_arguments['data']=JSON.stringify(temp_dict);
	$.post(address,post_arguments,
		fill_marks1);
}
function fill_marks1(data,status)
{
	if(status=='success')
	{
		console.log(data);
		var datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			marks1=datah['reply']
			for (var i=0; i<marks1.length;i++)
			{
				marks_table1.row.add([marks1[i]['rollno'],
					marks1[i]['name'],
					marks1[i]['marks'],
					`<button id='marksedit_`+i+`' class='btn btn-info' onclick='edit_marks1(this.id)'>Edit</button>`
					])
			}
			marks_table1.draw();
		}
	}

}
function edit_marks1(id)
{
	
	if(edit_in_progress1==false)
	{
		var no=id.substring(id.indexOf('_')+1,id.length);
		marks_table1.row($('#'+id).parents('tr')).remove();
		marks_table1.row.add([marks1[no]['rollno'],
						marks1[no]['name'],
						`<input type='text' id='marksedit_`+no+`' value='`+marks1[no]['marks']+`'>`,
			`<button id='marksedit_`+no+`' class='btn btn-info' onclick='submit_edit_marks1(this.id)'>Done</button>`
			]).draw();
		edit_in_progress1=true;
	}
	else
		error_marks1('Edit, One at a time Please');
}
function submit_edit_marks1(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
		row_in_edit=id;
	var post_arguments={};
		post_arguments['type']='marks';
		post_arguments['request']='edit_marks';
		var temp_dict={};
		temp_dict['subject']=selected_subject1;
		temp_dict['type']=selected_type1;
		temp_dict['marks']=$('#marksedit_'+no).val();
		temp_dict['rollno']=marks1[no]['rollno'];
		post_arguments['data']=JSON.stringify([temp_dict]);	
		$.post(address,post_arguments,
		function reply_edit(data,status)
		{
			if(status='success')
			{
				console.log(data);
				datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					edit_in_progress1=false;
					var no=row_in_edit.substring(row_in_edit.indexOf('_')+1,row_in_edit.length);
					marks1[no]['marks']=$('#marksedit_'+no).val();
					marks_table1.row($('#'+row_in_edit).parents('tr')).remove();
					marks_table1.row.add([marks1[no]['rollno'],
						marks1[no]['name'],
						marks1[no]['marks'],
						`<button id='marksedit_`+no+`' class='btn btn-info' onclick='edit_marks1(this.id)'>Edit</button>`
						]).draw();
				}
				else
					error_batch1('System Error');
			}
			else
				error_batch1('Network Error');
		});
}
function error_batch1(text)
{
	$('#info_batch1').text(text);
}
function error_marks1(text)
{
	$('#info_batch1').text(text);
}
//********************************************* Tab 2 (Users) ************************************************
var courses_table2;
var users_table2;
var courses2=[];
var users2=[];
var selected_course2;
var is_new_opened2=false;
var institute2;

function init_tab2()
{
courses_table2=$('#courses_table2').DataTable();
users_table2=$('#users_table2').DataTable();
get_institute2();
} 
function reset2()
{
	is_new_opened2=false;
	users2=[];
}
function get_institute2()
{	
	$.post(address,
	{
		type:'access',
		request:'get_institute'
	},
	function institutes_fill2(data,status)
	{
		datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			institute2=datah['reply'];
			load_courses2();
		}
	});
}
function load_courses2()
{
	console.log('ac');
	courses2=[];
	courses_table2.clear();
	new_course_opened2=false;
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_courses';
	console.log(institute2);
	post_arguments['value']=institute2;
	$.post(address,post_arguments,
	function courses_fill2(data,status)
	{
		console.log(data);
		datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			courses2=datah['reply'];
			for (var i=0; i<courses2.length;i++)
			{
				courses_table2.row.add([courses2[i],
					`<button id='insti_`+i+`' onclick='add_edit_user2(this.id)' data-toggle="modal" data-target="#users2" class='btn btn-info pull-right'>Add/Edit</button>`]);
			}
			courses_table2.draw();
		}
	});
}
function add_edit_user2(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	selected_course2=courses2[no];
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='get_users';
	temp={};
	temp['institute']=institute2;
	temp['course']=selected_course2;
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
					users_table2.clear();
					users2=datah['reply'];
					for(var i=0; i<users2.length;i++)
					{
						users_table2.row.add([
							users2[i],
							`<button onclick='remove_user2(this.id)' class='btn btn-warning pull-right'id='removeuser_`+i+`'>Remove</button>`]);
					}
					users_table2.draw();
				}
			}
		});
}
function new_user2()
{
	var no=users2.length;
	if(!is_new_opened2)
	{
		users_table2.row.add([
			`<input id='email_`+no+`' type='text'>`,
			`<button onclick='submit_new2(this.id)'' class='btn btn-info pull-right' id='adduser_`+no+`'>Add</button>`]);
		users_table2.draw();
		is_new_opened2=true;
	}
	else
	{
		message_user2("Add one user at a time!!");
	}
}
function submit_new2(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var value=$('#email_'+no).val();
	var data={};
	data['institute']=institute2;
	data['course']=selected_course2;
	data['email']=value;
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='add_user';
	post_arguments['data']=JSON.stringify(data);
	$.post(address,post_arguments,
		function reply_add2(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					var no=users2.length;
					users2.push($('#email_'+no).val());
					users_table2.row($('#email_'+no).parents('tr')).remove();
					users_table2.row.add([users2[no],
					`<button onclick='remove_user2(this.id)' class='btn btn-warning pull-right' id='removeuser_`+no+`'>Remove</button>`]);
					users_table2.draw();
					is_new_opened2=false;
				}
				else
				{

				}
			}
		})

}

function remove_user2(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var value=users2[no];
	current_remove=no;
	var data={};
	data['course']=selected_course2;
	data['email']=value;
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='remove_users';
	post_arguments['data']=JSON.stringify(data);
	$.post(address,post_arguments,
		function reply_remove2(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					users2.splice(current_remove,1);
					users_table2.row($('#removeuser_'+current_remove).parents('tr')).remove();
					users_table2.draw();
				}
			}
		})
}
function message_user2(text)
{
	$('#info_user2').text(text);
}
//********************************************* Tab 3 *********************************************************
function init_tab3()
{
	$("#rights").DataTable();
}
//********************************************* Tab 4 *********************************************************
var courses_table4;
var choice_table4;
var courses4=[];
var cluster4=[];
var selected_course4;
var is_new_opened4=false;
var institute4;

function init_tab4()
{
courses_table4=$('#courses_table4').DataTable();
subjects_table4=$('#subjects_table4').DataTable();
get_institute4();
} 
function reset4()
{
	is_new_opened4=false;
	subjects4=[];
}
function get_institute4()
{	
	$.post(address,
	{
		type:'access',
		request:'get_institute'
	},
	function institutes_fill4(data,status)
	{
		datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			institute4=datah['reply'];
			load_courses4();
		}
	});
}
function load_courses4()
{
	courses4=[];
	courses_table4.clear();
	new_course_opened4=false;
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_courses';
	post_arguments['value']=institute4;
	$.post(address,post_arguments,
	function courses_fill4(data,status)
	{	
		datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			courses4=datah['reply'];
			for (var i=0; i<courses4.length;i++)
			{
				courses_table4.row.add([courses4[i],
					`<button id='insti_`+i+`' onclick='add_edit_user4(this.id)' data-toggle="modal" data-target="#users4" class='btn btn-info pull-right'>Add/Edit</button>`]);
			}
			courses_table4.draw();
		}
	});
}
function add_edit_user4(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	selected_course4=courses4[no];
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_choice';
	temp={};
	temp['institute']=institute4;
	temp['course']=selected_course4;
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
					subjects_table4.clear();
					subjects4=datah['reply'];
					for(var i=0; i<subjects4.length;i++)
					{
						subjects_table4.row.add([
							subjects4[i],
							`<button onclick='remove_subject4(this.id)' class='btn btn-warning pull-right'id='removesubject_`+i+`'>Remove</button>`]);
					}
					subjects_table4.draw();
				}
			}
		});
}
function string_checker(value,id)
{

}
function submit_subjects4()
{
	var no=id.substring(id.indexOf('_')+1,id.length);

	var value=$('#email_'+no).val();
	var data={};
	data['institute']=institute2;
	data['course']=selected_course2;
	data['email']=value;
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='add_user';
	post_arguments['data']=JSON.stringify(data);
	$.post(address,post_arguments,
		function reply_add2(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					var no=users2.length;
					users2.push($('#email_'+no).val());
					users_table2.row($('#email_'+no).parents('tr')).remove();
					users_table2.row.add([users2[no],
					`<button onclick='remove_user2(this.id)' class='btn btn-warning pull-right' id='removeuser_`+no+`'>Remove</button>`]);
					users_table2.draw();
					is_new_opened2=false;
				}
				else
				{

				}
			}
		});

}


function message_subjects4(text)
{
	$('#info_subjects4').text(text);
}
