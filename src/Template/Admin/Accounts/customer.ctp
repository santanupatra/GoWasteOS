<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Customer Financial Account</h3>
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
												<th>Name</th>
												<th>Total Debit Amount</th>
												<th>Total Credit Amount</th>
												<th>Total Cost Generated</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $n=1;
                                            foreach($accounts as $key => $account):  

                                                ?>
											<tr>
                                                <td><?php echo '#'.$n; ?></td>
                                                <td><?php echo $account['user']['firstName'].' '.$account['user']['lastName']; ?></td>
												<td>₦ <?php echo $debits[$key]; ?></td>
												<td>₦ <?php echo $credits[$key]; ?></td>
												<td>₦ <?php echo $totals[$key]; ?></td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/Accounts/index/'.base64_encode($account['user_id']).'/'.base64_encode($account['user_id'])); ?>" class="btn btn-success btn-xs gap-btn"><i class="fa fa-eye edit-tag-icon"></i> View</a>
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