				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Contact List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<table class="table table-hover table-bordered pt-2">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Mobile</th>
												<th>Email</th>
												<th>Comment</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											<?php $n=1; foreach($results as $result): ?>
											<tr>
												<td><?php echo $n; ?></td>
												<td><?php echo $result['firstName'].' '.$result['lastName']; ?></td>
												<td><?php echo $result['phoneNumber']; ?></td>
												<td><?php echo $result['email']; ?></td>
												<td><?php echo $result['comment']; ?></td>
												<td><?php echo date('d M, Y', strtotime($result['createdDate'])); ?></td>
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