
function checkstatus()
{
	var marks=[["CC231","CS","2015",'Y','N','Y'],["CC231","CS","2015",'Y','N','Y']];
	console.log(marks);
}
var submitFlag=0;
function submit1()
{

	if(submitFlag==0)
	{
		var rollno=[11234,11237,11534];
		var scores1=[];
		var temp;
		$(".entry1").css('opacity','0');
		for (var i=0; i<rollno.length;i++)
		{
			temp=$('#i1_'+rollno[i].toString()).val();
			scores1.push(temp);
			$("<input id='i2_"+rollno[i].toString()+"' type='text'>").appendTo('#e2_'+rollno[i].toString())
		}
		submitFlag=submitFlag+1;
	}
	else if(submitFlag==1)
	{
		var scores1=[];
		$(".entry1").css('opacity','100');
		for (var i=0; i<rollno.length;i++)
		{
			scores1.push($('#i1_'+rollno[i].toString()).val());
			$("<input id='i2_"+rollno[i].toString()+"' type='text'>").appendTo('#e2_'+rollno[i].toString())
		}
		submitFlag=submitFlag+1;

	}
	
}
