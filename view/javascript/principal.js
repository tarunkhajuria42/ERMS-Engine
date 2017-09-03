init();
function init()
{
	$("#wtext").text("Welcome : "+user_id);
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
    				text: 'all'}));
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
					batches1[i]['subject'],
					batches1[i]['institute'],
					batches1[i]['course'],
					optional_link(batches1[i]['internal'],i,0)
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
	if(available==-1 || available==2)
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
			data_pack=datah['reply'];
			$('#max_marks').text("Max Marks:"+data_pack['max']);
			marks1=data_pack['marks'];
			for (var i=0; i<marks1.length;i++)
			{
				marks_table1.row.add([marks1[i]['rollno'],
					marks1[i]['name'],
					marks1[i]['marks'],
					marks1[i]['userid'],
					marks1[i]['comment'],
					`<button id='marksedit_`+i+`' class='btn btn-info' onclick='edit_marks1(this.id)'>Edit</button>`
					]);
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
						marks1[no]['userid'],	
						`<input type='text' id='comment_`+no+`'>`,
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
		temp_dict['userid']=user_id;
		temp_dict['comment']=$('#comment_'+no).val();
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
					marks1[no]['comment']=$('#comment_'+no).val();
					marks1[no]['userid']=user_id;
					marks_table1.row($('#'+row_in_edit).parents('tr')).remove();
					marks_table1.row.add([marks1[no]['rollno'],
						marks1[no]['name'],
						marks1[no]['marks'],
						marks1[no]['userid'],
						marks1[no]['comment'],
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
var choices4=[];
var subjects4=[];
var selected_course4;
var is_new_opened4=false;
var new_subject_opened4=false;
var institute4;
var delete_selected4;

function init_tab4()
{
courses_table4=$('#courses_table4').DataTable();
subjects_table4=$('#choice_table4').DataTable();
get_institute4();
} 
function reset4()
{
	is_new_opened4=false;
	new_subject_opened4=false;
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
					`<button id='insti_`+i+`' onclick='add_edit_subject4(this.id)' data-toggle="modal" data-target="#choice4" class='btn btn-info pull-right'>Add/Edit</button>`]);
			}
			courses_table4.draw();
		}
	});
}
function add_edit_subject4(id)
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
		function populate_subjects(data,status)
		{
			if(status=='success')
			{
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					subjects_table4.clear();
					subjects4=datah['reply'];
					get_choices4();
					for(var i=0; i<subjects4.length;i++)
					{
						subjects_table4.row.add([
							subjects4[i]['subject_code']+' - '+subjects4[i]['subject'],
							`<button id='delete_`+i+`' class='btn btn-info' onclick='delete_subject4(this.id)'>Delete</button>`])
					}
					subjects_table4.draw();
				}
			}
		});
}
function delete_subject4(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='delete_choice';
	var data={};
	data['institute']=institute4;
	data['course']=selected_course4;
	data['subject']=subjects4[no]['subject_code'];
	post_arguments['data']=JSON.stringify(data);
	delete_selected4=no;
	$.post(address,
		post_arguments,
		function delete_reply4(data,status)
		{
			console.log(data);
			if(status=='success')
			{
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					subjects_table4.row($('#delete_'+delete_selected4).parents('tr')).remove().draw();	
					subjects4.splice(delete_selected4,1);			
				}
			}
		});
}

function get_choices4()
{
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='find_choice';
	post_arguments['value']=selected_course4;
	$.post(address,
		post_arguments,
		function fill_choices(data,status)
		{
			console.log(data);
			if(status=='success')
			{
				datah=JSON.parse(data);
				if(datah['type']=='success')
					var temp_list=datah['reply'];
					choices4=[];
					console.log(subjects4);
					for(var i=0; i<temp_list.length;i++)
					{
						find_element(subjects4,'subject_code',temp_list[i]['subject_code']);
						if(find_element(subjects4,'subject_code',temp_list[i]['subject_code'])==-1)
						{
							console.log('abc');
							choices4.push(temp_list[i]);
						}
					}
			}
		});
}
function new_subject4()
{
	if(!new_subject_opened4)
	{
		subjects_table4.row.add([
			`<select id='choice_list4'></select>`,
			`<button id='add_new4' onclick='add_subject4()' class='btn btn-info'>Add</button>`
			]);
		subjects_table4.draw();
		for(var i=0; i<choices4.length;i++)
		{
			var temp_string=choices4[i]['subject_code']+' - '+choices4[i]['subject'];
			$('#choice_list4').append($('<option>',{
			value:i,
			text:temp_string
			}));	
		}
		new_subject_opened4=true;
	}
	else
	{
		message_subjects4("Please add one subject at a time");
	}
}
function add_subject4()
{
	var data={}
	data['institute']=institute4;
	data['course']=selected_course4;
	data['subject']=choices4[$('#choice_list4').val()]['subject_code'];
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='add_choice';	
	post_arguments['data']=JSON.stringify(data);
	$.post(address,
		post_arguments,
		function reply_add2(data,status)
		{
			if(status=='success')
			{
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					var ch_no=$('#choice_list4').val();
					subjects4.push(choices4[ch_no]);
					subjects_table4.row($('#choice_list4').parents('tr')).remove();
					var no=subjects4.length-1;
					subjects_table4.row.add([
						choices4[ch_no]['subject_code']+'-'+choices4[ch_no]['subject'],
							`<button id='delete_`+no+`' class='btn btn-info' onclick='delete_subject4(this.id)'>Delete</button>`]);
					subjects_table4.draw();
					choices4.splice(ch_no,1);
					new_subject_opened4=false;
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
