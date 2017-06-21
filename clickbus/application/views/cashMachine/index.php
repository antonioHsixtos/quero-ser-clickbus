<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-2"></div>
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12">
					<h2>Welcome User</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<form role="form" class="form-inline">
						<div >
							<label><h4>Select an amount: </h4></label>
								<div class="input-group mb-2 mr-sm-2 mb-sm-0">
								    <div class="input-group-addon">$</div>
							        <input id="amount" name="amount" class="form-control" type="number" placeholder="Amount" />
							  	</div>
							<button type="button" class="btn btn-primary"  id="get_money">Get Cash</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<hr /><br />
					<div id="content-data"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-2"></div>
	</div>
</div>
<script type="text/javascript">
	
	$(document).on('click', '#get_money', function(event) {
		event.preventDefault ? event.preventDefault() : event.returnValue = false;	
		var val    = $('#amount').val();
		var expreg = new RegExp('^\\d+$');
		if(val!='' || val!=null){
			if(expreg.test(val)){
				$('#content-data').html("Valor correcto");
				$.ajax({
				      url: "<?php echo base_url(); ?>cashMachine/calculate",
				      method: "POST",
				      data:{
				      	amount : val
				      }
				})
				.done(function( msg ) {
				    $('#content-data').html(msg);
				});
			}else{
				$('#content-data').html("Invalid Argument Exception");
			}
			
		}else{
			$('#content-data').html("Empty Set");

		}
	});
	



</script>