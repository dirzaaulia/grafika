<!DOCTYPE html>
<html>
<head>
	<title>Grafika</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<!-- Brand/logo -->
	  	<a class="navbar-brand" href="index.php">Image Processing</a>
	</nav>
	<div class="container" style="margin-top: 2%;">
  		<form action="" method="POST" enctype="multipart/form-data">
    		<div class="form-group">
      			<label for="fileGambar">Silahkan pilih file gambar yang ingin diproses</label>
    			<input type="file" class="form-control-file" id="fileGambar" name="fileGambar" required="true">
    		</div>
    		<button type="submit" class="btn btn-primary" name="buttonSubmit">Submit</button>
  		</form>
	</div>
	<?php 

		// include composer autoload
		require 'vendor/autoload.php';

		// import the Intervention Image Manager Class
		use Intervention\Image\ImageManagerStatic as Image;

		// configure with favored image driver (gd by default)
		Image::configure(array('driver' => 'gd'));

		// Check if image file is a actual image or fake image
		if (isset($_POST['buttonSubmit'])) {

			$target_dir = "gambar/";
			$target_file = $target_dir . basename($_FILES["fileGambar"]["name"]);
			$uploadOk = 1;
			$filename=$_FILES['fileGambar']['name'];
		    $check = getimagesize($_FILES["fileGambar"]["tmp_name"]);
		    if($check !== false) {

		        $filename="gambar/".$filename;
		        $uploadOk = 1;
		        $moveUpload=move_uploaded_file($_FILES["fileGambar"]["tmp_name"], $target_file);
				// and you are ready to go ...
				$image = Image::make($filename)->resize(250,250)->save('bar0.jpg');
				$image = Image::make('bar0.jpg')->greyscale()->save('bar1.jpg');
				$image = Image::make('bar0.jpg')->brightness(50)->save('bar2.jpg');
				$image = Image::make('bar0.jpg')->contrast(50)->save('bar3.jpg');
				$image = Image::make('bar0.jpg')->invert()->save('bar4.jpg');
				$image = Image::make('bar0.jpg')->blur(15)->save('bar5.jpg');

				echo "

					<table class='table' style='margin-top: 2%'>
					  	<thead>
					    	<tr>
						      <th>Original</th>
						      <th>Greyscale</th>
						      <th>Brightness +50</th>
					    	</tr>
					  	</thead>
					  	<tbody>
					    	<tr>
					      		<td><img src='bar0.jpg'></td>
					      		<td><img src='bar1.jpg'></td>
					      		<td><img src='bar2.jpg'></td>
					    	</tr>
					    	<tr>
					    		<th>Contrast +50</th>
						      	<th>Invert</th>
						      	<th>Blur</th>
					    	</tr>
					    		<td><img src='bar3.jpg'></td>
					      		<td><img src='bar4.jpg'></td>
					      		<td><img src='bar5.jpg'></td>
					    	<tr>

					    	</tr>
					  	</tbody>
					</table>

				";

		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}

		
	 ?>
</body>
</html>