function abc()
{
	$.post("http://localhost/ERMS-Engine/view/yah.php",
	{
		abc:'as'
	},
	function(data,status)
	{
		$(data).appendTo("body");
	});
	
}