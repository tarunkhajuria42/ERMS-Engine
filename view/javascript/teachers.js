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
var selected_list_semester1;
var edit_in_progress3=false;
var selected_subject1;
var selected_type1;
var batch_table1;
var marks_table1;
var marks_to_submit=[];
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
	selected_list_course1=$('#courses_list1').val();
	selected_list_semester1=$('#semester_list1').val();
	load_batch1();
}
function reset_tab1()
{
	batches1=[];
	marks1=[];
	reset_marks1();
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
	temp_dict['semester']=selected_list_semester1;
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
	if(available==-1 || available==2)
	{
		return '-';
	}
}
// Marks functions
var marks_received1=[];
var temp_submit=0;
function reset_marks1()
{
	temp_submit=0;	
}
function load_marks1(id,type)
{
	error_marks1('');
	$('#submit_btn').hide();
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
			marks1=datah['reply'];
			for (var i=0; i<marks1.length;i++)
			{
				marks_table1.row.add([marks1[i]['rollno'],
					marks1[i]['name'],
					marks1[i]['marks'],
					]);
			}
			marks_table1.draw();
		}
	}

}

function load_students1(id,type)
{
	error_marks1('');
	$('#submit_btn').show();
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
			marks1=datah['reply'];
			marks_received1=JSON.parse(JSON.stringify(marks1));
			for (var i=0; i<marks1.length;i++)
			{
				var string=marks_string1(marks1[i]['marks'],i);
				console.log(marks1[i]['marks']);
				console.log(string);
				marks_table1.row.add([marks1[i]['rollno'],
					marks1[i]['name'],
					string
					]);
			}
			marks_table1.draw();
		}
	}
}
function marks_string1(marks,i)
{
if(marks==-1)
{
	var string="<input type='text' id='marksedit_"+i+"'>";
	return string;
}
else 
	return marks;
}

function submit_marks1()
{
	if(temp_submit==0)
	{
		temp_submit=1;
		for(var i=0; i<marks1.length; i++)
		{
			if(marks_received1[i]['marks']==-1)
			{
				if($('#marksedit_'+i).val()!='')
				{
					marks1[i]['marks']=$('#marksedit_'+i).val();	
				}
				$('#marksedit_'+i).val('');
			}
		}
		temp_submit=1;
		error_marks1('Submit again for verification');
	}
	else if(temp_submit==1)
	{
		marks_to_submit=[];
		
		for(var i=0; i<marks1.length;i++)
		{
			var temp_dict={};
			if(marks_received1[i]['marks']==-1)
			{
				console.log($('#marksedit_'+i).val());
				console.log(marks1[i]['marks']);
				if($('#marksedit_'+i).val()==marks1[i]['marks'])
				{
					temp_dict['rollno']=marks1[i]['rollno'];
					temp_dict['marks']=marks1[i]['marks'];
					temp_dict['subject']=selected_subject1;
					temp_dict['type']=selected_type1;
					marks_to_submit.push(temp_dict);
				}
			}
		}
		var post_arguments={};
		post_arguments['type']='marks';
		post_arguments['request']='add_marks';
		post_arguments['data']=JSON.stringify(marks_to_submit);
		$.post(address,post_arguments,submit_complete);
	}
}
function submit_complete(data,status)
{
	if(status=='success')
	{
		console.log(data);
		datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			var no;
			for(var i=0; i<marks_to_submit.length;i++)
			{
				
				no=find_element(marks_received1,'rollno',marks_to_submit[i]['rollno']);
				console.log(no);
				marks_received1[no]['marks']=marks1[no]['marks'];
				marks_table1.row($('#marksedit_'+no).parents('tr')).remove();
				marks_table1.row.add([marks1[no]['rollno'],
					marks1[no]['name'],
					marks1[no]['marks']
					]);
			}
			marks_table1.draw();
			error_marks1('Submitted Matched Values');
			temp_submit=0;
		}
	}
}
function error_batch1(text)
{
	$('#info_batch1').text(text);
}
function error_marks1(text)
{
	$('#info_marks1').text(text);
}
//******************************************************Utility Functions ****************************************
function find_element(object,key,value)
{
	for (var i=0;i<object.length;i++)
	{
		if(object[i][key]==value)
		{
			return i;
		}
	}
	return -1;
}