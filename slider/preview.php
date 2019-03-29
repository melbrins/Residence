<!-- PDO -->					
<?php

    include '../static_block/bdd.php';
    include '../cms/Slider/Block/Slider.php';

    $slider = new Slider();

    $slider_settings = $slider->getScreenSettings();

    $slider_style = $slider_settings['style'];
    $slider_speed = $slider_settings['speed'];
    $slider_layout = $slider_settings['layout'];

    $transitions = $slider->getAllScreenTransitions();

	try
	{

		$Advert = $bdd->query("SELECT * FROM screen WHERE Advertising = 'true' ORDER BY Ordre");
		$Screen = $bdd->query('SELECT * FROM screen ORDER BY Ordre');
		$Screen_banner = $bdd->query('SELECT * FROM screen ORDER BY Ordre');

	}

	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Residence Estates - Property Showcase</title>

		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
		
		<link rel="stylesheet" href="style/main.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
		<link rel="stylesheet" href="style/slider-style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
		<link rel="stylesheet" href="style/slider.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
		
		<script src="js/modernizr.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/cute/cute.slider.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/cute/cute.transitions.all.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/main.js" type="text/javascript" charset="utf-8"></script>
		
	</head>
	<body>

	<div id="start-box">
		<span id="start">Start</span>
	</div>

    <div style="position: absolute; top:0; left: 0; width:100vw; height: 60px; z-index:999999999; background-color:rgba(255,255,255, 0.8);">
        <form onsubmit="#">

            <select name="Transition" id="slide-transition">
                <option value="">Random</option>
                <?php if (isset($_GET['Transition'])) { ?>

                    <?php for ($i=1; $i <= 61; $i++){ ?>
                        <option <?php echo($_GET['Transition'] == 'tr'.$i) ? 'selected' : ''; ?> value="tr<?php echo $i; ?>">tr<?php echo $i; ?></option>
                    <?php } ?>

                <?php } else { ?>

                    <?php for ($i=1; $i <= 61; $i++){ ?>
                        <option value="tr<?php echo $i; ?>">tr<?php echo $i; ?></option>
                    <?php } ?>

                <?php } ?>
            </select>

            <?php $style = (isset($_GET['style'])) ? $_GET['style'] : $slider_style; ?>

            <select name="style" id="select-style">
                <option <?php echo ($style === '2d') ? 'selected' : ''; ?> value="2d">2D</option>
                <option <?php echo ($style === '3d') ? 'selected' : ''; ?> value="3d">3D</option>
            </select>

            <input name="speed" id="input-speed" value="<?php echo (isset($_GET['speed'])) ? $_GET['speed'] : $slider_speed; ?>" type="number" />

            <button type="submit">Submit</button>
        </form>
    </div>
	<div id="box" class="hide">

			<ul id="slide-banner">

				<?php

					while ($donnees = $Screen_banner->fetch())
						{

							// NOT DISPLAY THE ADVERT IN THE SLIDER
							if($donnees['Advertising'] != 'true'){
				?>

						<li class="<?php echo $donnees['Category'];?>"></li>

				<?php
							}else{
                ?>
                                <li></li>
                <?php
                            }

						}
						$Screen_banner->closeCursor();

				?>
			</ul>

		<div id="wrapper" class="wrapper <?php echo ($slider_layout) ? $slider_layout : ''; ?>">

			<div id="slider" class="cute-slider" data-width="<?php echo ($slider_layout === 'col-1') ? '1920' : '1420'; ?>" data-height="950" data-force="<?php echo ($_GET['style']) ? $_GET['style'] : $slider_style; ?>">
				<ul data-type="slides">

				<?php

					while ($donnees = $Screen->fetch())
						{

							// NOT DISPLAY THE ADVERT IN THE SLIDER
							if($donnees['Advertising'] != 'true'){

                                $title = $slider->getScreenTitlePerId($donnees['ID']);


				?>

						<li class="slide-item" data-delay="<?php echo (isset($_GET['speed'])) ? $_GET['speed'] : $slider_speed; ?>" data-trans3d="<?php echo ($_GET['Transition']) ? $_GET['Transition'] : $transitions; ?>" data-trans2d="<?php echo ($_GET['Transition']) ? $_GET['Transition'] : $transitions; ?>">
							<img src="images/<?php echo $donnees['Picture']?>" data-src="images/<?php echo $donnees['Picture']?>" data-thumb="images/thumbs/<?php echo $donnees['Picture']?>" style="max-height:950px; max-width:1420px;"/>
							<div data-type="info" class="info1" data-align="right">
								<div>
									<p class="title"><?php echo $title; ?></p>
									<p class="price">&pound;<?php echo number_format($donnees['Price']); ?> <?php echo $donnees['PricePer']; ?></p>
								</div>
							</div>
						</li> 

				<?php
							}else{
				?>

						<li class="slide-item" data-delay="<?php echo (isset($_GET['speed'])) ? $_GET['speed'] : $slider_speed; ?>" data-trans3d="<?php echo ($_GET['Transition']) ? $_GET['Transition'] : $transitions; ?>" data-trans2d="<?php echo ($_GET['Transition']) ? $_GET['Transition'] : $transitions; ?>">
							<img src="images/<?php echo $donnees['Picture']?>" data-src="images/<?php echo $donnees['Picture']?>" data-thumb="images/thumbs/<?php echo $donnees['Picture']?>" style="max-height:950px; max-width:1420px;"/>
						</li>

				<?php
							}

						}
						$Screen->closeCursor();

				?>
						
					</ul>

					<ul data-type="controls" style="z-index:999999999;">			
						<li data-type="slideinfo" data-effect="fade"> </li>

                        <?php if ($slider_layout === 'col-2'){ ?>
                            <li data-type="thumblist" data-dir="vertical" data-autohide="true"> </li>
                        <?php } ?>

						
						<!-- <li data-type="circletimer" data-color="#333333" data-stroke="13"> </li>
						<li data-type="next"> </li>
						<li data-type="previous"> </li>
						<li data-type="slidecontrol" data-thumbalign="up"> </li> -->	
						
					</ul>
				</div>
				
			</div>

		</div>	
	</body>
</html>
