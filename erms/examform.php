<?php

namespace data;
require('utils/session.php');
require('utils/database.php');
require('utils/admit.php');
require('utils/student.php');
require('utils/reply.php');
require('utils/marks.php');
$session=utils\user\checkSession();
$files=upload_files();
if($files!=-1)
{
	$res=\data\utils\student\get_student($session[0]['email'],-1);
	if($res!=-1)
		$student=$res[0];	
	else
		return -1;
	$regularpapers=utils\admit\regular_papers($student['rollno']);
	$regular=[];
	for($i=0;$i<count($regularpapers);$i++)
	{
		array_push($regular,$regularpapers[$i]['subject']);
	}
	if(isset($_POST['elective']))
		$electives=$_POST['elective'];
	else
		$electives=[];
	if(isset($_POST['back']))
		$back=$_POST['back'];
	else
		$back=[];

	$final=utils\admit\add_record($files[0],$files[1],$student['rollno'],$regular,$electives,$back);
	if($final!=-1)
		echo(utils\reply('examform','success','exam_form'));
	else
		echo(utils\reply('examform','error','system_error'));
}
else if($files==-1)
	echo(utils\reply('upload','error','badphoto'));
else if($files==-2)
	echo(utils\reply('upload','error','badsign'));

function upload_files()
{
	if(!isset($_FILES["picToUpload"]))
		return -1;
	if(!isset($_FILES['sigToUpload']))
		return-2;
	if(!file_exists($_FILES["picToUpload"]["tmp_name"]))
		return -1;
	if(!file_exists($_FILES["sigToUpload"]["tmp_name"]))
		return -2;
	$target_dir_pic = "applicant_pics/";
	$target_dir_sig = "applicant_sigs/";
	$pic_name='p'.\bin2hex(\random_bytes(16));
	$sign_name='s'.\bin2hex(\random_bytes(16));
	$target_file_pic = $target_dir_pic . $pic_name;
	$target_file_sig = $target_dir_sig . $sign_name;
	$uploadOk = 1;
	$imageFileType_pic = pathinfo($_FILES["picToUpload"]["name"],PATHINFO_EXTENSION);
	$imageFileType_sig = pathinfo($_FILES["sigToUpload"]["name"],PATHINFO_EXTENSION);
	$target_file_pic=$target_file_pic.'.'.$imageFileType_pic;
	$target_file_sig=$target_file_sig.'.'.$imageFileType_sig;
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check_pic = getimagesize($_FILES["picToUpload"]["tmp_name"]);
		$check_sig = getimagesize($_FILES["sigToUpload"]["tmp_name"]);
		if($check_pic !== false or $check_sig !== false) {
			$uploadOk = 1;
		} else {
			return -1;
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file_pic) or file_exists($target_file_sig)) {
		echo "Sorry, file already exists.";
		return -1;
	}
	// Check file size
	if ( ($_FILES["picToUpload"]["size"] > 200000) or ($_FILES["sigToUpload"]["size"] > 200000) ) {
		echo "Sorry, your file is too large.";
		return -1;
	}
	// Allow certain file formats
	if( ($imageFileType_pic != "jpg" && $imageFileType_pic != "png" && $imageFileType_pic != "jpeg" && $imageFileType_pic != "gif" )
			or ($imageFileType_sig != "jpg" && $imageFileType_sig != "png" && $imageFileType_sig != "jpeg" && $imageFileType_sig != "gif" ) ){
		return -1;
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		return -1;
	// if everything is ok, try to upload file
	} else {
		if ( move_uploaded_file($_FILES["picToUpload"]["tmp_name"], $target_file_pic)
			and move_uploaded_file($_FILES["sigToUpload"]["tmp_name"], $target_file_sig) ) {
			return [$target_file_pic,$target_file_sig];
		} else {
			return -1;
		}
	}

}
	
?>