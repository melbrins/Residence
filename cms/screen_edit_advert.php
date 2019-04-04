<?php

	//CHECK LOG AND PDO STATEMENT
	include 'static_block/checklog.php';
	include 'Slider/Block/Slider.php';

	$slider = new Slider();

    $slider_settings = $slider->getScreenSettings();

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<title>CMS Residence</title>

	<meta name="robots" content="noindex">

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery.tools.min.js"></script>
	<link href="css/cmstemplate.css" type="text/css" rel="stylesheet" media="screen"/>
	<link href="css/cms-ie.css" type="text/css" rel="stylesheet" media="screen"/>
	
</head>

<body>

<?php

	if(isset($_GET['page']) AND isset($_GET['reference'])){

		$currentpage = $_GET['page'];
		$ref = $_GET['reference'];

	}else{
		header("Location:admin.php?info=off");
	}

	try{

			$Property = $bdd->query("SELECT * FROM screen WHERE Reference='$ref'");
			$PropertyScreen = $bdd->query("SELECT * FROM screen");

		}

	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	$num_rows = $PropertyScreen->rowCount();
	$num_rows--;

?>

<div id="header">

	<div id="logo">
		<a href="../index.php">
			<img src="../images/logo_cms.png" alt="Logo Residence Estate" height="50px"/>
		</a>
	</div><!-- END : Logo -->

	<div id="company">
		<h1><span style="color:#552F01">RESIDENCE</span> <span style="color:#EF7F00">ESTATES</span></h1>
	</div><!-- END : company -->

</div><!-- END : Header -->

<div id="navigation">
	
	<?php include 'static_block/admin_menu.php'; ?>

</div><!-- END : Navigation -->

<?php

	while ($donnees = $Property->fetch())
		{

?>

	<div class="page">

		<h2>Screen - <?php echo $donnees['Street']; ?></h2>

		<?php include '../static_block/message.php'; ?>

		<div class="property_overview  push">
			
			<form method="post" action="script/screen/edit_screen_advert.php" enctype="multipart/form-data">

			<!-- <div class="title_categorie"><h4>Overview</h4></div> -->

			<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
			<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
			<input type="hidden" name="Num_rows" value="<?php echo $num_rows; ?>"/>

			<div class="picture_property float">

				<img src="../slider/images/thumbs/<?php echo $donnees['Picture'];?>" alt="Screen <?php echo $donnees['Reference'];?>"/>
				
				<div class="res2-row btn_upload">
					<input class="image-file" type="file" name="Image"/>
				</div>

                <div class="res2-row">
                    <label for="screen-speed">Screen Speed</label>
                    <input name="Speed" id="screen-speed" value="<?php echo ($donnees['Speed']) ? $donnees['Speed'] : '' ?>" placeholder="<?php echo($slider_settings['speed']) ? $slider_settings['speed'] : ''?>" type="number" />
                </div>

                <div class="res2-row">
                    <label for="screen-speed">Screen Transition</label>
                    <select name="Transition" id="slide-transition">
                        <option value="">Random</option>
                        <?php for ($i=1; $i <= 61; $i++){ ?>
                            <option <?php echo($donnees['Transition'] == 'tr'.$i) ? 'selected' : ''; ?> value="tr<?php echo $i; ?>">tr<?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <a class="btn secondary" href="<?php echo ($donnees['Transition']) ? 'http://'.$_SERVER['SERVER_NAME'].'/slider/preview.php?Transition='.$donnees['Transition']: 'http://'.$_SERVER['SERVER_NAME'].'/slider/preview.php' ;?>" target="_blank">Preview</a>

				<div class="delete_box">
					<input type="checkbox" name="delete" id="delete"/>
					<label for="delete">Delete</label>
				</div>

			</div><!-- END : picture_property -->

			<div class="float">

				<div class="res2-row-head">
					<span class="res2-row-title">Change Advert Details</span><br>
				</div>

				<div class="res2-row">

					<label for="Street">Advertising Title <span>*</span></label>
					<span class="text-holder"><input required="required" class="input" type="text" name="Street" value="<?php echo stripslashes($donnees['Street']);?>"></span>

				</div>

				<!-- <div class="res2-row">

					<label for="Repeat">Repeat advert every </label>
					<span class="text-holder">
						<select name="Repeat" size="1">
			
							<option value="" <?php if($donnees['Repeatable'] == ''){echo('selected');}?>>Don't repeat</option>
							<option value="5" <?php if($donnees['Repeatable'] == '5'){echo('selected');}?>>5</option>
							<option value="10" <?php if($donnees['Repeatable'] == '10'){echo('selected');}?>>10</option>
							<option value="15" <?php if($donnees['Repeatable'] == '15'){echo('selected');}?>>15</option>
							<option value="20" <?php if($donnees['Repeatable'] == '20'){echo('selected');}?>>20</option>
				
						</select>
					</span>

				</div> -->

				<div class="res2-btn right clear">
					<button class="btn" type="submit">
						
						<span>Save</span>

					</button>
				</div>

			</div>

			<div class="clear"></div>

			</form>

		</div><!-- END : property_overview -->

	</div><!-- END : page -->

	<?php

            if(isset($donnees['Statut']) && $donnees['Statut'] == 'Archive'){
				$currentpage = 'archive';
			}
	?>
			<style type="text/css">
				#<?php echo $currentpage; ?> a, #<?php echo $currentpage; ?> a:link { color:#FFF;}
			</style>

	<?php

		}
		//We stop the current cursor.
		$Property->closeCursor();
	?>

	<!-- Change page in fonction of the url -->
	<script type="text/javascript">
		var page = '<?php echo $currentpage; ?>'; 
		$(document).ready(function(){
				$('.menu').removeClass('active');
				$('#'+ page).addClass('active');	
		});

        $('.image-file').bind('change', function() {

            $(this).parent().children('.message').remove();

            var image_size = this.files[0].size/1024/1024;

            if (image_size > 2) {
                $(this).parent().prepend('<div class="message" style="height: 80px;"><p>Image Size: ' + Math.round(image_size) + 'MB</br>Image needs to be under 2MB</p></div>');
            }
        });
	</script>

	<script type="text/javascript" src="js/cms_script.js"></script>

</body>
</html>