<h2>Property - <?php if($donnees['Page'] != 'commercial' OR $donnees['Page'] != 'short'){ ?>To <?php } echo $donnees['Page']; ?> - "<?php echo $donnees['Street']; ?>, <?php echo $donnees['Area']; ?>, <?php echo $donnees['Postcode']; ?>"</h2>
		<h3>You can modify the property details and at the end click on SAVE.</h3>
		

		<div id="edit_<?php echo($donnees['Page']);?>_overview_<?php echo $donnees['Reference']; ?>" class="property_overview  push">
			<div class="title_categorie"><h4>Property Overview</h4></div>
			<form method="post" action="edit_overview.php" enctype="multipart/form-data">
			<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
			<input type="hidden" name="Page" value="<?php echo $donnees['Page']; ?>"/>
			<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
			<?php 
				$currentpage = $donnees['Page'];
				$ref = $donnees['Reference'];
			?>
			<div class="menu_property">
				<ul>
					<li style="float:left;"><a href="admin.php?page=<?php echo($donnees['Page']); ?>&ed=overview&reference=<?php echo($donnees['Reference']); ?>">Overview</a></li>
					<li style="float:left;"><a href="admin.php?page=<?php echo($donnees['Page']); ?>&ed=details&reference=<?php echo($donnees['Reference']); ?>">Details</a></li>
					<li style="float:left;"><a href="admin.php?page=<?php echo($donnees['Page']); ?>&ed=room&reference=<?php echo($donnees['Reference']); ?>">Room</a></li>
					<li style="float:left;"><a href="admin.php?page=<?php echo($donnees['Page']); ?>&ed=pictures&reference=<?php echo($donnees['Reference']); ?>">Pictures</a></li>
					<li>
						<label for="Caption" style="margin-right:10px; margin-left:20px; font-size:12px; font-weight:bold; color:#FFF;">Caption Position</label>
						<select name="Caption" size="1">
							<option value="left-bottom">left-bottom</option>
							<option value="left-top">left-top</option>
							<option value="right-bottom">right-bottom</option>
							<option value="right-top">right-top</option>
						</select>
					</li>
					<?php 
						if(isset($_GET['ed']) AND $_GET['ed'] == 'overview'){
					?>
					<li>
						<label for="Home" style="font-size:12px; font-weight:bold; color:#FFF;">Home?</label><input type="checkbox" name="Home" id="select" <?php if($donnees['Home'] == 'true'){echo('checked="checked"');}?>/>
					</li>
					<li>
						<a href="admin.php?page=<?php echo $currentpage; ?>" style="font-size:12px; font-weight:bold; color:#FFF; text-decoration:none; margin-right:20px;">Back to list</a>
					</li>
					<?php } ?>
					<li style="clear:both;">
					</li>
				</ul>
			</div>
			<div class="picture_property ">
				<div class="content_categorie">
					<img src="/images/<?php echo stripslashes(nl2br($donnees['Small_picture']));?>" alt="images property" width="380px"/>
					<div class="btn_upload"><input type="file" name="Image"/></div>
				</div>
			</div>
				<ul class="details">
					<li class="float">
						<div class="label"><label for="Street">Street</label></div>
						<div class="bg_input pro"><input type="text" name="Street" value="<?php echo stripslashes(nl2br($donnees['Street']));?>" size="24"/></div>
					</li>
					<li class="float">
						<div class="label"><label for="Postcode">Postcode</label></div>
						<div class="bg_input pro"><input type="text" name="Postcode" value="<?php echo stripslashes(nl2br($donnees['Postcode']));?>" size="24"/></div>
					</li>
					<li class="float">
						<div class="label" style="margin-bottom:5px; display:inline-block; width:30px;"><label for="Area">Area</label></div>
						<div class="select_button">
							<select name="Area" size="1" style="height:28px;">
								<optgroup label="Central London">
									<option value="Bayswater" <?php if($donnees['Area'] == 'Bayswater'){echo('selected');}?>>Bayswater</option>
									<option value="Belgravia" <?php if($donnees['Area'] == 'Belgravia'){echo('selected');}?>>Belgravia</option>
									<option value="Bloomsbury" <?php if($donnees['Area'] == 'Bloomsbury'){echo('selected');}?>>Bloomsbury</option>
									<option value="Clerkenwell" <?php if($donnees['Area'] == 'Clerkenwell'){echo('selected');}?>>Clerkenwell</option>
									<option value="The City" <?php if($donnees['Area'] == 'The City'){echo('selected');}?>>The City</option>
									<option value="Holborn" <?php if($donnees['Area'] == 'Holborn'){echo('selected');}?>>Holborn</option>
									<option value="Mayfair" <?php if($donnees['Area'] == 'Mayfair'){echo('selected');}?>>Mayfair</option>
									<option value="Paddington" <?php if($donnees['Area'] == 'Paddington'){echo('selected');}?>>Paddington</option>
									<option value="Pimlico" <?php if($donnees['Area'] == 'Pimlico'){echo('selected');}?>>Pimlico</option>
									<option value="Soho" <?php if($donnees['Area'] == 'Soho'){echo('selected');}?>>Soho</option>
									<option value="St. James's" <?php if($donnees['Area'] == "St. James's"){echo('selected');}?>>St. James's</option>
									<option value="St. John's Wood" <?php if($donnees['Area'] == "St. John's Wood"){echo('selected');}?>>St. John's Wood</option>
									<option value="Trafalgar Square" <?php if($donnees['Area'] == 'Trafalgar Square'){echo('selected');}?>>Trafalgar Square</option>
									<option value="The West End" <?php if($donnees['Area'] == 'The West End'){echo('selected');}?>>The West End</option>
									<option value="Westminster"<?php if($donnees['Area'] == 'Westminster'){echo('selected');}?>>Westminster</option>
									<option value="Whitehall" <?php if($donnees['Area'] == 'Whitehall'){echo('selected');}?>>Whitehall</option>
								</optgroup>

								<optgroup label="North London">
									<option value="Camden" <?php if($donnees['Area'] == 'Camden'){echo('selected');}?>>Camden</option>
									<option value="Euston" <?php if($donnees['Area'] == 'Euston'){echo('selected');}?>>Euston</option>
									<option value="Hampstead" <?php if($donnees['Area'] == 'Hampstead'){echo('selected');}?>>Hampstead</option>
									<option value="Highgate" <?php if($donnees['Area'] == 'Highgate'){echo('selected');}?>>Highgate</option>
									<option value="Kentish Town" <?php if($donnees['Area'] == 'Kentish Town'){echo('selected');}?>>Kentish Town</option>
									<option value="Kings Cross" <?php if($donnees['Area'] == 'Kings Cross'){echo('selected');}?>>Kings Cross</option>
									<option value="Islington" <?php if($donnees['Area'] == 'Islington'){echo('selected');}?>>Islington</option>
									<option value="Stoke Newington" <?php if($donnees['Area'] == 'Stoke Newington'){echo('selected');}?>>Stoke Newington</option>
									<option value="St. Pancras" <?php if($donnees['Area'] == 'St. Pancras'){echo('selected');}?>>St. Pancras</option>
									<option value="Wembley" <?php if($donnees['Area'] == 'Wembley'){echo('selected');}?>>Wembley</option>
								</optgroup>

								<optgroup label="South London">
									<option value="Brixton" <?php if($donnees['Area'] == 'Brixton'){echo('selected');}?>>Brixton</option>
									<option value="Dulwich" <?php if($donnees['Area'] == 'Dulwich'){echo('selected');}?>>Dulwich</option>
									<option value="Forest Hill" <?php if($donnees['Area'] == 'Forest Hill'){echo('selected');}?>>Forest Hill</option>
									<option value="Greenwich" <?php if($donnees['Area'] == 'Greenwich'){echo('selected');}?>>Greenwich</option>
									<option value="Lambeth" <?php if($donnees['Area'] == 'Lambeth'){echo('selected');}?>>Lambeth</option>
									<option value="The South Bank" <?php if($donnees['Area'] == 'The South Bank'){echo('selected');}?>>The South Bank</option>
									<option value="Southwark" <?php if($donnees['Area'] == 'Southwark'){echo('selected');}?>>Southwark</option>
									<option value="Wandsworth" <?php if($donnees['Area'] == 'Wandsworth'){echo('selected');}?>>Wandsworth</option>
									<option value="Wimbledon" <?php if($donnees['Area'] == 'Wimbledon'){echo('selected');}?>>Wimbledon</option>
								</optgroup>

								<optgroup label="West London">
									<option value="Brentford" <?php if($donnees['Area'] == 'Brentford'){echo('selected');}?>>Brentford</option>
									<option value="Chiswick" <?php if($donnees['Area'] == 'Chiswick'){echo('selected');}?>>Chiswick</option>
									<option value="Ealing" <?php if($donnees['Area'] == 'Ealing'){echo('selected');}?>>Ealing</option>
									<option value="Fulham" <?php if($donnees['Area'] == 'Fulham'){echo('selected');}?>>Fulham</option>
									<option value="Hammersmith" <?php if($donnees['Area'] == 'Hammersmith'){echo('selected');}?>>Hammersmith</option>
									<option value="Hampton" <?php if($donnees['Area'] == 'Hampton'){echo('selected');}?>>Hampton</option>
									<option value="Isleworth" <?php if($donnees['Area'] == 'Isleworth'){echo('selected');}?>>Isleworth</option>
									<option value="Kew" <?php if($donnees['Area'] == 'Kew'){echo('selected');}?>>Kew</option>
									<option value="Richmond" <?php if($donnees['Area'] == 'Richmond'){echo('selected');}?>>Richmond</option>
									<option value="Twickenham" <?php if($donnees['Area'] == 'Twickenham'){echo('selected');}?>>Twickenham</option>
								</optgroup>

								<optgroup label="East London">
									<option value="Docklands" <?php if($donnees['Area'] == 'Docklands'){echo('selected');}?>>Docklands</option>
									<option value="Bethnal Green" <?php if($donnees['Area'] == 'Bethnal Green'){echo('selected');}?>>Bethnal Green</option>
									<option value="Shoreditch" <?php if($donnees['Area'] == 'Shoreditch'){echo('selected');}?>>Shoreditch</option>
									<option value="Spitalfields" <?php if($donnees['Area'] == 'Spitalfields'){echo('selected');}?>>Spitalfields</option>
									<option value="Whitechapel" <?php if($donnees['Area'] == 'Whitechapel'){echo('selected');}?>>Whitechapel</option>
									<option value="Walthamstow" <?php if($donnees['Area'] == 'Walthamstow'){echo('selected');}?>>Walthamstow</option>
									<option value="Mile End" <?php if($donnees['Area'] == 'Mile End'){echo('selected');}?>>Mile End</option>
									<option value="Bow" <?php if($donnees['Area'] == 'Bow'){echo('selected');}?>>Bow</option>
									<option value="Stratford" <?php if($donnees['Area'] == 'Stratford'){echo('selected');}?>>Stratford</option>
								</optgroup>
							</select>
						</div>
					</li>
					<li style="clear:both;">
					<li class="float">
						<div class="label" style="display:inline-block;"><label for="Price">Price</label></div>
						<div class="bg_input pro" style="display:inline-block;"><input type="text" name="Price" value="<?php echo stripslashes(nl2br($donnees['Price']));?>" size="8"/></div>
					</li>
					<li class="float" style="height:34px; line-height:34px; width:310px; margin-right:46px;">
						<div id="price_per_checkbox">
							<input type="radio" name="per" value="pw" <?php if($donnees['PricePer'] == 'pw'){echo('checked="checked"');}?>/><label for="pw" style="margin-right:10px;">Per Week</label>
							<input type="radio" name="per" value="pcm" <?php if($donnees['PricePer'] == 'pcm'){echo('checked="checked"');}?>/><label for="pcm">Per Calendar Month</label>
						</div>
					</li>
					<li class="float">
						<div class="label" style="margin-bottom:5px; width:53px;"><label for="Statut">Statut</label></div>
						<div class="select_button">
							<select name="Statut" size="1" style="height:28px; width:141px;">
								<option value="Available" <?php if($donnees['Statut'] == 'Available'){echo('selected');}?>>Available</option>
								<option value="Recently Sold" <?php if($donnees['Statut'] == 'Sold'){echo('selected');}?>>Sold</option>
								<option value="Archive" <?php if($donnees['Statut'] == 'Archive'){echo('selected');}?>>Archive</option>
							</select>
						</div>
					</li>
					<li style="clear:both; padding-top:10px;">
						<div class="label"><label for="Short">Short Description</label></div>
						<div class="bg_textarea"><textarea name="Short" rows="8" cols="80"><?php echo stripslashes(nl2br($donnees['Short']));?></textarea></div>
					</li>
					<li style="clear:both; padding-top:10px;">
						<div class="label"><label for="Description">Description</label></div>
						<div class="bg_textarea"><textarea name="Description" rows="15" cols="80" style="height:190px;"><?php echo stripslashes(nl2br($donnees['Description']));?></textarea></div>
					</li>
					<li class="submit_form">
						<div class="delete_box"><input type="checkbox" name="delete" id="delete"/><label for="delete">Delete</label></div>
						<div class="btn_textarea gauche"><p>SAVE</p><input type="submit" value="Save"/></div>
					</li>
					<li style="clear:both;">
					</li>
				</ul>
			</form>
		</div>
		
		<div id="edit_<?php echo($donnees['Page']);?>_details_<?php echo $donnees['Reference']; ?>" class="property_details  push" style="display:none; opacity:0;">
			<div class="title_categorie"><h4>Property Details</h4></div>
			<form method="post" action="edit_details.php" enctype="multipart/form-data">
				<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
				<input type="hidden" name="Page" value="<?php  echo $currentpage; ?>"/>
				<div class="picture_property">
					<div class="content_categorie">
						<img src="/images/map/<?php echo stripslashes(nl2br($donnees['FloorMap']));?>" alt="map property" width="380px"/>
						<div class="btn_upload"><input type="file" name="Image"/></div>
					</div>
				</div>
				<ul class="details">
					<li class="float">
						<div class="label" style="width:75px;"><label for="Tenure">Tenure</label></div>
						<div class="bg_input pro"><input type="text" name="Tenure" value="<?php echo stripslashes(nl2br($donnees['Tenure']));?>" size="16"/></div>
				</li>
				<li class="float">
					<div class="label" style="width:100px;"><label for="GroundRent">Ground Rent</label></div>
					<div class="bg_input pro"><input type="text" name="GroundRent" value="<?php echo stripslashes(nl2br($donnees['GroundRent']));?>" size="16"/></div>
				</li>
				<li class="float">
					<div class="label" style="width:100px;"><label for="LocalAuthority">Local Authority</label></div>
					<div class="bg_input pro"><input type="text" name="LocalAuthority" value="<?php echo stripslashes(nl2br($donnees['LocalAuthority']));?>" size="16"/></div>
				</li>
				<li class="float">
					<div class="label" style="width:75px;"><label for="TotalSq">Total Sq Ft</label></div>
					<div class="bg_input pro"><input type="text" name="TotalSq" value="<?php echo stripslashes(nl2br($donnees['TotalSq']));?>" size="16"/></div>
				</li>
				<li class="float">
					<div class="label" style="width:100px;"><label for="ServiceCharge">Service Charge</label></div>
					<div class="bg_input  pro"><input type="text" name="ServiceCharge" value="<?php echo stripslashes(nl2br($donnees['ServiceCharge']));?>" size="16"/></div>
				</li>
				<li class="float">
					<div class="label" style="width:100px;"><label for="CouncilTax">Council Tax</label></div>
					<div class="bg_input  pro"><input type="text" name="CouncilTax" value="<?php echo stripslashes(nl2br($donnees['CouncilTax']));?>" size="16"/></div>
				</li>
				<li class="float" style="margin-right:83px;">
					<div class="label" style="width:75px;"><label for="EpcCurrent">Epc Current</label></div>
					<div class="bg_input  pro"><input type="text" name="EpcCurrent" value="<?php echo stripslashes(nl2br($donnees['EpcCurrent']));?>" size="2"/></div>
				</li>
				<li class="float">
					<div class="label" style="width:101px;"><label for="EpcPotential">Epc Potential</label></div>
					<div class="bg_input  pro"><input type="text" name="EpcPotential" value="<?php echo stripslashes(nl2br($donnees['EpcPotential']));?>" size="2"/></div>
				</li>
				<li style="clear:both;"></li>
				<li class="float">
					<div class="label" style="margin-bottom:5px; width:75px;"><label for="Statut">Type</label></div>
					<div class="select_button">
						<select name="Type" size="1" style="height:28px; width:135px;">
							<option value="Flat" <?php if($donnees['Type'] == 'Flat'){echo('selected');}?>>Flat</option>
							<option value="Studio" <?php if($donnees['Type'] == 'Studio'){echo('selected');}?>>Studio</option>
							<option value="House" <?php if($donnees['Type'] == 'House'){echo('selected');}?>>House</option>
						</select>
					</div>
				</li>
				<li class="float" style="margin-left:21px;">
					<div class="label" style="margin-bottom:5px; width:100px;"><label for="Bedroom">Bedroom</label></div>
					<div class="select_button">
						<select name="Bedroom" size="1" style="height:28px; width:138px;">
							<option value="Studio" <?php if($donnees['Bedroom'] == 'Studio'){echo('selected');}?>>Studio</option>
							<option value="1" <?php if($donnees['Bedroom'] == '1'){echo('selected');}?>>1</option>
							<option value="2" <?php if($donnees['Bedroom'] == '2'){echo('selected');}?>>2</option>
							<option value="3" <?php if($donnees['Bedroom'] == '3'){echo('selected');}?>>3</option>
							<option value="4" <?php if($donnees['Bedroom'] == '4'){echo('selected');}?>>4</option>
							<option value="5" <?php if($donnees['Bedroom'] == '5'){echo('selected');}?>>5</option>
							<option value="6" <?php if($donnees['Bedroom'] == '6'){echo('selected');}?>>6</option>
						</select>
					</div>
				</li>
				<li style="clear:both;">
				<li class="submit_form">
					<div class="delete_box"><input type="checkbox" name="delete" id="delete"/><label for="delete">Delete</label></div>
					<div class="btn_textarea gauche"><p>SAVE</p><input type="submit" value="Save"/></div>
				</li>
			</ul>
			<ul style="clear:both;"></ul>
			</form>
			</div>
		
		<div id="edit_<?php echo($donnees['Page']);?>_room_<?php echo $donnees['Reference']; ?>" class="property_room_contener push" style="display:none; opacity:0;">
			<div class="title_categorie"><h4>Property Room</h4></div>
				<form method="post" action="edit_room_add.php" enctype="multipart/form-data">
				<input type="hidden" name="Ref" value="<?php echo $donnees['Reference']; ?>"/>
				<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>
				<ul class="room_lister">
					<li class="room_box" style="height:403px;">
						<ul class="room_add" style=" background-color:#EF7F00;">
							<li style="clear:both; padding-bottom:10px;">
								<div class="label" style="width:100px; color:#FFF;"><label for="RoomTitle">Room Title</label></div>
								<div class="bg_input pro"><input type="text" name="RoomTitle" size="24"/></div>
								<div style="clear:both;"></div>
							</li>
							<li style="clear:both; padding-bottom:10px;">
								<div class="label" style="width:100px; color:#FFF;"><label for="RoomSize">Room Size</label></div>
								<div class="bg_input pro"><input type="text" name="RoomSize" size="24"/></div>
								<div style="clear:both;"></div>
							</li>
							<li style="clear:both; padding-bottom:10px; color:#FFF;">
								<div class="label" style="width:100px;"><label for="RoomDescription">Description</label></div>
								<div class="bg_textarea pro"><textarea name="RoomDescription" rows="15" cols="80" style="height:190px;"></textarea></div>
								<div style="clear:both;"></div>
							</li>
						</ul>
						<ul style="clear:both;">
							<li class="submit_form_room" style="margin-top:27px; margin-right:0px;">
								<div class="btn_textarea gauche"><p>Add</p><input type="submit" value="Save"/></div>
							</li>
						</ul>
					</li>
					
				</form>
				<?php
						$room = $bdd ->query("SELECT * FROM room WHERE Reference='$ref'");
						while($donnees = $room->fetch())
						{
				?>
							<form method="post" action="edit_room_edit.php" enctype="multipart/form-data">
								<input type="hidden" name="Clef" value="<?php echo $donnees['ID']; ?>"/>
								<input type="hidden" name="Page" value="<?php echo $currentpage; ?>"/>
								<li class="room_box">
									<ul class="room">
										<li style="clear:both; padding-bottom:10px;">
											<div class="label" style="width:100px;"><label for="RoomTitle">Room Title</label></div>
											<div class="bg_input pro"><input type="text" name="RoomTitle" value="<?php echo($donnees['Title']); ?>" size="24"/></div>
											<div style="clear:both;"></div>
										</li>
										<li style="clear:both;padding-bottom:10px;">
											<div class="label" style="width:100px;"><label for="RoomSize">Room Size</label></div>
											<div class="bg_input pro"><input type="text" name="RoomSize" value="<?php echo($donnees['Size']); ?>" size="24"/></div>
											<div style="clear:both;"></div>
										</li>
										<li style="clear:both; padding-bottom:10px;">
											<div class="label" style="width:100px;"><label for="RoomDescription">Description</label></div>
											<div class="bg_textarea pro"><textarea name="RoomDescription" rows="15" cols="80" style="height:190px;"><?php echo stripslashes(nl2br($donnees['Description']));?></textarea></div>
											<div style="clear:both;"></div>
										</li>
									</ul>
									<ul style="clear:both;">
										<div class="submit_form_room" style="margin-right:0px;">
											<div class="delete_box"><input type="checkbox" name="delete" id="delete"/><label for="delete">Delete</label></div>
											<div class="btn_textarea gauche"><p>SAVE</p><input type="submit" value="Save"/></div>
										</div>
									</ul>
								</li>
							</form>
				<?php
						}
						//We stop the current Cursor
						$room->closeCursor();
					?>
					<li style="clear:both;"></li>
				</ul>
		</div>
		
		<div id="edit_<?php echo $currentpage;?>_pictures_<?php echo $ref; ?>" class="property_pictures  push" style="display:none; opacity:0;">
			<div class="title_categorie"><h4>Property Pictures</h4></div>
			<ul>
				<form method="post" action="add_picture.php" enctype="multipart/form-data">
					<input type="hidden" name="Page" value="<?php  echo $currentpage; ?>"/>
					<li class="content_gallery">
						<div class="picture_gallery">
							<img src="/images/new_gallery.png" alt="pictures"/>
						</div>
						<div class="form_gallery">
							<div class="btn_upload">
								<input type="hidden" name="Ref" value="<?php echo $ref; ?>"/>
								<input type="file" name="Image"/>
							</div>
							<div class="btn_textarea gauche">
								<p>ADD</p>
								<input type="submit" value="Add"/>
							</div>
						</div>
					</li>
				</form>
				<?php
					try
				{
					$slid = $bdd->query("SELECT Pictures FROM property WHERE Reference='$ref'");
					$myarray = Array();
					$nom=0;
					//On lance la boucle pour créer toutes les images.
					while ($donnees = $slid->fetch())
					{
						$images = explode(';', $donnees['Pictures']);
						$myarray = array_merge($myarray,$images);
						$number = count($myarray);
						
					}
					for($i = 0; $i < count($myarray);$i++) {
						
?>
							<form method="post" action="edit_picture.php" enctype="multipart/form-data">
								<li class="content_gallery">
									<div class="picture_gallery">
										<img src="<?php echo ($myarray[$i]);?>" alt="pictures" height="270px;"/>
									</div>
									<div class="form_gallery">
										<div class="btn_upload">
											<input type="file" name="Image"/>
										</div>
										<div class="delete_box">
											<input type="checkbox" name="delete" id="delete"/><label for="delete">Delete</label>
										</div>
										<input type="hidden" name="Clef" value="<?php echo $nom; ?>"/>
										<input type="hidden" name="Ref" value="<?php echo $ref; ?>"/>
										<input type="hidden" name="Page" value="<?php  echo $currentpage; ?>"/>
										<div class="btn_textarea gauche">
											<p>Save</p>
											<input type="submit" value="Save"/>
										</div>
									</div>
								</li>
							</form>
<?php 					
$nom++;
}
					//On arrete la lecture de la table.
					$slid->closeCursor();
				}
				//Au cas ou ca ne fonctionne pas :
				catch (Exception $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
?>			
			</ul>
		</div>