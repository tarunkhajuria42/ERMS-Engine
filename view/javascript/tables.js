var subjectdata=[["CC231","CS","2015","Y","N","Y"],["CC231","CS","2015","Y","N","Y"]];
var marks=[["231","Tarun","11"],[234,"tarri",21]];
function fetch_subjectdata()
{
	$.post("http://localhost/ERMS-Engine/erms/index.php",
		{
			type:"marks",
			request:"classes",
		}, function (data,status)
		{
			var res=json.parse(data);
			if (res['type']=='success')
			{
				subjectdata=res['data'];
				fill_subjects();
			}
		});
}
function sub_click(id)
{
	var paper= id.substring(0, id.indexOf("_"));
	var no=id.substring(id.indexOf("_")+1,id.length);
	fetch_marks(subjectdata[no][0],subjectdata[no][1],subjectdata[no][2],paper);
}
function fetch_marks(subject,course,batch,exam_type)
{
	$.post("http://localhost/ERMS-Engine/erms/index.php",
		{
			type:"marks",
			request:"classes"
			
		}, function (data,status)
		{
			var res=json.parse(data);
			if (res['type']=='success')
			{
				subjectdata=res['data'];
				fill_subjects();
			}
		});

}

function fill_subjects()
{
	sub_click("abc_21");
	$("#table2").DataTable();
	fill_marks();
	var entry;
	for (var i=0; i<subjectdata.length; i++)
	{
		entry=`<tr id=subject_`+i+`>
           <td id='subid_`+i+`'>`+subjectdata[i][0]+`</td>
            <td id='course_`+i+`'>`+subjectdata[i][1]+`</td>
                <td id='batch_`+i+`'>`+subjectdata[i][2]+`</td>
                <td id=it_`+i+`'>`+subjectdata[i][3]+`</td>
                <td id=ip_`+i+`'>`+subjectdata[i][4]+`</td>
                <td id=ep_`+i+`'>`+subjectdata[i][5]+`</td>
             </tr>`;
        $(entry).appendTo("#subjects_admin");	
	}
}

function fill_marks()
{	
	var entry;
	for (var i=0; i<marks.length; i++)
	{
		entry=`<tr id=marks_`+i+`>
           <td id='roll_`+i+`'>`+marks[i][0]+`</td>
            <td id='name_`+i+`'>`+marks[i][1]+`</td>
                <td id='e1_`+i+`' class='entry1'><input id='i1_`+i+`' value='`+marks[i][2]+`'type='text'></td>
                <td id='e2_`+i+`' class='entry2'></td>
             </tr>`;
        $(entry).appendTo("#marks_table");
	}
}

var submitFlag=0;
function submit()
{
	if(submitFlag==0)
	{
		var scores1=[];
		var temp;
		$(".entry1").css('opacity','0');
		for (var i=0; i<rollno.length;i++)
		{
			temp=$('#i1_'+rollno[i].toString()).val();
			scores1.push(temp);
			$("<input id='i2_"+rollno[i].toString()+"' type='text'>").appendTo('#e2_'+rollno[i].toString());
		}
		submitFlag=submitFlag+1;
	}
	else if(submitFlag==1)
	{
		var scores2=[];
		$(".entry1").css('opacity','100');
		for (var i=0; i<rollno.length;i++)
		{
			scores1.push($('#i1_'+rollno[i].toString()).val());
			$("<input id='i2_"+rollno[i].toString()+"' type='text'>").appendTo('#e2_'+rollno[i].toString());
		}
		submitFlag=submitFlag+1;
	}
	
}

