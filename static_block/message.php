<?php if(isset($_GET['email']))
{
	if( $_GET['email'] == 'on'){
	?>
	<div id="msg" style="background-color: #78b879;">
		<p> Your email address has been changed</p>
	</div>
	<?php
	}else if( $_GET['email'] == 'off'){
	?>
	<div id="msg">
		<p> Nothing changed</p>
	</div>
	<?php
	}
}
?>
<?php if(isset($_GET['phone']))
{
	if( $_GET['phone'] == 'on'){
	?>
	<div id="msg" style="background-color: #78b879;">
		<p> Your Phone number has been changed</p>
	</div>
	<?php
	}else if( $_GET['phone'] == 'off'){
	?>
	<div id="msg">
		<p> Nothing changed </p>
	</div>
	<?php
	}
}
?>
<?php if(isset($_GET['address']))
{
	if( $_GET['address'] == 'on'){
	?>
	<div id="msg" style="background-color: #78b879;">
		<p> Your Address has been changed</p>
	</div>
	<?php
	}else if( $_GET['address'] == 'off'){
	?>
	<div id="msg">
		<p> Nothing changed </p>
	</div>
	<?php
	}
}
?>
<?php if(isset($_GET['psd']))
{
	if( $_GET['psd'] == 'on'){
	?>
	<div id="msg" style="background-color: #78b879;">
		<p> Your password has been changed</p>
	</div>
	<?php
	}else if( $_GET['psd'] == 'none'){
	?>
	<div id="msg">
		<p> You didn't write the same new password, please try again</p>
	</div>
	<?php
	}else if( $_GET['psd'] == 'off'){
	?>
	<div id="msg">
		<p> Nothing changed</p>
	</div>
	<?php
	}
}
if(isset($_GET['edit']))
		{
			?>
			<div id="msg" style="background-color: #78b879;">
				<p> This article has been correctly edited !</p>
			</div>
			<?php
		}else if(isset($_GET['noedit']))
		{
			?>
			<div id="msg">
				<p>Nothing change !</p>
			</div>
			<?php
		}
if(isset($_GET['delete']))
		{
			?>
			<div id="msg" style="background-color: #78b879;">
				<p>Article(s) has been deleted !</p>
			</div>
			<?php
		}
if(isset($_GET['delete_cover']))
		{
			?>
			<div id="msg" style="background-color: #78b879;">
				<p>Your cover picture has been successfully deleted</p>
			</div>
			<?php
		}
if(isset($_GET['reference']) AND $_GET['reference'] == no)
		{
			?>
			<div id="msg">
				<p>No property with this reference</p>
			</div>
			<?php
		}
if(isset($_GET['size'])){

?>

	<div id="msg">
		<p> Your picture is too big</p>
	</div>

<?php

}

if(isset($_GET['ext'])){

	?>

	<div id="msg">
		<p> Only in Jpg or Png</p>
	</div>
	
	<?php
}

if(isset($_GET['select'])){

	?>

	<div id="msg" style="background-color: #78b879;">
		<p>Homepage picture selected</p>
	</div>
	
	<?php
}

if(isset($_GET['add']) AND $_GET['add'] == on){

	?>

	<div id="msg" style="background-color: #78b879;">
		<p>Added correctly</p>
	</div>
	
	<?php
}

?>