<section>
	<h3>Projets en cours</h3>
	<table>
		<tbody>
			<?php
				foreach ($listeProjets as $key => $value) { ?>
					<tr>
						<td>
							<span id="projectName"><?php echo $value->getName(); ?></span><span>Places disponibles<button id="placesLeft"><?php echo ($this->calculePlaces($value->getVolunteersNumber(), $value->getId())); ?></button></span><br/>
							<span><?php echo $value->getDescription(). " "; ?></span><span>Avancement du projet <?php echo " ". $value->getStatus()->getName(); ?> %</span><br/>
						</td>
					</tr>
				<?php } ?>
			
		</tbody>	
	</table>
</section>
