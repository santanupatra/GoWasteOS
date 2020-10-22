				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Review List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
                                <div class="col-sm-6"></div>
                                <!-- <a href="<?php echo $this->Url->build(["controller"=>"Reviews", "action"=>"add"]); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Add New Review</a> -->
									<table class="table table-hover table-bordered pt-2" id="competitionTable">
										<thead>
											<tr>
												<th>SR No.</th>
												<th>Review Given To</th>
												<th>Review Given By</th>
												<th>Rating</th>
												<th>Date</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $n=1;
                                            foreach($reviews as $review):  
                                            //pr($review)?>
											<tr>
                                                <td><?php echo '#'.$n; ?></td>
                                                <td><?php echo $review['reviewd']['firstName'].' '.$review['reviewd']['lastName']; ?></td>
												<td><?php echo $review['reviewer']['firstName'].' '.$review['reviewer']['lastName']; ?></td>
												<td><?php echo $review['rating']; ?></td>
												<td><?php echo gmdate('M d, Y h:i A',strtotime($review['created_date'])); ?></td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/Reviews/view/'.base64_encode($review['id'])); ?>" class="btn btn-success btn-xs gap-btn"><i class="fa fa-eye edit-tag-icon"></i> View</a>
													<a href="<?php echo $this->Url->build('/admin/Reviews/delete/'.base64_encode($review['id']).'/'.base64_encode($review['to_id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to delete this Review?')"><i class="fa fa-times edit-tag-icon" ></i> Delete</a>
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