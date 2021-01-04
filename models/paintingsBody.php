<?php
    $paintingNum = $result['paintingNumber'];
    $fullImg = $result['picture_full'];
	$enviImg = $result['picture_envi'];
	$year = $result['year'];
	$dimensions = $result['dimensions'];
	$series = $result['series'];
	$color = $result['color'];
	$technique = $result['technique'];
	$paintId = $result['paintings_id'];

?>
<div id="request" style="display:none;">
	<div id="requestBody" class="d-flex align-items-center">
			<div class="container d-flex justify-content-center">
				<form method="post" action="form.php" id="requestForm">
					<div class="d-flex flex-row justify-content-end">
						<span id="close"><i class="fas fa-times fa-2x"></i></span>
					</div>
					<div class="form-group">
						<label>Vorname</label>
						<input type="text" class="form-control" name="firstname">
					</div>
					<div class="form-group">
						<label>Nachname</label>
						<input type="text" class="form-control" name="surname">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="Email" class="form-control" name="email">
					</div>
					<div class="d-none">
						<input type="number" name="paintId" <?php echo "value=\"$paintId\""?>>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary" id="">Anfrage absenden</button>
					</div>
				</form>
			</div>
	</div>
</div>

<div class="container-fluid">

		<div class="row">
			<div class="col-md-8 pt-0 pb-5 px-4">
                <div style="margin: 1em 5em;">
                    <?php
                        echo "<img src=\"..\static\pictures\detail\\$fullImg\" class=\"img-fluid\" alt=\"Responsive image\">"
                    ?>
				</div>
				
				<hr style="width:80%;background-color: #F2F2F2;text-align:center; margin-top: 50px; margin-bottom: 50px;">
				
				<div class="row">
					<div class="col-sm text-center">
                        <?php
                            echo "<img src=\"..\static\pictures\detail\\$enviImg\" class=\"img-fluid\" alt=\"Responsive image\" style=\"height: 25em;\">"
                        ?>
					</div>
					<div class="col-sm d-flex align-items-center p-0">
						<div style="width: 80%">
							<div class="row my-3">
								<div class="col-3 d-flex justify-content-center align-items-center">
									<div>
										<i class="fas fa-paint-brush"></i>
									</div>
								</div>
								<div class="col-9">
									<div>
										<h6>Technik</h6>
										<p><?php echo $color;?></p>
									</div>
								</div>
							</div>
							<div class="row my-3">
								<div class="col-3 d-flex justify-content-center align-items-center">
									<div>
										<i class="fas fa-tools"></i>
									</div>
								</div>
								<div class="col-9">
									<div>
										<h6>Verarbeitung</h6>
										<p><?php echo $technique;?></p>
									</div>
								</div>
							</div>
							<div class="row my-3">
								<div class="col-3 d-flex justify-content-center align-items-center">
									<div>
										<i class="fas fa-truck"></i>
									</div>
								</div>
								<div class="col-9">
									<div>
										<h6>Versand</h6>
										<p>Deutschlandweit kostenlos</p>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

			</div>
			<div class="col-md-4 p-0" style="background-color: #f8f8f8;">
				<div class="d-flex justify-content-center">
					<div class="mt-5" style="width: 60%;">
						<h3 class=""><?php echo "Bild Nr. $paintingNum" ?></h3>
						<div class="row pt-3">
							<div class="col-sm">
								<p>Entstehungsjahr:</p>
							</div>
							<div class="col-sm">
								<p><?php echo $year;?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm">
								<p>Maße:</p>
							</div>
							<div class="col-sm">
								<p><?php echo $dimensions;?></p>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col-sm">
								<p>Serie:</p>
							</div>
							<div class="col-sm">
								<p><?php echo $series;?></p>
							</div>
						</div>
						<div class="text-center"><label style="font-size: small; color:grey;"><i class="fas fa-info-circle"></i> Generelle Preisinformationen</label></div>
						<div class="text-center">
							<button id="requestButton" type="button" class="btn btn-dark">Anfragen</button>
						</div>
						<?php 
							if(array_key_exists('r', $_GET)){
								echo '<div class="text-center mt-4">
									<p class="m-0"><span style="color: green;"><i class="fas fa-check"></i></span> Anfrage erfolgreich</p>
								</div>';
							}
						
						?>
					</div>
				</div>

				<hr style="width:80%;background-color: #F2F2F2;text-align:center; margin-top: 50px; margin-bottom: 50px;">

				<div class="d-flex justify-content-center">
					<div style="width: 60%;">
						<h5 class="text-center">Rahmung</h5>
						<div class="row pt-3">
							<div class="col">
								<p>Zustand:</p>
							</div>
							<div class="col">
								<p>ungerahmt</p>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col">
								<p>Bereit zum Aufhängen:</p>
							</div>
							<div class="col">
								<p>nein</p>
							</div>
						</div>
					</div>


				</div>	

			</div>
		</div>
</div>

<?php
	include 'footer.php';
?>

