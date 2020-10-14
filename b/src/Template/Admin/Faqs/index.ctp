				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">FAQ List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<a href="<?php echo $this->Url->build(["controller"=>"Faqs", "action"=>"add"]); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Add New FAQ</a>
									<table class="table table-hover table-bordered pt-2" id="competitionTable">
										<thead>
											<tr>
												<th>SR No.</th>
												<th>List Order</th>
												<th>Question</th>
												<th>Answer</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody id="tableDrag">
											<?php $n=1;
											foreach($faqs as $faq): ?>
											<tr id="<?php echo $faq['id']; ?>">
												<td><?php echo '#'.$n; ?></td>
												<td><?php echo $faq['listOrder']; ?></td>
												<td><?php echo $faq['question']; ?></td>
												<td><?php echo $faq['answer']; ?></td>
												<td>
													<?php if($faq['isActive']==1) { ?>
													<img src="<?php echo $this->Url->build('/img/success.png'); ?>" class="status-image" />
													<?php } else { ?>
													<img src="<?php echo $this->Url->build('/img/cross.png'); ?>" class="status-image" />
													<?php } ?>
												</td>
												<td>
													<a href="<?php echo $this->Url->build('/admin/faqs/edit/'.base64_encode($faq['id'])); ?>" class="btn btn-info btn-xs gap-btn"><i class="fa fa-edit edit-tag-icon"></i> Edit</a>
													<a href="<?php echo $this->Url->build('/admin/faqs/view/'.base64_encode($faq['id'])); ?>" class="btn btn-success btn-xs gap-btn"><i class="fa fa-eye edit-tag-icon"></i> View</a>
													<a href="<?php echo $this->Url->build('/admin/faqs/delete/'.base64_encode($faq['id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to remove this FAQ?')"><i class="fa fa-times edit-tag-icon"></i> Delete</a>
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

    	$('#tableDrag').sortable({
			delay: 150,
	        stop: function() {
	            var selectedData = new Array();
	            $('#tableDrag>tr').each(function() {
	                selectedData.push($(this).attr("id"));
	            });
	            updateOrder(selectedData);
	        }
		});

		function updateOrder(data) {
        	console.log(data);
        	$.ajax({
        		url: "<?php echo $this->Url->build('/'); ?>admin/faqs/ajaxChangeOrder",
        		type: "post",
        		data: {data: data},
        		dataType: "json",
        		success: function(data){
        			console.log(data);
        		}
        	});
    	}
	});
</script>