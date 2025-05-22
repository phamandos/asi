<html>
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	<style>
		.jarak{
			padding : 10px;
			margin : auto 10px;
			border-bottom : 1px solid #000;
		}
		.main{
			background : #6e62e4;
			margin : 10px auto;
		}
	</style>
	<body>
		<div class="main">
			<form method="post" action="" id="formmain">
				<input type="hidden" name="mode" value="add">
				<input type="hidden" name="id" id="id">
				<div class="jarak">
					<label>Name</label>
					<input type="text" name="name">
				</div>
				<div class="jarak">
					<label>Is Project?</label>
					<input type="checkbox" name="isproject" value="1">
				</div>
				<div class="jarak">
					<label>Self Capture</label>
					<input type="text" name="self_capture">
				</div>
				<div class="jarak">
					<label>CLient Prefix</label>
					<input type="text" name="client_prefix">
				</div>
				<div class="jarak">
					<label>Client Logo</label>
					<input type="text" name="client_logo">
				</div>
				<div class="jarak">
					<label>Address</label>
					<input type="text" name="address">
				</div>
				<div class="jarak">
					<label>Phone Number</label>
					<input type="text" name="phone_number">
				</div>
				<div class="jarak">
					<select name="city">
						<option>--Choose City --</option>
						<option value="Jakarta">Jakarta</option>
						<option value="Surabaya">Surabaya</option>
						<option value="Bandung">Bandung</option>
						<option value="Aceh">Aceh</option>
					</select>
				</div>
				<div class="jarak">
					<button type="submit">Save</button>
					<button type="button" id="edit">Edit</button>
					<button type="button" id="delete">Delete</button>
				</div>
			</form>
		</div>
		
	</body>
	<script>
		$(document).ready(function(){
			$("button #edit").click(function(){
				$("#id").val('edit');
			});
		  
			$("button #delete").click(function(){
				$("#id").val('delete');
			});
		  
			$('#formmain').on('submit',function(e){
				e.preventDefault();
				var form = $(this);
				var inputs = form.find("input, select, button, textarea");
				var serializedData = form.serialize();
				request = $.ajax({
					url: "control.php/save",
					type: "post",
					data: {ps:JSON.stringify(serializedData)};
				});
				request.done(function (response, textStatus, jqXHR){
					console.log(response);
				});
			})
		});
	</script>
</html>
