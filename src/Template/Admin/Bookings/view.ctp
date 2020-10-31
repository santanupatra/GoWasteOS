				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Booking Details</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
                                
								<div class="panel-body">
                            
                                        <div class="table-responsive">
                                        <!-- <a href="<?php echo $this->Url->build('/admin/Bookings/report/'.base64_encode($booking['id'])); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Generate Pdf</a> -->
                                            <table class="table table-striped table-bordered table-hover" id="sample_" style="width:75%">

                                                
                                                    <tr>
                                                        <th class="hidden-phone"><b>Booking Id</b></th>
                                                        <td><?php echo $booking['view_id'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Booking Done on</b></th>
                                                        <td><?php echo gmdate('M d, Y h:i A',strtotime($booking['created_date']));  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Booking Status</b></th>
                                                        <td><?php echo $booking['service_status']=="P"?"Pending":($booking['service_status']=="C&R"?"Cancel & Refunded":"Completed");?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Customer Name</b></th>
                                                        <td><?php echo $booking['customer']['firstName'].' '.$booking['customer']['lastName'];  ?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th class="hidden-phone"><b>Service Provider Name</b></th>
                                                        <td><?php echo $booking['provider']['firstName'].' '.$booking['provider']['lastName'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>City </b></th>
                                                        <td><?php echo $booking['city']['name'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Service Name</b></th>
                                                        <td><?php echo $booking['service']['title'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Size of Waste</b></th>
                                                        <td><?php echo $booking['waste_size'];  ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Service Charge</b></th>
                                                        <td>₦ <?php echo $booking['service_charge'];  ?></td>
                                                    </tr>


                                                    <tr>
                                                        <th class="hidden-phone"><b>Service Location</b></th>
                                                        <td><?php echo $booking['service_loaction'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Booking Date</b></th>
                                                        <td><?php echo gmdate('M d, Y',strtotime($booking['booking_date'])); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Booking Time</b></th>
                                                        <td><?php echo gmdate('h:i A',strtotime($booking['booking_time']));  ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Payment Status</b></th>
                                                        <td><?php echo $booking['payment_status']==1?"Paid":"UnPaid";  ?></td>
                                                    </tr>
                                                    

                                                <?php if($booking['payment_status']==1) { ?>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Currency</b></th>
                                                        <td><?php echo $booking['payment']['currency'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Payment Method</b></th>
                                                        <td><?php echo $booking['payment']['payment_method'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Transaction Id</b></th>
                                                        <td><?php echo $booking['payment']['transaction_id'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Payment Date</b></th>
                                                        <td><?php echo gmdate('M d, Y',strtotime($booking['payment']['createdDate'])); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                            
                                                    <tr>
                                                        <th class="hidden-phone">Total Amount Paid</th>
                                                        <td>

                                                            <table>
                                                            <tr>
                                                                
                                                                <th>Total Service Charge</th>
                                                                <th>Municipality Charge</th>
                                                                <th>Total Charge</th>
                                                            </tr>

                                                            <tr>
                                                                <td>₦ <?php echo $booking['payment']['service_charge']; ?></td>
                                                                <td>₦ <?php echo $booking['payment']['municipality_charge']; ?></td>
                                                                <td>₦ <?php echo $booking['payment']['total_amount']; ?></td>
                                                            </tr>
                                                            
                                                            </table>
                                                        </td>
                                                    </tr>  
                                                
                                            </table>

                                        </div>
                                    </div>

					            </div>
							</div>
						</div>
					</div>
				</div>

                <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>