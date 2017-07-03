init();
function init()
{
	init_tab1();
		
}
//******************************************** Tab1 Marks ******************************************
var batches1=[];
var marks1=[];
var institute1;
var courses1=[];
var selected_list_course1='all';
var edit_in_progress3=false;
var selected_subject1;
var batch_table1;
var marks_table1;
function init_tab1()
{
	batch_table1=$('#batch_table1').DataTable();
	marks_table1=$('#marks_table1').DataTable();
	get_institute1();
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
	post_arguments['type']='access';
	post_arguments['request']='get_courses';
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
				}
			}
		});
}

function select_submit1()
{
	selected_list_course1=$('#courses_list1').val();
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
	post_arguments['data']=JSON.stringify(temp_dict);
	$.post(address,post_arguments,display_batch1)
}
function display_batch1(data,status)
{
	if(status=='success')
	{
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
		return `<a id='batch_`+index+`' class='hand' data-toggle="modal" data-target="#marks1" onclick='load_students1(this.id,`+type+`)'>N</a>`;
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
	marks_table1.clear().draw();
	marks1=[];
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
					'-'
					])
			}
			marks_table1.draw();
		}
	}

}

function load_students1(id,type)
{
	marks_table1.clear().draw();
	var no=id.substring(id.indexOf('_')+1,id.length);
	var post_arguments={};
	post_arguments['type']='marks';
	post_arguments['request']='get_students';
	temp_dict={};
	selected_subject1=batches1[no]['subject'];
	selected_type1=type;
	temp_dict['institute']=batches1[no]['institute'];
	temp_dict['subject']=selected_subject1;
	temp_dict['type']=type;
	post_arguments['data']=JSON.stringify(temp_dict);
	$.post(address,post_arguments,
		fill_students1);
}
function fill_students1(data,status)
{
	if(status=='success')
	{
		console.log(data);
		marks_table1.clear();
		var datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			marks1=datah['reply']
			for (var i=0; i<marks1.length;i++)
			{
				marks_table1.row.add([marks1[i]['rollno'],
					marks1[i]['name'],
					marks1[i]['marks'],
					'-'
					])
			}
			marks_table1.draw();
		}
	}
}
function submit_marks()
{

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