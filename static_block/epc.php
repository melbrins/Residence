<div id="epc_title">
	<p>Current</p><p>Potential</p>
</div>
<div id="echelle">
	<ul>
		<li class="A">
			<p>(92 plus)<span class="big">A</span> </p>
		</li>
		<li class="B">
			<p>(81 - 91) <span class="big">B</span></p>
		</li>
		<li class="C">
			<p>(69 - 80) <span class="big">C</span></p>
		</li>
		<li class="D">
			<p>(55 - 68) <span class="big">D</span></p>
		</li>
		<li class="E">
			<p>(39 - 54)<span class="big">E</span> </p>
		</li>
		<li class="F">
			<p>(21 - 38) <span class="big">F</span></p>
		</li>
		<li class="G">
			<p>(1 - 20) <span class="big">G</span></p>
		</li>
	</ul>
</div>
<?php 
	$current= $donnees['EpcCurrent'];
	if($current >= 1 AND $current <=20){
		$currentposition = 5;
		$currentcolor = 'E31D23';
	}else if($current >= 21 AND $current <= 38){ 
		$currentposition = 45;
		$currentcolor = 'ED6823';
	}else if($current >= 39 AND $current <= 54){
		$currentposition = 85;
		$currentcolor = 'F6AE1C';
	}else if($current >= 55 AND $current <= 68){
		$currentposition = 125;
		$currentcolor = 'FFF200';
	}else if($current >= 69 AND $current <= 80){
		$currentposition = 170;
		$currentcolor = '9DCB3C';
	}else if($current >= 81 AND $current <= 91){
		$currentposition = 205;
		$currentcolor = '2C9F29';
	}else if($current >= 92){
		$currentposition = 245;
		$currentcolor = '007F3D';
	}

	$potential = $donnees['EpcPotential'];
	if($potential >= 1 AND $potential <=20){
		$potentialposition = 5;
		$potentialcolor = 'E31D23';
	}else if($potential >= 21 AND $potential <= 38){ 
		$potentialposition = 45;
		$potentialcolor = 'ED6823';
	}else if($potential >= 39 AND $potential<= 54){
		$potentialposition = 85;
		$potentialcolor = 'F6AE1C';
	}else if($potential >= 55 AND $potential <= 68){
		$potentialposition = 125;
		$potentialcolor = 'FFF200';
	}else if($potential >= 69 AND $potential <= 80){
		$potentialposition = 170;
		$potentialcolor = '9DCB3C';
	}else if($potential >= 81 AND $potential<= 91){
		$potentialposition = 205;
		$potentialcolor = '2C9F29';
	}else if($potential >= 92){
		$potentialposition = 245;
		$potentialcolor = '007F3D';
	}
//rajouter le code copier juste apres la balise php
?>
<style>
	#cursor_current p{ <?php if ($currentposition == '125'){ echo('color:#000'); } ?>}
	#cursor_potential p{ <?php if ($potentialposition == '125'){ echo ('color:#000'); } ?>}
	#cursor_current:before {  border-right: 15px solid #<?php echo $currentcolor; ?> }
	#cursor_potential:before {  border-right: 15px solid #<?php echo $potentialcolor; ?>}
</style>
<div id="current">
	<div id="cursor_current" style=<?php echo('"bottom:'.$currentposition.'px; background:#'.$currentcolor.';"');?>>
		<p><?php echo $donnees['EpcCurrent']; ?></p>
	</div>
</div>
<div id="potential">
	<div id="cursor_potential" style=<?php echo('"bottom:'.$potentialposition.'px; background:#'.$potentialcolor.';"');?>>
		<p><?php echo $donnees['EpcPotential']; ?></p>
	</div>
</div>