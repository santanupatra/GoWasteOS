				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Employee List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<a href="<?php echo $this->Url->build(["controller"=>"Employees", "action"=>"add"]); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Add New Employee</a>
									<table class="table table-hover table-bordered pt-2" id="competitionTable">
										<thead>
											<tr>
												<th>SR No.</th>
												<th>Employee Name</th>
												<th>Designation</th>
												<th>Join Date</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody id="tableDrag">
											<?php $n=1;
											foreach($employees as $employee): ?>
											<tr id="<?php echo $employee['id']; ?>">
												<td><?php echo '#'.$n; ?></td>
												<td><?php echo $employee['userName']; ?></td>
												<td><?php echo $employee['designation']; ?></td>
												<td><?php echo $employee['joinDate']; ?></td>
												<td>
													<?php if($employee['isActive']==1) { ?>
													<img src="<?php echo $this->Url->build('/img/success.png'); ?>" class="status-image" />
													<?php } else { ?>
													<img src="<?php echo $this->Url->build('/img/cross.png'); ?>" class="status-image" />
													<?php } ?>
												</td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/Employees/edit/'.base64_encode($employee['id'])); ?>" class="btn btn-info btn-xs gap-btn"><i class="fa fa-edit edit-tag-icon"></i> Edit</a>
													<a href="<?php echo $this->Url->build('/admin/Employees/view/'.base64_encode($employee['id'])); ?>" class="btn btn-success btn-xs gap-btn"><i class="fa fa-eye edit-tag-icon"></i> View</a>
													<a href="<?php echo $this->Url->build('/admin/Employees/delete/'.base64_encode($employee['id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to remove this Employee?')"><i class="fa fa-times edit-tag-icon"></i> Delete</a>
												</td>
											</tr>
											<?php $n++; endforeach ?>
											
										</tbody>
									</table>
								</div>
							</div>
							<!-- END TABLE HOVER -->
						</div>
					</div>
					
				</div>

<script type="text/javascript">
	$(document).ready(function() {
    	$('#competitionTable').DataTable();
    	$('#userTable_paginate').addClass('pull-right');
	});
</script>