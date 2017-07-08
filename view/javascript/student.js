init();
var student_table1;
var file_address='http://localhost/ERMS-Engine/erms/examform.php';
function init()
{
	init_tab1();
}

function init_tab1()
{
	student_table1=$('#student_table1').DataTable();
	get_contents();
	$('#main_form').ajaxForm({url:'http://localhost/ERMS-Engine/erms/examform.php',type:'post',
		success:function(data)
				{
					console.log(data);
					datah=JSON.parse(data);
					if(datah['type']=='success')
					{
						$('#message').text("Success");
					}
					else if(datah['reply']=='badphoto')
						$('#message').text("Bad Photo");
					else if(datah['reply']=='badsign')
						$('#message').text("Bad Signature");
					else 
						$('#message').text("System Error");
				}
});
}
function get_contents()
{
	var post_arguments={};
	post_arguments['type']='student';
	post_arguments['request']='screen_status';
	$.post(address,post_arguments,
		function put_content(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					student_table1.clear();
					marksheet=datah['reply'];
					for(var i=0; i<marksheet.length; i++)
					{
						var string=prepare_marksheet_string(marksheet[i]['marks_sheet'],i);
						student_table1.row.add([
							marksheet[i]['semester'],
							string]);
					}
					student_table1.draw();

				}
			}
		});
}
function prepare_marksheet_string(logic,index)
{
	var string;
	if(logic==1)
		string="<button id='marksheet_"+index+"' class='btn pull-right btn-info' onclick='generate_marksheet(this.id)'>Marksheet</button>";
	else if(logic==2)
		string="<button id='admitcard_"+index+"' class='btn pull-right btn-info' onclick='generate_admit_card(this.id)'>Admit Card</button>"
	else if(logic==3)
		string="<button id='examform_"+index+"' class='btn pull-right btn-info' data-toggle='modal' data-target='#exam_form' onclick='generate_exam_form(this.id)'>Exam Form</button>"
	else if(logic==4)
		string='Exam Form Submitted';
	else
		string='-';
	return string;
}

function generate_marksheet(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);
	var post_arguments={};
	post_arguments['type']='marks';
	post_arguments['request']='generate_marksheet';
	post_arguments['value']=no+1;
	$.post(address,post_arguments,
		function marksheet(data,status)
		{
			if(status=='success')
			{
				datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					
				}
			}
		})
}


function generate_admit_card(id)
{
	var no=id.substring(id.indexOf('_')+1,id.length);

}
function generate_exam_form(id)
{
	$('#message').text("");
	var post_arguments={};
	var no=id.substring(id.indexOf('_')+1,id.length);	
		 post_arguments['type']='student';
		 post_arguments['request']='exam_form';
		 post_arguments['value']=no+1;
	$.post(address,post_arguments,
		function examform(data,status)
		{
			if(status=='success')
			{
				console.log(data);
				var datah=JSON.parse(data);
				if(datah['type']=='success')
				{
					var form_data=datah['reply'];
					var regular=form_data['regular'];
					var electives=form_data['electives'];
					var back=form_data['back'];
					$('#regular').empty();
					$('#elective').empty();
					$('#back').empty();
					for(var i=0; i<regular.length;i++)
					{
						$("<p>"+regular[i]['subject_code']+"-  "+regular[i]['subject']+"</p>").appendTo('#regular');
					}
					for(var i=0; i<electives.length;i++)
					{
						$("<input type='checkbox' name='elective[]' value='"+electives[i]['subject']+"' >  "+electives[i]['subject_code']+"-  "+electives[i]['subject']+"<br>").appendTo('#elective');
					}
					for(var i=0; i<back.length;i++)
					{
						$("<input type='checkbox' name='back[]' value='"+back[i]['subject']+"' >  "+back[i]['subject_code']+"-  "+back[i]['subject']+"<br>").appendTo('#back');
					}
				}
			}
		})

}
function post_final(action, method, input) {
    'use strict';
    var form;
    form = $('<form />', {
        action: action,
        method: method,
        style: 'display: none;'
    });
    if (typeof input !== 'undefined' && input !== null) {
        $.each(input, function (name, value) {
            $('<input />', {
                type: 'hidden',
                name: name,
                value: value
            }).appendTo(form);
        });
    }
    form.appendTo('body').submit();
}