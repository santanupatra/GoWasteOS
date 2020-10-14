				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Client List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<a href="<?php echo $this->Url->build(["controller"=>"clients", "action"=>"add"]); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Add New Client</a>
									<table class="table table-hover table-bordered pt-2" id="competitionTable">
										<thead>
											<tr>
												<th>Logo</th>
												<th>Name</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $n=1;
											foreach($clients as $client): ?>
											<tr>
												<td><img src="<?php echo $this->Url->build('/'.$client['logo']); ?>" class="status-image" /></td>
												<td><?php echo $client['name']; ?></td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/clients/edit/'.base64_encode($client['id'])); ?>" class="btn btn-info btn-xs gap-btn"><i class="fa fa-edit edit-tag-icon"></i> Edit</a>
													<a href="<?php echo $this->Url->build('/admin/clients/delete/'.base64_encode($client['id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to remove this Client?')"><i class="fa fa-times edit-tag-icon"></i> Delete</a>
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
    	// $('#competitionTable').DataTable({
    	// 	"paging": false,
	    //     "info": false
    	// });
    	// $('#userTable_paginate').addClass('pull-right');
	});
</script>