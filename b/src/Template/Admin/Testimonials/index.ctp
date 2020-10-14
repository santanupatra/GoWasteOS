				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Testimonial List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<a href="<?php echo $this->Url->build(["controller"=>"Testimonials", "action"=>"add"]); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Add New testimonial</a>
									<table class="table table-hover table-bordered pt-2">
										<thead>
											<tr>
												<th>SR No.</th>
												<th>Title</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody id="tableDrag">
											<?php $n=1;
											foreach($testimonials as $testimonial): ?>
											<tr>
												<td><?php echo '#'.$n; ?></td>
												<td><?php echo $testimonial['title']; ?></td>
												<td>
													<?php if($testimonial['isActive']==1) { ?>
													<img src="<?php echo $this->Url->build('/img/success.png'); ?>" class="status-image" />
													<?php } else { ?>
													<img src="<?php echo $this->Url->build('/img/cross.png'); ?>" class="status-image" />
													<?php } ?>
												</td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/testimonials/edit/'.base64_encode($testimonial['id'])); ?>" class="btn btn-info btn-xs gap-btn"><i class="fa fa-edit edit-tag-icon"></i> Edit</a>
													<a href="<?php echo $this->Url->build('/admin/testimonials/delete/'.base64_encode($testimonial['id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to remove this Testimonial?')"><i class="fa fa-times edit-tag-icon"></i> Delete</a>
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