<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Service Provider List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									
									<select style="margin-left: 2px;" class="btn btn-info pull-right" onchange="statusfilter(this.value)" >
										<option value="">Filter by Status</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
									<a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"add_service_provider"]); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Add New Service Provider</a>
									<table class="table table-hover table-bordered pt-2" id="competitionTable">
										<thead>
											<tr>
												<th>SR No.</th>
												<th>Service Provider Name</th>
												<th>Service Provider Email</th>
												<th>Date of joining</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $n=1;
											foreach($service_providers as $service_provider): ?>
											<tr>
												<td><?php echo '#'.$n; ?></td>
												<td><?php echo $service_provider['firstName'].' '.$service_provider['lastName']; ?></td>
												<td><?php echo $service_provider['email']; ?></td>
												<td><?php echo date("d/m/Y", strtotime($service_provider['createdDate'])); ?></td>
												<td>
													<?php if($service_provider['isActive']==1) { ?>
													<img src="<?php echo $this->Url->build('/img/success.png'); ?>" class="status-image" />
													<?php } else { ?>
													<img src="<?php echo $this->Url->build('/img/cross.png'); ?>" class="status-image" />
													<?php } ?>
												</td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/Users/edit_service_provider/'.base64_encode($service_provider['id'])); ?>" class="btn btn-info btn-xs gap-btn"><i class="fa fa-edit edit-tag-icon"></i> Edit</a>
													<a href="<?php echo $this->Url->build('/admin/Users/service_provider_view/'.base64_encode($service_provider['id'])); ?>" class="btn btn-success btn-xs gap-btn"><i class="fa fa-eye edit-tag-icon"></i> View</a>
                                                    <a href="<?php echo $this->Url->build('/admin/Accounts/index/'.base64_encode($service_provider['id'])); ?>" class="btn btn-primary btn-xs gap-btn"><i class="lnr lnr-database"></i> Account</a>
													<a href="<?php echo $this->Url->build('/admin/Users/status/'.base64_encode($service_provider['id'])); ?>" class="btn btn-warning btn-xs gap-btn"> Change Status</a>
													<a href="<?php echo $this->Url->build('/admin/Users/delete/'.base64_encode($service_provider['id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to remove this User?')"><i class="fa fa-times edit-tag-icon" ></i> Delete</a>
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
	function statusfilter(value){
		if(value){
			window.location.href='<?php echo $this->Url->build(["controller"=>"Users", "action"=>"service_provider_list"]); ?>?status='+value;
		}
	}
</script>