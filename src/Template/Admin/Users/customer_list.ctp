<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Customer List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<a href="<?php echo $this->Url->build(["controller"=>"users", "action"=>"add_customer"]); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Add New Customer</a>
									<table class="table table-hover table-bordered pt-2" id="competitionTable">
										<thead>
											<tr>
												<th>SR No.</th>
												<th>Customer Name</th>
												<th>Customer Email</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $n=1;
											foreach($customers as $customer): ?>
											<tr>
												<td><?php echo '#'.$n; ?></td>
												<td><?php echo $customer['firstName'].' '.$customer['lastName']; ?></td>
												<td><?php echo $customer['email']; ?></td>
												<td>
													<?php if($customer['isActive']==1) { ?>
													<img src="<?php echo $this->Url->build('/img/success.png'); ?>" class="status-image" />
													<?php } else { ?>
													<img src="<?php echo $this->Url->build('/img/cross.png'); ?>" class="status-image" />
													<?php } ?>
												</td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/Users/edit_customer/'.base64_encode($customer['id'])); ?>" class="btn btn-info btn-xs gap-btn"><i class="fa fa-edit edit-tag-icon"></i> Edit</a>
													<a href="<?php echo $this->Url->build('/admin/Users/customer_view/'.base64_encode($customer['id'])); ?>" class="btn btn-success btn-xs gap-btn"><i class="fa fa-eye edit-tag-icon"></i> View</a>
													<a href="<?php echo $this->Url->build('/admin/Accounts/index/'.base64_encode($customer['id'])); ?>" class="btn btn-primary btn-xs gap-btn"><i class="lnr lnr-database"></i> Account</a>
                                                    <a href="<?php echo $this->Url->build('/admin/Users/status/'.base64_encode($customer['id'])); ?>" class="btn btn-warning btn-xs gap-btn"> Change Status</a>
													<a href="<?php echo $this->Url->build('/admin/Users/delete/'.base64_encode($customer['id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to remove this User?')"><i class="fa fa-times edit-tag-icon" ></i> Delete</a>
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