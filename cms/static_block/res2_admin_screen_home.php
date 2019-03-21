<h2>Shop Screen</h2>

<?php
	include '../static_block/message.php';
?>

<div class="slider-settings">
    <div class="ajax-message">
    </div>
    <button id="refresh-images" class="btn">Refresh Images</button>
    <button id="resize-images" class="btn">Resize Images</button>
</div>

<div id="content_nutrition" class="categorie services">

	<div class="content_categorie nutrition">

		<a href="screen_add.php?page=screen" class="new_article"><img src="../images/new_property.png"></a>

		<form method="post" action="../cms/script/screen/screen_property.php" enctype="multipart/form-data">

			<table>

				<tbody>


				<?php

					$boolean=true;
					$num_rows = $PropertyScreen->rowCount();
					$num_rows--;

					//On lance la boucle pour créer toutes les images.
					while ($donnees = $PropertyScreen->fetch())
						{

							if($donnees['Advertising'] == 'true'){
					?>
								<tr class="orange">
									<?php include 'res2_row_screen_advert.php' ?>	
								</tr>
					<?php

							}else if($boolean == true){
					?>
								<tr>
									<?php include 'res2_row_screen.php' ?>	
								</tr>
					
					<?php
					
								$boolean=false;
					
							}else{
							
						?>
						
								<tr class="grey">
									<?php include 'res2_row_screen.php'; ?>	
								</tr>
						
						<?php 
					
								$boolean=true;
					
							}
						}

						//On arrete la lecture de la table.
						$PropertyScreen->closeCursor();

					?>


				</tbody>

			</table>

			<div class="res2-btn">

				<button class="btn" type="submit">
					
					<span>Save</span>

				</button>

			</div>

		</form>
	
	</div>

</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#refresh-images').click(function () {

            $.ajax({
                type: 'get',
                url: 'Slider/Proxy/Proxy.php',
                data: '?ajax=1&function2call=refresh-images',
                success: function (e) {

                    var html = '<div class="message message-success"><p>' + e + ' images have been deleted</p></div>';

                    $('.ajax-message').empty();
                    $('.ajax-message').show(400).append(html);

                    setTimeout(function(){
                        $('.ajax-message').hide(400);
                    }, 2000);

                },
                complete: function (e) {
                    console.log('completed');
                    console.log(e);
                },
                error: function (e) {
                    console.log('error');
                    console.log(e);
                }
            });

        });

        $('#resize-images').click(function () {

            $.ajax({
                type: 'get',
                url: 'Slider/Proxy/Proxy.php',
                data: '?ajax=1&function2call=resize-images',
                success: function (e) {

                    var html = '<div class="message message-success"><p>' + e + ' images have been resized.</p></div>';

                    $('.ajax-message').empty();
                    $('.ajax-message').show(400).append(html);

                    setTimeout(function(){
                        $('.ajax-message').hide(400);
                    }, 2000);

                },
                complete: function (e) {
                    console.log('completed');
                    console.log(e);
                },
                error: function (e) {
                    console.log('error');
                    console.log(e);
                }
            });

        });
    });
</script>