<?php include 'header.php'; ?>
<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<div class="app-content">
	<section class="section">
		<div class="row">
			<div class="col-sm-3 col-md-3 col-xs-2">
				<ol class=" breadcrumb">
				<?php $serachurl = isset($searchval) ? $searchval : 'bm8=';?>
              <?php $pageurl = isset($pageval) ? $pageval : '0'; ?>
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>Nav/manage_order/<?= $serachurl ?>/<?= $pageurl ?>">Manage Order</a></li>
					<li class="breadcrumb-item active" aria-current="page">View Order</li>
				</ol>
			</div>
			
			<div class="col-sm-9 col-md-9 col-xs-4">
				<button type="button" class="btn btn-primary btn-primary-1" style="margin-bottom:30px; float: right;"
					onClick="goBack()"><i class="fa fa-arrow-left" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	
		<!-- <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body"> -->
	<div class="section-body ">
		<div class="row">
			<div class="col-lg-12">
				<div class="e-panel card">
					<div class="card-body">
						<div class="e-table">
							<div class="row">
								<div class="col-md-5">
									<input type="hidden" name="oid" id="oid" value="<?php echo $vieworder->MOR_id;?>">
									<table class="table table-responsive">
										<?php
										$artist=get_row('mov_user_master','MUM_Full_name',"MUM_ID=".$vieworder->MUM_ID);
										$product=get_row('mov_products','MP_Product_Name',"MP_ProID=".$vieworder->MP_ProID);
										if($vieworder->MOR_image !='') {
											$nimg = "";
											$img_folder = 'product-images/';
											$external_link = IMAGE_PATH . $img_folder . $vieworder->MOR_image;
											if (@getimagesize($external_link)) {
												$get_cat_logo = $vieworder->MOR_image;
											} else {
												$nimg = 'style="color : #666"';
												$get_cat_logo = 'no-image.jpg';
											}																
											}
											else{
											$img_folder = 'product-images/';
											$nimg = 'style="color : #666"';
											$get_cat_logo = 'no-image.jpg';
											}
										?>
										<tr><td><b>Order No :</b></td><td><?php echo $vieworder->MOR_number; ?></td></tr>
										<tr><td><b>Special Description :</b></td><td><?php echo $vieworder->MOR_special_instruction; ?></td></tr>
										<tr><td><b>Body Part :</b></td><td><?php echo $vieworder->MOR_body_part; ?></td></tr>
										<tr><td><b>Artist :</b></td><td><?php if(isset($artist->MUM_Full_name)){echo $artist->MUM_Full_name;;} ?></td></tr>
										<tr><td><b>Total Amount :</b></td><td><?php echo $vieworder->MOR_total_amount; ?></td></tr>
										<tr><td><b>Booking Status :</b></td><td><?php if($vieworder->MOR_booking_status==0){echo 'Pending';}elseif($vieworder->MOR_booking_status==1){echo 'Booked';}else{echo 'Cancelled';} ?></td></tr>
										<tr><td><b>Booking Date :</b></td><td><?php echo $vieworder->MOR_booking_date; ?></td></tr>
										<tr><td><b>Client Name :</b></td><td><?php echo $vieworder->MOR_client_name; ?></td></tr>
										<tr><td><b>Client Email :</b></td><td><?php echo $vieworder->MOR_client_email; ?></td></tr>
										<tr><td><b>Client Age :</b></td><td><?php echo $vieworder->MOR_client_age; ?></td></tr>
										<tr><td><b>Returning Client :</b></td><td><?php if($vieworder->MOR_returning_client==1){echo 'Yes';}else{echo 'No';}?></td></tr>

									</table>
								</div>
								<div class="col-md-5">
									<table class="table table-responsive">
										<tr><td><b>Description :</b></td><td><?php echo $vieworder->MOR_Description; ?></td></tr>
										<tr><td><b>Tattoo Size :</b></td><td><?php echo $vieworder->MOR_Tattoo_size; ?></td></tr>
										<tr><td><b>Product :</b></td><td><?php if(isset($product->MP_Product_Name)){echo $product->MP_Product_Name;;} ?></td></tr>
										<tr><td><b>Payment Type :</b></td><td><?php if($vieworder->MOR_payment_type==1){echo 'Full';}else{echo 'Part';} ?></td></tr>
										<tr><td><b>Payment Status :</b></td><td><?php if($vieworder->MOR_payment_status==0){echo 'Pending';}else{echo 'Received';} ?></td></tr>
										<tr><td><b>Payment Date :</b></td><td><?php echo $vieworder->MOR_payment_date; ?></td></tr>
										<tr><td><b>Paid Amount :</b></td><td><?php echo $vieworder->MOR_pay_amount; ?></td></tr>
										<tr><td><b>Payment Percent :</b></td><td><?php echo $vieworder->MOR_payment_percent.' %'; ?></td></tr>
										<tr><td><b>Payment Mode :</b></td><td><?php if($vieworder->MOR_type==1){echo 'Online';}else{echo 'Offline';} ?></td></tr>
										<tr><td><b>Client Number :</b></td><td><?php echo $vieworder->MOR_client_name; ?></td></tr>
										<tr><td><b>Client Address :</b></td><td><?php echo $vieworder->MOR_client_address; ?></td></tr>
									</table>
								</div>
								<div class="col-md-2">
									<img  class="img-responsive" style="width:100%; max-height:400px" src="<?php echo IMAGE_PATH . $img_folder . $get_cat_logo; ?>">
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<h4>Send</h4>
										</div>
										<div class="card-body	text-center">
											<!-- <button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-3">Send </button> -->
											<?php //if ($obj->MUM_User_type == 1 || $obj->MUM_User_type == 4){?>
													<?php //if ((in_array("Apply Leave", $pagemodify)) && $usid == $edit_id) { ?>
													<!-- <a href="#"  id="invoicedisplay" class="btn btn-primary btn-primary-1 mt-3 mb-3" >Send or Print Invoice</a> -->
													<!-- <span class="mailloader" style="display:none;" ><img style="max-width:200px;" src="<?php echo base_url().'public/img1/spinner2.gif';?>" alt="Img" title="Img" class="img-circle"></span	> -->
													<a href="#inline1" data-modaal-type="inline" data-modaal-animation="fade" class="modaal"><button class="btn btn-primary btn-primary-1 mt-3 mb-3" onclick="invoicedisplay(<?php echo $vieworder->MOR_id;?>)" data-toggle="modal" type="button">Send or Print Invoice</button> 
													</a>
													<?php //}?>
											<?php //}?>
											
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<h4>Requet For Review</h4>
										</div>
										<div class="card-body	text-center">
											<!-- <button type="submit" class="btn btn-primary btn-primary-1 mt-3 mb-3">Send </button> -->
												<?php //if ($obj->MUM_User_type == 1 || $obj->MUM_User_type == 4){?>
													<?php //if ((in_array("Apply Leave", $pagemodify)) && $usid == $edit_id) { ?>
													<!-- <a href="#"  id="invoicedisplay" class="btn btn-primary btn-primary-1 mt-3 mb-3" >Send or Print Invoice</a> -->
													<!-- <span class="mailloader" style="display:none;" ><img style="max-width:200px;" src="<?php echo base_url().'public/img1/spinner2.gif';?>" alt="Img" title="Img" class="img-circle"></span	> -->
													<a href="#inline2" data-modaal-type="inline" data-modaal-animation="fade" class="modaal"><button class="btn btn-primary btn-primary-1 mt-3 mb-3" data-toggle="modal" type="button">Send</button> 
													</a>
													<?php //}?>
											<?php //}?>
											
										</div>
									</div>

								</div>

							</div>	

							<!-- </div> -->
							<div id="invoice_msg" style="display:none;">
								<?php
									$this->load->view('emailtemplate/invoice',$vieworder);
								?>
							</div>
							<div id="inline1" style="display:none;">
								<div class="container">
									<div class="row">
										<div class="col-md-12 pt-25" id="policyform">
											<div class="col-md-12" style="padding: 30px;">
												<div class="form-group row">
													<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Email To :</label>
													<div class="col-md-6 col-sm-6 col-xs-12 ">
														<input id="invoice_emailto" name="invoice_emailto" class="form-control" type="text" value="<?php echo $vieworder->MOR_client_email;?>" >
													</div>
												</div>
												<div class="form-group row">
													<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Email Subject :</label>
													<div class="col-md-6 col-sm-6 col-xs-12 ">
													<input id="invoice_emailsub" name="invoice_emailsub" class="form-control " type="text" value="Invoice for your order <?php echo $vieworder->MOR_number;?>  ">
													</div>
												</div>
												<div class="form-group row">
													<div  class="col-md-4 col-sm-4 col-xs-8" style="margin-bottom:15px;font-size: 12px;margin-right:10px;">
														<button type="button" class="btn btn-success"  id="" onclick="javascript:printDiv('invoice_msg','Invoice')">Print This invoice in HTML</button>
														</br>
													</div>
													<div  class="col-md-4 col-sm-4 col-xs-8 " style="margin-bottom:15px;font-size: 12px; margin-right:10px;">
														<form action="<?php echo base_url()?>Order/print_pdf" id="frm_pdf" method="POST">
															<input type="hidden" name="invoice_data" id="invoice_data">
															<input type="hidden" name="website_nm" id="website_nm">
															<input type="hidden" name="searchurl" value="<?= $serachurl?>">
															
															<input type="hidden" name="pageurl" value="<?= $pageurl?>">
															<input type="hidden" name="orderid" value="<?= $vieworder->MOR_id;?>">
															<button type="button" class="btn btn-success"  id="" onclick="pdf_print('invoice_msg','Invoice');" >Download This invoice in PDF</button>
														</form>
													</div>
													<div  class="col-md-3 col-sm-3 col-xs-8 " style="font-size: 12px;margin-left:10px;">
														<button type="button" class="btn btn-success "  id="invoice_send">Send</button>
													</div>
												</div>
												</br>													
											</div>
										</div>
									</div>
								</div>
							</div>

							<div id="inline2" style="display:none;">
								<div class="container">
									<div class="row">
										<div class="col-md-12" id="policyform">
											<form action="" method="post">
												<div class="col-md-12" style="padding: 30px;">
													<div class="form-group row">
														<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Email To :</label>
														<div class="col-md-6 col-sm-6 col-xs-12 ">
															<input id="review_emailto" name="review_emailto" value="<?php echo $vieworder->MOR_client_email; ?>" class="form-control" type="text">
														</div>
													</div>
													<div class="form-group row">
														<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Review Subject :</label>
														<div class="col-md-6 col-sm-6 col-xs-12 ">
															<input id="review_emailsub" name="review_emailsub" value="Review for your order <?php echo $vieworder->MOR_number; ?>" class="form-control " type="text">
															<input name="review_msg" value="http://localhost/ironbuzz/review?num=<?php echo $vieworder->MOR_id; ?>&numordnbr=<?php echo $vieworder->MOR_number; ?>&nume=<?php echo $vieworder->MOR_client_email; ?>&numnmbr=<?php echo $vieworder->MOR_client_number; ?>&numname=<?php echo $vieworder->MOR_client_name; ?>" type="hidden">
														</div>
													</div>
													<!-- <div class="form-group row">
														<a target="_blank" href="http://localhost/ironbuzz/review?num=<?php echo $vieworder->MOR_id; ?>&numordnbr=<?php echo $vieworder->MOR_number; ?>&nume=<?php echo $vieworder->MOR_client_email; ?>&numnmbr=<?php echo $vieworder->MOR_client_number; ?>&numname=<?php echo $vieworder->MOR_client_name; ?>">http://localhost/ironbuzz/review</a>
													</div> -->
													<div class="form-group row">
														<div  class="col-md-12 col-sm-12 col-xs-12" style="font-size: 12px;margin-left:10px;">
															<button type="submit" name="submit" class="btn btn-success "  id="invoice_send">Send</button>
														</div>
													</div>
													</br>													
												</div>
											</form>
										</div>
									</div>

									<?php 
 
 
									if (isset($_POST['submit'])) {
										$review_emailto = $_POST['review_emailto'];
										$review_emailsub = $_POST['review_emailsub'];
										$review_msg = $_POST['review_msg'];
										$from = "info@catotech.in";
										$to = "nmalviya575@gmail.com";
										$subject = "Review";
										$message = "Email: $review_emailto \n \n Review email: $review_emailto \n \n Review: $review_msg";
										$headers = "From: info@catotech.in\r\n";
										$headers .= "Reply-To: nmalviya575@gmail.com\r\n";
										if (mail($to,$subject,$message,$headers)) {
											echo"<script>alert('Mail Send Successfully ! !')</script>";
											echo"<script>window.location.href='index.html'</script>";
										} else {
											echo "Error: Please try agin latter";
										}
									}
									
									?>

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End of product layout -->


		<?php include('footer.php');?>
		<script src='<?php echo base_url()?>public/invoice_style/js/jspdf.debug.js'></script>
		<script src='<?php echo base_url()?>public/invoice_style/js/html2pdf.js'></script>
		<script src='<?php echo base_url()?>public/invoice_style/js/html2canvas.js'></script>
		<script> CI_ROOT = '<?php echo base_url()?>'; 
			CI_actual_link = '<?php echo $actual_link; ?>';
		</script>
		<script>
			$('.inline').modaal({
				content_source: '#inline1'
				// $(this).attr('id');
			});

			$( "#invoice_send" ).click(function() {
				var email=$('#invoice_emailto').val();
				var subject=$('#invoice_emailsub').val();
				var html=document.getElementById('invoice_msg').innerHTML;
				$.ajax({
					type : "POST",
					url : CI_ROOT+'Order/send_invoice',
					data : {
						email:email,subject:subject,html:html
					},
					success :function(result)
					{
						//alert(result);
						if(result=='send')
						{
							alert('Mail sent successfully');
						}
						else
						{
							alert('Something went wrong');
						}
					}
				});
			});

			function pdf_print(divId,title) {
				$('#'+divId).show();
				var pdf = new jsPDF('p', 'pt', 'letter');
				pdf.addHTML($('#'+divId)[0], function () {
				pdf.save('Invoice.pdf');
				$('#'+divId).hide();
				});
			}

			function printDiv(divId,title) {
				let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
				mywindow.document.write(`<html><head><title>${title}</title>`);
				mywindow.document.write('</head><body >');
				mywindow.document.write(document.getElementById(divId).innerHTML);
				mywindow.document.write('</body></html>');
				mywindow.document.close(); // necessary for IE >= 10
				mywindow.focus(); // necessary for IE >= 10*/
				mywindow.print();
				mywindow.close();
				return true;
			}
		</script>
		<?php 
			echo my_file1('web/plugins/datatables/jquery.dataTables.min',2);
			//echo my_file1('web/plugins/datatables/dataTables.bootstrap.min',2);
			echo my_file1('web/custom/product.js?v=101120.0',2);
		?>