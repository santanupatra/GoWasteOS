				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Account Details</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="sample_" style="width:75%">
                                                
                                                    <tr>
                                                        <th class="hidden-phone"><b>Name</b></th>
                                                        <td><?php echo $account['user']['firstName'].' '.$account['user']['lastName'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Booking Id</b></th>
                                                        <td><?php echo $account['booking_view_id'];  ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Transaction Type</b></th>
                                                        <td><?php echo $account['transaction_type']=="D"?"Debit":"Credit";  ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Service Charge</b></th>
                                                        <td>₵<?php echo $account['total_service_charge'];?></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Municipality Charge</b></th>
                                                        <td><?php echo "₵".$account['municipality_charge']; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Total Amount</b></th>
                                                        <td>₵<?php echo $account['total_amount_transferred']; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Date of Transaction</b></th>
                                                        <td><?php echo gmdate('M d, Y h:i A',strtotime($account['created_date']));  ?></td>
                                                    </tr>


                                                    <tr>
                                                        <th class="hidden-phone"><b><?php echo $account['user']['type']=="SP"?"Total Revenue Generated":"Total Cost Generated";?></b></th>
                                                        <td>₵<?php echo $total;  ?></td>
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

.rate {
    float: left;
    text-align: left;
}
.rate span{
    cursor:pointer;
}
.checked {
  color: orange;
}
</style>