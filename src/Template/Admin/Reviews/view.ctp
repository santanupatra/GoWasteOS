				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Review Details</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="sample_" style="width:75%">

                                                    <tr>
                                                        <th class="hidden-phone"><b>Rating</b></th>
                                                        <td>
                                                        <div class="rate">
                                                            <span id="span1"  class="fa fa-star <?php if($review['rating']>1 || $review['rating']==1) echo "checked"; ?>"></span> 
                                                            <span id="span2"  class="fa fa-star <?php if($review['rating']>2 || $review['rating']==2) echo "checked"; ?>"></span>
                                                            <span id="span3" class="fa fa-star <?php if($review['rating']>3 || $review['rating']==3) echo "checked"; ?>"></span>
                                                            <span id="span4"   class="fa fa-star <?php if($review['rating']>4 || $review['rating']==4) echo "checked"; ?>"></span>
                                                            <span id="span5"  class="fa fa-star <?php if($review['rating']>4) echo "checked"; ?>"></span> 
                                                        </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Booking Id</b></th>
                                                        <td><?php echo $review['booking']['view_id'];  ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Review Given By</b></th>
                                                        <td><?php echo $review['reviewer']['firstName'].' '.$review['reviewer']['lastName'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Review Given To</b></th>
                                                        <td><?php echo $review['reviewd']['firstName'].' '.$review['reviewd']['lastName'];  ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="hidden-phone"><b>Comment</b></th>
                                                        <td><?php echo $review['comment'];  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="hidden-phone"><b>Review Date</b></th>
                                                        <td><?php echo gmdate('M d, Y h:i A',strtotime($review['created_date']));  ?></td>
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