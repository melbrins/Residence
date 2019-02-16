<!-- 
<a href="/index.php">© Residence 2013</a>
<a href="http://www.psdukltd.com/" target="_blank">Powered by PSD UK ltd</a>
<a href="#">Site map</a> 
<a href="cms/login.php" target="_blank">Administration</a>
-->
<?php

try
{
						
	//We took all the information from information table on database
	$Info = $bdd->query('SELECT * FROM information');

	//We launch the while to print all information through the HTML
	while ($donnees = $Info->fetch())
	{

?>

			<div id="menu-bottom">
				
				<p class="phone">
					<span class="ico-phone"></span>
					<?php echo $donnees['Phone']; ?>
				</p>
				
				<p class="opening-times">
					Mon - Fri from 8am to 8pm
				</p>

				<ul id="socialmedia">

					<?php 

						if($donnees['Facebook'] != null){

					?>

						<li>
							<a class="facebook" href="<?php echo $donnees['Facebook']; ?>"></a>
						</li>

					<?php

						}

						if($donnees['Twitter'] != null){
					?>

					<li>
						<a class="twitter" href="<?php echo $donnees['Twitter']; ?>"></a>
					</li>

					<?php

						}

						if($donnees['Google'] != null){
					?>

					<li>
						<a class="gplus" href="<?php echo $donnees['Google']; ?>"></a>
					</li>

					<?php

						}

						if($donnees['Pinterest'] != null){
					?>

					<li>
						<a class="pinterest" href="<?php echo $donnees['Pinterest']; ?>"></a>
					</li>

					<?php

						}
					?>

				</ul>
			</div>

<?php
	
	}

	//We close the PHP reader
	$Info->closeCursor();
}

//We catch the error if it doesn't work.
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

?>
