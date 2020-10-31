				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Transaction History</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
                                <div class="col-sm-6"></div>
									<table class="table table-hover table-bordered pt-2" id="competitionTable">
										<thead>
											<tr>
												<th>SR No.</th>
												<th>Booking Id</th>
												<th>Transaction Type</th>
												<th>Service Charge</th>
												<th>Municipality Charge</th>
												<th>Total amount</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $n=1;
                                            foreach($accounts as $account):  
                                            //pr($review)?>
											<tr>
                                                <td><?php echo '#'.$n; ?></td>
                                                <td><?php echo $account['booking_view_id']; ?></td>
												<td><?php echo $account['transaction_type']=="D"?"Debit":"Credit"; ?></td>
												<td>₦ <?php echo $account['total_service_charge']; ?></td>
												<td><?php echo "₦ ".$account['municipality_charge']; ?></td>
												<td>₦ <?php echo $account['total_amount_transferred']; ?></td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/Accounts/view/'.base64_encode($account['id']).'/'.base64_encode($account['user_id'])); ?>" class="btn btn-success btn-xs gap-btn"><i class="fa fa-eye edit-tag-icon"></i> View</a>
													<a href="<?php echo $this->Url->build('/admin/Accounts/delete/'.base64_encode($account['id']).'/'.base64_encode($account['user_id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to delete this account information?')"><i class="fa fa-times edit-tag-icon" ></i> Delete</a>
												</td>
											</tr>
											<?php $n++; endforeach ?>
											
										</tbody>
									</table>
								</div>

								<div class="row">
									<div class="col-sm-5">
										<p>Showing <?php echo $this->Paginator->counter('{{start}} to {{end}} of {{count}} entries'); ?></p>
									</div>
									<div class="col-sm-7">
										<ul class="list-unstyled pagination">
											<?php
											echo $this->Paginator->prev('Previous ' . __(''), array(), null, array('class' => 'prev disabled'));
											echo $this->Paginator->numbers(array('separator' => ''));
											echo $this->Paginator->next(__('') . ' Next', array(), null, array('class' => 'next disabled'));
											?>
										</ul>
									</div>
								</div>

							</div>
							<!-- END TABLE HOVER -->
						</div>
					</div>
					
				</div>

<script type="text/javascript">
	$(document).ready(function() {
    	$('#competitionTable').DataTable({
    		"paging": false,
	        "info": false
    	});
    	$('#userTable_paginate').addClass('pull-right');
	});
</script>