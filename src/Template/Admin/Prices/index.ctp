				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Price List</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
                                <?php// pr($cities) ?>
                                <select name="city_id" id="filtercityid" onchange="cityfilter(this.value)" style="margin-left: 2px;" class="btn btn-info pull-right" >
                                <option value="">Filter by Zone</option>
                                <?php foreach ($cities as $key => $value) {?>
                                <option value="<?php echo $value['id'] ?>" <?php if(isset($city) && $value['id']==$city){echo 'selected';} ?> ><?php echo $value['name'] ?></option>
                                <?php }  ?>
                                </select>
                                <a href="<?php echo $this->Url->build(["controller"=>"Prices", "action"=>"add"]); ?>" class="btn btn-info pull-right add-tag-top"><i class="fa fa-plus"></i> Add New Price</a>
           
                                <div class="col-sm-6"></div>
									<table class="table table-hover table-bordered pt-2" id="competitionTable">
										<thead>
											<tr>
												<th>SR No.</th>
                                                <th>Zone</th>	
												<th>Service</th>											
												<th>Category</th>											
												<th>Price</th>
												<th>Size</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $n=1;
                                            foreach($prices as $price):  
                                            //pr($review)?>
											<tr>
                                                <td><?php echo '#'.$n; ?></td>
                                                <td><?php echo $price['city']['name']; ?></td>
                                                <td><?php echo $price['service']['title']; ?></td>
                                                <td><?php echo $price['category']; ?></td>
												<td>₦ <?php echo $price['price']; ?></td>
												<td><?php echo $price['size'].' '.$price['service']['unit']; ?></td>
												<td>
													<?php if($price['is_active']==1) { ?>
													<img src="<?php echo $this->Url->build('/img/success.png'); ?>" class="status-image" />
													<?php } else { ?>
													<img src="<?php echo $this->Url->build('/img/cross.png'); ?>" class="status-image" />
													<?php } ?>
												</td>
												<td>
                                                <a href="<?php echo $this->Url->build('/admin/Prices/edit/'.base64_encode($price['id'])); ?>" class="btn btn-info btn-xs gap-btn"><i class="fa fa-edit edit-tag-icon"></i> Edit</a>
                                                <a href="<?php echo $this->Url->build('/admin/Prices/status/'.base64_encode($price['id'])); ?>" class="btn btn-warning btn-xs gap-btn"> Change Status</a>
                                                <a href="<?php echo $this->Url->build('/admin/Prices/delete/'.base64_encode($price['id'])); ?>" class="btn btn-danger btn-xs gap-btn" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-times edit-tag-icon" ></i> Delete</a>
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
	function cityfilter(value){
		if(value){
			window.location.href='<?php echo $this->Url->build(["controller"=>"Prices", "action"=>"index"]); ?>?city='+value;
		}
	}
</script>