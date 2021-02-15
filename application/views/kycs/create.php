<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload Kyc</title>
	<?php $this->load->view("includes/header.php") ?>
	<link rel="stylesheet" href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css" >
</head>

<body id="page-top">
	<div id="content-wrapper">
		<div class="container">
			<div class="card mb-3 mt-5">
				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php endif; ?>
				<div class="card-header">
					<h4>Input Your Identity</h4>
				</div>
				<div class="card-body">
					<form action="<?php echo site_url('kyc/store') ?>" method="post" enctype="multipart/form-data" >
<!--					--><?php //echo form_open_multipart('kyc/store');?>
						<div class="form-group">
							<label for="name">No Ktp*</label>
							<input class="form-control <?php echo form_error('Nomor Ktp') ? 'is-invalid':'' ?>"
								   type="number" name="no_ktp" placeholder="16 number" required />
							<div class="invalid-feedback">
								<?php echo form_error('Nomor Ktp') ?>
							</div>
						</div>

						<input type="text" name="user_id" value="3" readonly/>

						<div class="form-group">
							<label for="name">Foto Ktp*</label>
							<div class="well" data-bind="fileDrag: fileData">
								<div class="form-group row">
									<div class="col-md-6">
										<img style="height: 125px;" class="img-rounded  thumb" data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
										<div data-bind="ifnot: fileData().dataURL">
											<label class="drag-label">Drag file here</label>
										</div>
									</div>
									<div class="col-md-6">
										<input type="file" name="foto_ktp" data-bind="fileInput: fileData, customFileInput: {
              buttonClass: 'btn btn-success',
              fileNameClass: 'disabled form-control',
              onClear: onClear,
            }" accept="image/*">
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="name">Foto Selfie*</label>
							<div class="well" data-bind="fileDrag: fileDataTwo">
								<div class="form-group row">
									<div class="col-md-6">
										<img style="height: 125px;" class="img-rounded  thumb" data-bind="attr: { src: fileDataTwo().dataURL }, visible: fileDataTwo().dataURL">
										<div data-bind="ifnot: fileDataTwo().dataURL">
											<label class="drag-label">Drag file here</label>
										</div>
									</div>
									<div class="col-md-6">
										<input type="file" name="foto_selfie" data-bind="fileInput: fileDataTwo, customFileInput: {
              buttonClass: 'btn btn-success',
              fileNameClass: 'disabled form-control',
              onClear: onClear,
            }" accept="image/*">
									</div>
								</div>
							</div>
						</div>

						<input class="btn btn-success" type="submit" name="btn" value="Submit" />
					</form>

				</div>

				<div class="card-footer small text-danger">
					* required fields
				</div>

	<?php $this->load->view("includes/footer.php") ?>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js"></script>
				<script src="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.js"></script>
				<script>
					$(function(){
						var viewModel = {};
						viewModel.fileData = ko.observable({
							dataURL: ko.observable(),
							// base64String: ko.observable(),
						});
						viewModel.fileDataTwo = ko.observable({
							dataURL: ko.observable(),
							// base64String: ko.observable(),
						});


						viewModel.onClear = function(fileData){
							if(confirm('Are you sure?')){
								fileData.clear && fileData.clear();
							}
						};
						viewModel.debug = function(){
							window.viewModel = viewModel;
							console.log(ko.toJSON(viewModel));
							debugger;
						};
						ko.applyBindings(viewModel);
					});
				</script>
</body>
</html>
