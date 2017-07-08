<?php
	$target_dir_pic = "applicant_pics/";
	$target_dir_sig = "applicant_sigs/";
	$target_file_pic = $target_dir_pic . basename($_FILES["picToUpload"]["name"]);
	$target_file_sig = $target_dir_sig . basename($_FILES["sigToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType_pic = pathinfo($target_file_pic,PATHINFO_EXTENSION);
	$imageFileType_sig = pathinfo($target_file_sig,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check_pic = getimagesize($_FILES["picToUpload"]["tmp_name"]);
		$check_sig = getimagesize($_FILES["sigToUpload"]["tmp_name"]);
		if($check_pic !== false or $check_sig !== false) {
			echo "File is an image - " . $check_pic["mime"] . ".";
			echo "File is an image - " . $check_sig["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file_pic) or file_exists($target_file_sig)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ( ($_FILES["picToUpload"]["size"] > 200000) or ($_FILES["sigToUpload"]["size"] > 200000) ) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if( ($imageFileType_pic != "jpg" && $imageFileType_pic != "png" && $imageFileType_pic != "jpeg" && $imageFileType_pic != "gif" )
			or ($imageFileType_sig != "jpg" && $imageFileType_sig != "png" && $imageFileType_sig != "jpeg" && $imageFileType_sig != "gif" ) ){
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if ( move_uploaded_file($_FILES["picToUpload"]["tmp_name"], $target_file_pic)
			and move_uploaded_file($_FILES["sigToUpload"]["tmp_name"], $target_file_sig) ) {
			echo "The files ". basename( $_FILES["picToUpload"]["name"]). " and ". basename( $_FILES["sigToUpload"]["name"]). " have been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
?>