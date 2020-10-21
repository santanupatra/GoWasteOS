				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Service List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
                                <a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Add New Service</a>
									<table class="table table-hover table-bordered pt-2" id="competitionTable">
										<thead>
											<tr>
                                                <th>SR No.</th>
												<th>Icon</th>
												<th>Title</th>
												<th>Content</th>
												<th>Price</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $n=1;
											foreach($services as $service): ?>
											<tr>
                                                <td><?php echo '#'.$n; ?></td>
                                                <td>
                                                    <?php if ($service['image'] != '') { ?>
                                                    <img src="<?php echo $this->Url->build('/'.$service['image']); ?>" class="status-image" />
                                                    <?php } else { ?>
                                                    <img src="<?php echo $this->Url->build('/service_image/no-image.png'); ?>"  class="status-image">
                                                    <?php } ?>
                                                </td>
												<td><?php echo $service['title']; ?></td>
												<td><?php echo $service['content']; ?></td>
												<td>₵<?php echo $service['price']; ?></td>
												<td>
                                                    <?php if($service['isActive']==1) { ?>
													<img src="<?php echo $this->Url->build('/img/success.png'); ?>" class="status-image" />
													<?php } else { ?>
													<img src="<?php echo $this->Url->build('/img/cross.png'); ?>" class="status-image" />
													<?php } ?>
                                                </td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/Services/edit/'.base64_encode($service['id'])); ?>" class="btn btn-info btn-xs gap-btn"><i class="fa fa-edit edit-tag-icon"></i> Edit</a>
                                                    <a href="<?php echo $this->Url->build('/admin/Services/status/'.base64_encode($service['id'])); ?>" class="btn btn-warning btn-xs gap-btn"> Change Status</a>
													<a href="<?php echo $this->Url->build('/admin/Services/delete/'.base64_encode($service['id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to delete this Service?')"><i class="fa fa-times edit-tag-icon" ></i> Delete</a>
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