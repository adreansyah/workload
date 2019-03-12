<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-2 col-md-offset-5">
				<div class="box box-widget box-solid box-info with-border">
            <div class="box-body">
							<div class="text-center">
								<a href="<?php echo site_url('create-workload');?>" class="btn btn-info btn-primary"><i class="fa fa-edit"></i> Create Workload</a>
							</div>
						</div>
        </div>
			</div>
			<div class="col-md-12">
				<div class="box box-solid box-info with-border">
					<div class="box-body">
						<div id="gant"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
