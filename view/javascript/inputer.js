init_tab1();
function init_tab1()
{
	$("#wtext").text("Welcome : "+user_id);
	load_courses1();
}
var subjects1=[];
var courses1=[];
function load_courses1()
{
	var post_arguments={};
	console.log('this');
	post_arguments['type']='access';
	post_arguments['request']='get_courses';
	$.post(address,post_arguments,
		function list_courses1(data,status)
		{	
			if(status=='success')
			{
				console.log(data);
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
				}
			}
		});
}

function select_submit1()
{
	selected_list_course1=$('#courses_list1').val();
	var post_arguments={};
	post_arguments['type']='lists';
	post_arguments['request']='get_subjects';
	post_arguments['value']=selected_list_course1;
	$.post(address,post_arguments,
		function list_subjects1(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					subjects1=datah['reply'];
					$('#subjects_list').empty();
					for(var i=0; i<subjects1.length;i++)
					{
						$('#subjects_list').append($('<option>', {
    						value: subjects1[i]['subject'],
    						text: subjects1[i]['subject']}));
					}
				}
			}
		});
}
function submit_marks()
{
	var rollno=$('#roll_no').val();
	var marks=$('#marks').val();
	var subject=$('#subjects_list').val()
	if($('#roll_no').val()=='' || $('#marks').val()=='' || $('#subjects_list').val()=='')
	{
		error_marks('Invalid Input');
	}
	else
	{
		temp_dict={};
		temp_dict['rollno']=rollno;
		temp_dict['marks']=marks;
		temp_dict['subject']=subject;
		temp_dict['type']=3;
		var post_arguments={};
		post_arguments['type']='marks';
		post_arguments['request']='add_marks_external';
		post_arguments['data']=JSON.stringify([temp_dict]);
		$.post(address,post_arguments,
			function marks_reply(data,status)
			{
				if(status=='success')
				{
					var datah=JSON.parse(data);
					if(datah['type']=='success')
					{
						error_marks("success");
						$('#marks').val('');
						$('#roll_no').val('');
					}
					else if(datah['type']=='message')
						error_marks(datah['reply']);
					else
						error_marks('Error Entering Marks, Please check values');
				}
				else
					error_marks('Network Problem');
			})
	}
}
function error_marks(text)
{
	$('#info_marks').text(text);
}