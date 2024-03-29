init();
var institutes_table;
var institutes_courses1;

var all_courses=[];
function init()
{
	$("#wtext").text("Welcome : "+user_id);
	init_tab1();
	init_tab2();
	init_tab3();
	init_tab4();
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
function init_tab1()
{
	institutes_table1=$("#institutes_table").DataTable();
	institutes_courses1=$("#institutes_courses").DataTable();
	load_institutes();

}
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
		console.log(data);
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
		institutes_courses1.row.add([`<select id='courses_new_input' >`,
			`<button id='courses_button_new' class='btn pull-right btn-info'onclick='new_course_add()'>Add </button>`]).draw();		
		new_course_opened1=true;
		load_courses1();
		error_courses1("");
	}
	else
	{
		error_courses1("One course a time please!!");
	}	
}
function load_courses1()
{
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='all_courses';
	$.post(address,post_arguments,
		function list_courses1(data,status)
		{	
			if(status=='success')
			{
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					var all_courses1=datah['reply'];
					$('#courses_new_input').empty();
					for(var i=0; i<all_courses1.length;i++)
					{
						$('#courses_new_input').append($('<option>', {
    						value: all_courses1[i],
    						text: all_courses1[i]}));
					}
				}
			}
		});
}
function new_course_add()
{
	var temp_new_course=$('#courses_new_input').val()
	if(temp_new_course!='')
	{
		if(courses1.indexOf(temp_new_course)==-1)
		{	
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
			courses1.push(temp_new_course);
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
	var indextemp=new_courses1.indexOf(courses1[no]);
	if(indextemp!=-1)
		new_courses1.splice(indextemp,1);
	else
		deleted_courses1.push(courses1[no]);
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
		$.post(address,post_arguments,
			function handle_submit_added(data,status)
			{
				if(status=='success'){
					if(data!=null)
					{
						datah=JSON.parse(data);
						if(datah['type']=='success')
						{
							new_courses1=[];
							add_reply=2;
						}
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
						{
							delete_reply=2;
							deleted_courses1=[];
						}	
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
var courses_table2;
var courses_subjects2;
var new_course_opened2=false;
var selected_course2;
var edit_subject_inprogress=false;
var new_subject_opened2=false;
var subjects2=[];
var edited_subjects2=[];
var new_subjects2=[];
var deleted_subjects2=[];
function reset_all2()
{
	subjects2=[];
	edited_subjects2=[];
	new_subjects2=[];
	deleted_subjects2=[];
	edit_subject_inprogress=false;
	new_subject_opened2=false;
	new_course_opened2=false;
	subjects_table2.clear();
}
function init_tab2()
{
	courses_table2=$("#courses_table2").DataTable();
	subjects_table2=$("#subjects_table2").DataTable({"scrollX":true});
	//courses_subjects2=$("#courses_subjects").DataTable();
	fill_courses2();
}
function fill_courses2()
{
	reset_all2();
	$.post(address,
	{
		type:'lists',
		request:'all_courses'
	},
	function courses_fill(data,status)
	{
		courses_table2.clear();
		datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			all_courses=datah['reply'];
			for (var i=0; i<all_courses.length;i++)
			{
				courses_table2.row.add([all_courses[i],
					`<button id='coursesbutton_`+i+`' onclick='add_subjects2(this.id)' data-toggle="modal" data-target="#subjects2" class='btn btn-info pull-right'>Add/Edit</button>`]);
			}
			courses_table2.draw();	
		}
	});
}

function new_course2()
{
	if(!new_course_opened2)
	{
		courses_table2.row.add([`<input id='new_course2' type='text'>`,
			`<button id='new_button' onclick='add_subjects2(this.id)' data-toggle="modal" data-target="#subjects2" class='btn btn-info pull-right'>Add</button>`]);
		courses_table2.draw();
		new_course_opened2=true;
	}
	else
	{
		error_course2('One course at a time Please');
	}
}
function add_subjects2(id)
{
	var type= id.substring(0, id.indexOf("_"));
	var no=id.substring(id.indexOf("_")+1,id.length);
	
	if(type=='coursesbutton')
	{
		selected_course2=all_courses[no];
	}
	else
	{
		selected_course2=$('#new_course2').val();
	}
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_subjects';
	post_arguments['value']=selected_course2;	
	$.post(address,
			post_arguments,
			populate_subjects2
			);
}
//Subject functions
function populate_subjects2(data,status)
{
	
	if(status=='success')
	{
		var datah= JSON.parse(data);
		if(datah['type']=='success')
		{
			reset_all_subjects2();
			subjects2=datah['reply'];
			subjects2_retrieved=subjects2;
			show_subjects2();
		}
	}
}
function show_subjects2()
{
	var optional=['No','Yes'];
	subjects_table2.clear();
	for(var i=0; i<subjects2.length;i++)
			{
				subjects_table2.row.add([
					subjects2[i]['subject_code'],
					subjects2[i]['subject'],
					subjects2[i]['semester'],
					subjects2[i]['pipractical'],
					subjects2[i]['mipractical'],
					subjects2[i]['pitheory'],
					subjects2[i]['mitheory'],
					subjects2[i]['ppractical'],
					subjects2[i]['mpractical'],
					subjects2[i]['ptheory'],
					subjects2[i]['mtheory'],
					optional[subjects2[i]['optional']],
					`<button id='editsubjects2_`+i+`' onclick='edit_subject2(this.id)'  class='btn btn-info pull-right'>Edit</button>`,	
					`<button id='buttonsubjects2_`+i+`' onclick='remove_subject2(this.id)'  class='btn btn-info pull-right'>Remove</button>`
					]);
			}
			subjects_table2.draw();	
}
function reset_all_subjects2()
{
	
	subjects2=[];
	subjects2_retrieved=[];
}
// Handles remove course button click
function remove_subject2(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var indextemp=find_element(new_subjects2,'subject_code',subjects2[no]['subject_code']);
	if(indextemp!=-1)
		new_subjects2.splice(indextemp,1);
	else
	{
		deleted_subjects2.push(subjects2[no]);
	}
	var indexedited=find_element(edited_subjects2,'subject_code',subjects2[no]['subject_code']);
	if(indexedited!=-1)
	{
		edited_subjects2.splice(indexedited,1);
	}
	subjects_table2.row($('#'+id).parents('tr')).remove().draw();
}

function edit_subject2(id)
{
	if(!edit_subject_inprogress)
	{
		var no=id.substring(id.indexOf('_')+1,id.length);
		subjects_table2.row($('#buttonsubjects2_'+no).parents('tr')).remove().draw();
		var optional_string;
		if(subjects2[no]['optional']==0)
		{
				optional_string=`'>
						<option value='0'>No</option>
						<option value='1'>Yes</option>
					</select>`
		}
		else
		{
			optional_string=`'>
						<option value='1'>Yes</option>
						<option value='0'>No</option>
					</select>`
		}

		subjects_table2.row.add([
					subjects2[no]['subject_code'],
					subjects2[no]['subject'],
					`<input type='text' id='edit_semester2_`+no+`' value='`+subjects2[no]['semester']+`'/>`,
					`<input type='text' id='edit_pipractical2_`+no+`' value='`+subjects2[no]['pipractical']+`'/>`,
					`<input type='text' id='edit_mipractical2_`+no+`' value='`+subjects2[no]['mipractical']+`'/>`,
					`<input type='text' id='edit_pitheory2_`+no+`' value='`+subjects2[no]['pitheory']+`'/>`,
					`<input type='text' id='edit_mitheory2_`+no+`' value='`+subjects2[no]['mitheory']+`'/>`,
					`<input type='text' id='edit_ppractical2_`+no+`' value='`+subjects2[no]['ppractical']+`'/>`,
					`<input type='text' id='edit_mpractical2_`+no+`' value='`+subjects2[no]['mpractical']+`'/>`,
					`<input type='text' id='edit_ptheory2_`+no+`' value='`+subjects2[no]['ptheory']+`'/>`,
					`<input type='text' id='edit_mtheory2_`+no+`' value='`+subjects2[no]['mtheory']+`'/>`,
					`<select id='edit_optional2_`+no+optional_string,'_',
					`<button id='submitedit2button_`+no+`' onclick='submit_edit2(this.id)'  class='btn btn-info pull-right'>Done</button>`
					]);
		subjects_table2.draw();
		edit_subject_inprogress=true;	
	}
	else
		error_subjects2('Edit, one at a time !!');
}
function submit_edit2(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var edit_index=find_element(edited_subjects2,'subject_code',subjects2[no]['subject_code']);
	var new_index=find_element(new_subjects2,'subject_code',subjects2[no]['subject_code']);
	if(new_index!=-1)
	{
		new_subjects2[new_index]['semester']=$('#edit_semester2_'+no).val();
		new_subjects2[new_index]['pipractical']=$('#edit_pipractical2_'+no).val();
		new_subjects2[new_index]['mipractical']=$('#edit_mipractical2_'+no).val();
		new_subjects2[new_index]['pitheory']=$('#edit_pitheory2_'+no).val();
		new_subjects2[new_index]['mitheory']=$('#edit_mitheory2_'+no).val();
		new_subjects2[new_index]['ppractical']=$('#edit_ppractical2_'+no).val();
		new_subjects2[new_index]['mpractical']=$('#edit_mpractical2_'+no).val();
		new_subjects2[new_index]['ptheory']=$('#edit_ptheory2_'+no).val();
		new_subjects2[new_index]['mtheory']=$('#edit_mtheory2_'+no).val();
		new_subjects2[new_index]['optional']=$('#edit_optional2_'+no).val();	
	}
	else if(edit_index!=-1)
	{
		edited_subjects2[edit_index]['semester']=$('#edit_semester2_'+no).val();
		edited_subjects2[edit_index]['pipractical']=$('#edit_pipractical2_'+no).val();
		edited_subjects2[edit_index]['mipractical']=$('#edit_mipractical2_'+no).val();
		edited_subjects2[edit_index]['pitheory']=$('#edit_pitheory2_'+no).val();
		edited_subjects2[edit_index]['mitheory']=$('#edit_mitheory2_'+no).val();
		edited_subjects2[edit_index]['ppractical']=$('#edit_ppractical2_'+no).val();
		edited_subjects2[edit_index]['mpractical']=$('#edit_mpractical2_'+no).val();
		edited_subjects2[edit_index]['ptheory']=$('#edit_ptheory2_'+no).val();
		edited_subjects2[edit_index]['mtheory']=$('#edit_mtheory2_'+no).val();
		edited_subjects2[edit_index]['optional']=$('#edit_optional2_'+no).val();
	}
	else
	{
		var temp_dict={};
		temp_dict['subject_code']=subjects2[no]['subject_code'];
		temp_dict['subject']=subjects2[no]['subject'];
		temp_dict['semester']=$('#edit_semester2_'+no).val();
		temp_dict['pipractical']=$('#edit_pipractical2_'+no).val();
		temp_dict['mipractical']=$('#edit_mipractical2_'+no).val();
		temp_dict['pitheory']=$('#edit_pitheory2_'+no).val();
		temp_dict['mitheory']=$('#edit_mitheory2_'+no).val();
		temp_dict['ppractical']=$('#edit_ppractical2_'+no).val();
		temp_dict['mpractical']=$('#edit_mpractical2_'+no).val();
		temp_dict['ptheory']=$('#edit_ptheory2_'+no).val();
		temp_dict['mtheory']=$('#edit_mtheory2_'+no).val();
		temp_dict['optional']=$('#edit_optional2_'+no).val();
		edited_subjects2.push(temp_dict);	
	}
	
	//change in subject2
	subjects2[no]['semester']=$('#edit_semester2_'+no).val();
	subjects2[no]['pipractical']=$('#edit_pipractical2_'+no).val();
	subjects2[no]['mipractical']=$('#edit_mipractical2_'+no).val();
	subjects2[no]['pitheory']=$('#edit_pitheory2_'+no).val();
	subjects2[no]['mitheory']=$('#edit_mitheory2_'+no).val();
	subjects2[no]['ppractical']=$('#edit_ppractical2_'+no).val();
	subjects2[no]['mpractical']=$('#edit_mpractical2_'+no).val();
	subjects2[no]['ptheory']=$('#edit_ptheory2_'+no).val();
	subjects2[no]['mtheory']=$('#edit_mtheory2_'+no).val();
	subjects2[no]['optional']=$('#edit_optional2_'+no).val();
	var optional=['No','Yes'];
	subjects_table2.row($('#'+id).parents('tr')).remove();
	subjects_table2.row.add([
					subjects2[no]['subject_code'],
					subjects2[no]['subject'],
					subjects2[no]['semester'],
					subjects2[no]['pipractical'],
					subjects2[no]['mipractical'],
					subjects2[no]['pitheory'],
					subjects2[no]['mitheory'],
					subjects2[no]['ppractical'],
					subjects2[no]['mpractical'],
					subjects2[no]['ptheory'],
					subjects2[no]['mtheory'],
					optional[subjects2[no]['optional']],
					`<button id='editsubjects2_`+no+`' onclick='edit_subject2(this.id)'  class='btn btn-info pull-right'>Edit</button>`,	
					`<button id='buttonsubjects2_`+no+`' onclick='remove_subject2(this.id)'  class='btn btn-info pull-right'>Remove</button>`
					]).draw();
	edit_subject_inprogress=false;	
}
function new_subject_button2()
{
	if(!new_subject_opened2)
	{
		var no=subjects2.length;
		subjects_table2.row.add([`<input type='text' id='new_subjectCode2_`+no+`' />`,
					`<input type='text' id='new_subjectname2_`+no+`' />`,
					`<input type='text' id='new_semester2_`+no+`' />`,
					`<input type='text' id='new_pipractical2_`+no+`'/>`,
					`<input type='text' id='new_mipractical2_`+no+`'/>`, 
					`<input type='text' id='new_pitheory2_`+no+`'/>`, 
					`<input type='text' id='new_mitheory2_`+no+`'/>`, 
					`<input type='text' id='new_ppractical2_`+no+`'/>`,
					`<input type='text' id='new_mpractical2_`+no+`'/>`,
					`<input type='text' id='new_ptheory2_`+no+`'/>`,
					`<input type='text' id='new_mtheory2_`+no+`'/>`,
					`<select id='new_optional2_`+no+`''>
						<option value='0'>No</option>
						<option value='1'>Yes</option>
					</select>`,'',
			`<button id='subjectsButtonNew_`+no+`' class='btn pull-right btn-info'onclick='new_subject_add(this.id)'>Done</button>`]).draw();		
		new_subject_opened2=true;
		error_subjects2("Success");
	}
	else
	{
		error_subjects2("One course at a time please!!");
	}	
}
function new_subject_add(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var temp_dict={};
	var index=find_element(subjects2,'subject_code',$('#new_subjectCode2_'+no).val());
	var index_deleted=find_element(deleted_subjects2,'subject_code',$('#new_subjectCode2_'+no).val());
	var index_new=find_element(new_subjects2,'subject_code',$('#new_subjectCode2_'+no).val());
	if(index_new!=-1)
	{
		error_subjects2("Already Added");
	}
	else
	{
		var optional=['No','Yes'];
		temp_dict['subject_code']=$('#new_subjectCode2_'+no).val();
		temp_dict['subject']=$('#new_subjectname2_'+no).val();
		temp_dict['semester']=$('#new_semester2_'+no).val();
		temp_dict['pipractical']=$('#new_pipractical2_'+no).val();
		temp_dict['mipractical']=$('#new_mipractical2_'+no).val();
		temp_dict['pitheory']=$('#new_pitheory2_'+no).val();
		temp_dict['mitheory']=$('#new_mitheory2_'+no).val();
		temp_dict['ppractical']=$('#new_ppractical2_'+no).val();
		temp_dict['mpractical']=$('#new_mpractical2_'+no).val();
		temp_dict['ptheory']=$('#new_ptheory2_'+no).val();
		temp_dict['mtheory']=$('#new_mtheory2_'+no).val();
		temp_dict['optional']=$('#new_optional2_'+no).val();

		new_subjects2.push(temp_dict);
		subjects2.push(temp_dict);
		subjects_table2.row($('#'+id).parents('tr')).remove();
		subjects_table2.row.add([
			temp_dict['subject_code'],
			temp_dict['subject'],
			temp_dict['semester'],
			temp_dict['pipractical'],
			temp_dict['mipractical'],
			temp_dict['pitheory'],
			temp_dict['mitheory'],
			temp_dict['ppractical'],
			temp_dict['mpractical'],
			temp_dict['ptheory'],
			temp_dict['mtheory'],
			optional[temp_dict['optional']],
			`<button id='editsubjects2_`+no+`' onclick='edit_subject2(this.id)'  class='btn btn-info pull-right'>Edit</button>`,	
			`<button id='buttonsubjects2_`+no+`' onclick='remove_subject2(this.id)'  class='btn btn-info pull-right'>Remove</button>`
			]).draw();
		new_subject_opened2=false;
	}

}
var add_reply2=0;
var edited_reply2=0;
var deleted_reply2=0;

function submit_new_subjects2()
{
	 var argument={};
	 argument['type']='lists';
	 argument['request']='add_subjects';
	 var temp_dict={};
	 temp_dict['course']=selected_course2;
	 temp_dict['subjects']=new_subjects2;
	 argument['data']=JSON.stringify(temp_dict);
$.post(address,argument,
	function handle_new_subjects2(data,status)
	{
		if(status='success')
		{
			var datah=JSON.parse(data);
			if(datah['type']='success')
				new_subjects2=[];
			else
				error_subjects2('Could not add courses');
		}
		else
			error_subjects2('Network Error');
	});
}


function submit_delete_subjects2()
{
	var argument={};
	 argument['type']='lists';
	 argument['request']='delete_subjects';
	 var temp_dict={};
	 temp_dict['course']=selected_course2;
	 temp_dict['subjects']=deleted_subjects2;
	 argument['data']=JSON.stringify(temp_dict);
$.post(address,argument,
	function handle_delete_subjects2(data,status)
	{
		if(status='success')
		{
			var datah=JSON.parse(data);
			if(datah['type']='success')
			{
				deleted_subjects2=[];
				if(edited_subjects2)
				{
					if(edited_subjects2.length>0)
						submit_edited_subjects2();	
					else if(new_subjects2.length>0)
						submit_new_subjects2();
				}
			}
			else
				error_subjects2('Could not delete courses');
		}
		else
			error_subjects2('Network Error');
	});

}
function submit_edited_subjects2()
{
	var argument={};
	 argument['type']='lists';
	 argument['request']='edit_subjects';
	 var temp_dict={};
	 temp_dict['course']=selected_course2;
	 temp_dict['subjects']=edited_subjects2;
	 argument['data']=JSON.stringify(temp_dict);
$.post(address,argument,
	function handle_edited_subjects2(data,status)
	{
		if(status='success')
		{
			var datah=JSON.parse(data);
			if(datah['type']='success')
			{
				edited_subjects2=[];
				if(new_subjects2.length>0)
					submit_new_subjects2();
			}
			else
				error_subjects2('Could not edit courses');
		}
		else
			error_subjects2('Network Error');
	});
}
function save_subjects2()
{
	
	if(deleted_subjects2.length>0)
	{
		submit_delete_subjects2();	
	}
	else if(edited_subjects2.length>0)
	{
		submit_edited_subjects2();
	}
	else if(new_subjects2.length>0)
	{
		submit_new_subjects2();
	}
}

function error_course2(text)
{
	$('#info_courses2').text(text);
}
function error_subjects2(text)
{
	$('#info_subjects2').text(text);	
}
//****************************************************** Marks Functions *****************************************
var batches3=[];
var marks3=[];
var institutes3=[];
var courses3=[];
var semesters3=[];
var selected_list_insti3='all';
var selected_list_course3='all';
var selected_list_semester3;
var edit_in_progress3=false;
var selected_subject3;
var batch_table3;
var marks_table3;
function init_tab3()
{
	batch_table3=$('#batch_table3').DataTable();
	marks_table3=$('#marks_table3').DataTable();
	load_institutes3();
	selected_list_insti3=$('#institutes_list3').val();
	load_courses3();
	selected_list_course3=$('#courses_list3').val();
	load_semester3();
	$('#institutes_list3').change(
		function change_institute3()
		{
			selected_list_insti3=$('#institutes_list3').val();
			load_courses3();
		});
	$('#courses_list3').change(
		function change_courses3()
		{
			selected_list_course3=$('#courses_list3').val();
			load_semester3();
		});

}
function load_institutes3()
{
	
	$.post(address,
	{
		type:'lists',
		request:'all_institutes'
	},
	function institutes_fill3(data,status)
	{
		datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			institutes3=datah['reply'];
			$('#institutes_list3').empty();
			$('#institutes_list3').append($('<option>', {
    				value: 'all',
    				text: 'all'}));
			for (var i=0; i<institutes3.length;i++)
			{
				$('#institutes_list3').append($('<option>', {
    				value: institutes3[i],
    				text: institutes3[i]}));
			}
		}
	});
}

function load_courses3()
{
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_courses';
	post_arguments['value']=selected_list_insti3;
	$.post(address,post_arguments,
		function list_courses3(data,status)
		{	
			if(status=='success')
			{
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					courses3=datah['reply'];
					$('#courses_list3').empty();
					$('#courses_list3').append($('<option>', {
    				value: 'all',
    				text: 'all'}));
					for(var i=0; i<courses3.length;i++)
					{
						$('#courses_list3').append($('<option>', {
    						value: courses3[i],
    						text: courses3[i]}));
					}
				}
			}
		});
}
function load_semester3()
{
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_semesters';
	temp={};
	temp['institute']=selected_list_insti3;
	temp['course']=selected_list_course3;
	post_arguments['data']=JSON.stringify(temp);
	$.post(address,post_arguments,
		function list_semesters3(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					semesters3=datah['reply'];
					$('#semester_list3').empty();
					for(var i=0; i<semesters3.length;i++)
					{
						$('#semester_list3').append($('<option>', {
    						value: semesters3[i]['semester'],
    						text: semesters3[i]['semester']}));
					}
				}

			}
		});
}

function select_submit3()
{
	selected_list_semester3=$('#semester_list3').val();
	load_batch3();
}
function reset_tab3()
{
	edit_in_progress3=false;
	batches3=[];
	marks3=[];


}
function load_batch3()
{
	reset_tab3();
	var  post_arguments={};
	post_arguments['type']='marks';
	post_arguments['request']='get_subjects';
	var temp_dict={};
	temp_dict['course']=selected_list_course3;
	temp_dict['institute']=selected_list_insti3;
	temp_dict['semester']=selected_list_semester3;
	post_arguments['data']=JSON.stringify(temp_dict);
	$.post(address,post_arguments,display_batch3)
}
function display_batch3(data,status)
{
	//console.log(data);
	if(status=='success')
	{
		
		var datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			batch_table3.clear().draw();
			batches3=datah['reply'];
			for(var i=0; i<batches3.length; i++)
			{	
				
				batch_table3.row.add([batches3[i]['subject_code'],
					batches3[i]['subject'],
					batches3[i]['institute'],
					batches3[i]['course'],
					optional_link(batches3[i]['internal'],i,0),
					optional_link(batches3[i]['external'],i,1)
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
	else if(available==1)
	{
		return `<a id='batch_`+index+`' class='hand' data-toggle="modal" data-target="#marks3" onclick='load_marks3(this.id,`+type+`)'>Y</a>`;
	}
	else if(available==-1 || available==2)
	{
		return '-';
	}
}
// Marks functions
function load_marks3(id,type)
{
	marks_table3.clear();
	var no=id.substring(id.indexOf('_')+1,id.length);
	var post_arguments={};
	post_arguments['type']='marks';
	post_arguments['request']='get_marks';
	temp_dict={};
	selected_subject3=batches3[no]['subject'];
	selected_type3=type;
	temp_dict['institute']=batches3[no]['institute'];
	temp_dict['subject']=selected_subject3;
	temp_dict['type']=type;
	post_arguments['data']=JSON.stringify(temp_dict);
	$.post(address,post_arguments,
		fill_marks3);
}
function fill_marks3(data,status)
{
	if(status=='success')
	{
		console.log("yahoo");
		var datah=JSON.parse(data);
		if(datah['type']=='success')
		{
			data_pack=datah['reply'];
			$('#max_marks').text("Max Marks:"+data_pack['max']);
			marks3=data_pack['marks'];
			for (var i=0; i<marks3.length;i++)
			{
				marks_table3.row.add([marks3[i]['rollno'],
					marks3[i]['name'],
					marks3[i]['marks'],
					marks3[i]['last_edit'],
					marks3[i]['comment'],
					marks3[i]['institute_id'],
					`<button id='marksedit_`+i+`' class='btn btn-info' onclick='edit_marks3(this.id)'>Edit</button>`
					])
			}
			marks_table3.draw();
		}
	}

}
function edit_marks3(id)
{
	
	if(edit_in_progress3==false)
	{
		var no=id.substring(id.indexOf('_')+1,id.length);
		marks_table3.row($('#'+id).parents('tr')).remove();
		marks_table3.row.add([marks3[no]['rollno'],
						marks3[no]['name'],
						`<input type='text' id='marksedit_`+no+`' value='`+marks3[no]['marks']+`'>`,
						marks3[no]['last_edit'],	
						`<input type='text' id='comment_`+no+`'>`,
						marks3[no]['institute_id'],
			`<button id='marksedit_`+no+`' class='btn btn-info' onclick='submit_edit_marks3(this.id)'>Done</button>`
			]).draw();
		edit_in_progress3=true;
	}
	else
		error_marks3('Edit, One at a time Please');
}
function submit_edit_marks3(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
		row_in_edit=id;
	var post_arguments={};
		post_arguments['type']='marks';
		post_arguments['request']='edit_marks';
		var temp_dict={};
		temp_dict['subject']=selected_subject3;
		temp_dict['type']=selected_type3;
		temp_dict['marks']=$('#marksedit_'+no).val();
		temp_dict['userid']=user_id;
		temp_dict['comment']=$('#comment_'+no).val();
		temp_dict['rollno']=marks3[no]['rollno'];
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
					edit_in_progress3=false;
					var no=row_in_edit.substring(row_in_edit.indexOf('_')+1,row_in_edit.length);
					marks3[no]['marks']=$('#marksedit_'+no).val();
					marks3[no]['comment']=$('#comment_'+no).val();
					marks3[no]['userid']=user_id;
					marks_table3.row($('#'+row_in_edit).parents('tr')).remove();
					marks_table3.row.add([marks3[no]['rollno'],
						marks3[no]['name'],
						marks3[no]['marks'],
						marks3[no]['last_edit'],
						marks3[no]['comment'],
						marks3[no]['institute_id'],
						`<button id='marksedit_`+no+`' class='btn btn-info' onclick='edit_marks3(this.id)'>Edit</button>`
						]).draw();
				}
				else
					error_batch3('System Error');
			}
			else
				error_batch3('Network Error');
		});
}
function error_batch3(text)
{
	$('#error_batch3').text(text);
}
function error_marks3(text)
{
	$('#error_batch3').text(text);
}
//****************************************************** Tab 4 (Sessions) ****************************************
function init_tab4()
{
	load_session4();
}
var session_name_list=['Registration','ExamFrom','Admit Card','External','Result'];
function load_session4()
{
	$.post(address,
	{
		type:'session',
		request:'get_session'
	},
	function set_session(data,status)
	{
		if(status=='success')
		{
			console.log(data);
			var datah=JSON.parse(data);
			if(datah['type']='success')
			{
				var info=datah['reply'];
				var session_no=info[0]['sessionid'];
				if(session_no>4)
					$('#session_semester3').text('Even');
				else
					$('#session_semester3').text('Odd');	
				var sessionid=session_no%5;
				$('#session_name3').text(session_name_list[sessionid]);
				$('#session_year3').text(info[0]['year']);
				
			}
		}
	});
}
function next_session4()
{
	$.post(address,
	{
		type:'session',
		request:'next_session'
	},
	function next_session_set(data,status)
	{
		if(status=='success')
		{
			var datah=JSON.parse(data);
			if(datah['type']='success')
			{
				load_session4();
			}
			else
				error_session4('System Error');
		}
		else
			error_session4('Network Error, Could not connect');

	});
}
function error_session4(text)
{
	$('#error_tab4').text(text);
}
//****************************************************** Date Sheet Functions ************************************
courses5=[];
subjects5=[];
semesters5=[];	
selected_list_course5='all';
var selected_list_semester5;
function init_tab5()
{
	datesheet_table5=$('#datesheet_table5').DataTable();
	load_courses5();
	
	$('#courses_list5').change(
		function change_courses5()
		{
			selected_list_course5=$('#courses_list5').val();
			load_semester5();
		});
}
function load_courses5()
{
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_courses';
	post_arguments['value']='all';
	$.post(address,post_arguments,
		function list_courses5(data,status)
		{	
			error_datesheet5('');
			if(status=='success')
			{
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					courses5=datah['reply'];
					$('#courses_list5').empty();
					for(var i=0; i<courses5.length;i++)
					{
						$('#courses_list5').append($('<option>', {
    						value: courses5[i],
    						text: courses5[i]}));
					}
				}
				selected_list_course5=$('#courses_list5').val();
				load_semester5();
			}
		});
}
function load_semester5()
{
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_semesters';
	temp={};
	temp['institute']='all';
	temp['course']=selected_list_course5;
	post_arguments['data']=JSON.stringify(temp);
	$.post(address,post_arguments,
		function list_semesters5(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					semesters5=datah['reply'];
					$('#semester_list5').empty();
					for(var i=0; i<semesters5.length;i++)
					{
						$('#semester_list5').append($('<option>', {
    						value: semesters5[i]['semester'],
    						text: semesters5[i]['semester']}));
					}
				}
			}
		});
}

function submit_course5()
{
	var post_arguments={};
	post_arguments['type']='marks';
	post_arguments['request']='get_datesheet';
	temp={};
	temp['course']=$('#courses_list5').val();
	temp['semester']=$('#semester_list5').val();
	post_arguments['data']=JSON.stringify(temp);
	$.post(address,post_arguments,
		function list_datesheet(data,status)
		{
			if(status='success')
			{
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					subjects5=datah['reply'];
					datesheet_table5.clear();
					for(var i=0; i<subjects5.length;i++)
					{
						datesheet_table5.row.add([
							subjects5[i]['subject'],
							date_string(subjects5[i]['date'],i)]);
						datesheet_table5.draw();
					}
				}
			}
		});
}
function date_string(date,i)
{
	if(date!=-1)
		str=`<input id='date_`+i+`' type='date' value='`+date+`'>`;
	else
		str=`<input id='date_`+i+`' type='date' >`;
	return str;
}

function save_datesheet5()
{
	temp_array=[];
	for(var i=0; i<subjects5.length;i++)
	{
		if($('#date_'+i).val()!='')
		{
			temp_dict={};
			temp_dict['subject']=subjects5[i]['subject'];
			temp_dict['date']=$('#date_'+i).val();
			if(subjects5[i]['date']==-1)
				temp_dict['type']=1;
			else
				temp_dict['type']=0;
			temp_array.push(temp_dict);
		}
	}
	var post_arguments={};
	post_arguments['type']='marks';
	post_arguments['request']='add_datesheet';
	post_arguments['data']=JSON.stringify(temp_array);
	$.post(address,post_arguments,
	function save_result(data,status)
	{
		if(status=='success')
		{
			console.log(data);
			var datah=JSON.parse(data);
			if(datah['type']=='success')
				error_datesheet5('Success!!');
			else
				error_datesheet5('System Error');
		}
		else
			error_datesheet5('Network Error');
	});
}
function error_datesheet5(text)
{
	$('#info_datesheet5').text(text);
}
//******************************************************  Manage Users    ***************************************
var institutes_table6;
var users_table6;
var institutes6=[];
var users6=[];
var selected_insti6;
var is_new_opened6=false;
init_tab6();

function init_tab6()
{
institutes_table6=$('#institutes_table6').DataTable();
users_table6=$('#users_table6').DataTable();
load_institutes6();
} 
function reset6()
{
	is_new_opened6=false;
	users6=[];

}
function load_institutes6()
{
	institutes6=[];
	institutes_table6.clear();
	new_institute_opened6=false;

	$.post(address,
	{
		type:'lists',
		request:'all_institutes'
	},
	function institutes_fill6(data,status)
	{
		datah=JSON.parse(data);
		
		if(datah['type']=='success')
		{
			institutes6=datah['reply'];
			for (var i=0; i<institutes6.length;i++)
			{
				institutes_table6.row.add([institutes6[i],
					`<button id='insti_`+i+`' onclick='add_edit_user6(this.id)' data-toggle="modal" data-target="#users6" class='btn btn-info pull-right'>Add/Edit</button>`]);
			}
			institutes_table6.draw();
		}
	});
}
function add_edit_user6(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	selected_insti6=institutes6[no];
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='get_users';
	temp={};
	temp['institute']=selected_insti6;
	temp['course']='all';
	post_arguments['data']=JSON.stringify(temp);
	$.post(address,post_arguments,
		function populate_users(data,status)
		{
			if(status=='success')
			{
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					users_table6.clear();
					users6=datah['reply'];
					for(var i=0; i<users6.length;i++)
					{
						users_table6.row.add([
							users6[i],
							`<button onclick='remove_user6(this.id)' class='btn btn-warning pull-right'id='removeuser_`+i+`'>Remove</button>`]);
					}
					users_table6.draw();
				}
			}
		});
}
function new_user6()
{
	var no=users6.length;
	if(!is_new_opened6)
	{
		users_table6.row.add([
			`<input id='email_`+no+`' type='text'>`,
			`<button onclick='submit_new6(this.id)'' class='btn btn-info pull-right' id='adduser_`+no+`'>Add</button>`]);
		users_table6.draw();
		is_new_opened6=true;
	}
	else
	{
		message_user6("Add one user at a time!!");
	}
}
function submit_new6(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var value=$('#email_'+no).val();
	var data={};
	data['institute']=selected_insti6;
	data['course']='all';
	data['email']=value;
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='add_user';
	post_arguments['data']=JSON.stringify(data);
	$.post(address,post_arguments,
		function reply_add6(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					var no=users6.length;
					users6.push($('#email_'+no).val());
					users_table6.row($('#email_'+no).parents('tr')).remove();
					users_table6.row.add([users6[no],
					`<button onclick='remove_user6(this.id)' class='btn btn-warning pull-right' id='removeuser_`+no+`'>Remove</button>`]);
					users_table6.draw();
					is_new_opened6=false;
				}
				else
				{

				}
			}
		})

}

function remove_user6(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var value=users6[no];
	current_remove=no;
	var data={};
	data['course']='all';
	data['email']=value;
	var post_arguments={};
	post_arguments['type']='access';
	post_arguments['request']='remove_users';
	post_arguments['data']=JSON.stringify(data);
	$.post(address,post_arguments,
		function reply_remove6(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					users6.splice(current_remove,1);
					users_table6.row($('#removeuser_'+current_remove).parents('tr')).remove();
					users_table6.draw();
				}
			}
		})
}
function message_user6(text)
{
	$('#info_user6').text(text);
}
