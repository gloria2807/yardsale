<?php require_once('header.php'); ?>

<?php
    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
   
foreach($result as $row) {
    $p_name = $row['p_name'];
    $p_current_price = $row['p_current_price'];
    $p_featured_photo = $row['p_featured_photo'];
    $p_description = $row['p_description'];
    $p_short_description = $row['p_short_description'];
    $p_total_view = $row['p_total_view'];
    $p_is_featured = $row['p_is_featured'];
    $p_is_active = $row['p_is_active'];
    $ecat_id = $row['ecat_id'];
}


$p_total_view = $p_total_view + 1;

$statement = $pdo->prepare("UPDATE tbl_product SET p_total_view=? WHERE p_id=?");
$statement->execute(array($p_total_view,$_REQUEST['id']));


?>


<div class="page" style="background-color: black; color:gold;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
                <div class="breadcrumb mb_30" style="background-color: black; color:gold;">
                    <ul>
                        <li><a style="color:gold;" href="index.php">Home</a></li>
                       <li style="color:white;">></li>
                        <li style="color:white;"><?php echo $p_name; ?></li>
                    </ul>
                </div>

				<div class="product">
					<div class="row">
						<div class="col-md-5">
							<ul class="prod-slider">
                                
								<li style="background-image: url(assets/uploads/<?php echo $p_featured_photo; ?>);">
                                    <a class="popup" href="assets/uploads/<?php echo $p_featured_photo; ?>"></a>
								</li>
                                <?php
                                $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
                                $statement->execute(array($_REQUEST['id']));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <li style="background-image: url(assets/uploads/product_photos/<?php echo $row['photo']; ?>);">
                                        <a class="popup" href="assets/uploads/product_photos/<?php echo $row['photo']; ?>"></a>
                                    </li>
                                    <?php
                                }
                                ?>
							</ul>
							<div id="prod-pager">
								<a data-slide-index="0" href=""><div class="prod-pager-thumb" style="background-image: url(assets/uploads/<?php echo $p_featured_photo; ?>"></div></a>
                                <?php
                                $i=1;
                                $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
                                $statement->execute(array($_REQUEST['id']));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <a data-slide-index="<?php echo $i; ?>" href=""><div class="prod-pager-thumb" style="background-image: url(assets/uploads/product_photos/<?php echo $row['photo']; ?>"></div></a>
                                    <?php
                                    $i++;
                                }
                                ?>
							</div>
						</div>
						<div class="col-md-7">
							<div class="p-title"><h2 style="color:white;"><?php echo $p_name; ?></h2></div>
														<div class="p-short-des">
								<p>
									<?php echo $p_short_description; ?>
								</p>
							</div>
                            							<div class="p-price">
                                <span style="font-size:14px; color:gold;"><?php echo LANG_VALUE_54; ?></span><br>
                                <span style="color:white;">
                                        <?php echo LANG_VALUE_1; ?><?php echo $p_current_price; ?>
                                </span>
                            </div>
                            <input type="hidden" name="p_current_price" value="<?php echo $p_current_price; ?>">
                            <input type="hidden" name="p_name" value="<?php echo $p_name; ?>">
                            <input type="hidden" name="p_featured_photo" value="<?php echo $p_featured_photo; ?>">
							<div class="">
                                <a href="#description" aria-controls="description" role="tab" data-toggle="tab" style="color: gold; size:16px;"><?php echo LANG_VALUE_57; ?></a>
                                <span style="color:white;">
<?php
                                        if($p_description == '') {
                                            echo LANG_VALUE_69;
                                        } else {
                                            echo $p_description;
                                        }
                                        ?>
                                        </span>
 <br>
								
							</div>
							<div class="btn-cart btn-cart1">
                                <a style="background:gold;color:black;border:black;" href="kingsch.at/"><?php echo LANG_VALUE_151; ?></a>
							</div>
                            <div class="btn-cart btn-cart1">
                                <a style="background:gold;color:black;border:black;" href="whatsapp.web/"><?php echo LANG_VALUE_152; ?></a>
							</div>
                            </form>
							
						</div>
					</div>

					
				</div>

			</div>
		</div>
	</div>
</div>



<?php require_once('footer.php'); ?>
