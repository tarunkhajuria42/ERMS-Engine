
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