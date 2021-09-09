
<script>
$(document).ready(function(){
	$('.btn-exit-system').on('click', function(e){
		e.preventDefault();
		var Token = $(this).attr('href');
		swal({
		  	title: 'Estas Seguro?',
		  	text: "La plataforma se cerrá",
		  	type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#03A9F4',
		  	cancelButtonColor: '#F44336',
		  	confirmButtonText: '<i class="zmdi zmdi-run"></i> Si, Salir!',
		  	cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Cancelar!'
		}).then(function () {
			$.ajax({
				url:'<?php echo SERVERURL; ?>Ajax/loginAjax.php?token='+Token,
				success:function(data){
					if(data=="true") {
						
					}else{
						window.location.href="<?php echo SERVERURL; ?>login";
					}
				}
			});
		});
	});

});

</script>