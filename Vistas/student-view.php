
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Users <small>Student</small></h1>
			</div>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
		</div>
		<div class="container-fluid">
<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">New</a></li>
					  	<li><a href="#list" data-toggle="tab">List</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form autocomplete="off" enctype="multipart/form-data" class="FormularioAjax" action="<?php echo SERVERURL;?>Ajax/administradorAjax.php" method="POST" data-form="save">

									    	<div class="form-group label-floating">
											  <label class="control-label">Id del Estudiante</label>
											  <input required=""  name="Id" class="form-control" type="text">
												
											</div>

									    	<div class="form-group label-floating">
											  <label class="control-label">Nombre</label>
											  <input required=""  name="NombreE" class="form-control" type="text">
												
											</div>

											<div class="form-group label-floating">
											  <label class="control-label">Apellido Paterno</label>
											  <input required=""  name="ApellidoP" class="form-control" type="text">
											</div>

											<div class="form-group label-floating">
											  <label class="control-label">Apellido Materno</label>
											  <input required=""  name="ApellidoM" class="form-control" type="text">
											</div>
										

											<div class="form-group label-floating">
											  <label class="">Sexo</label>
											  <input name="Sexo" required="" class="form-control" type="email">
											</div>

											<div class="form-group label-floating">
											  <label class="">Fecha Nacimiento</label>
											  <input name="FechaNa" required="" class="form-control" type="Date" onchange="calculateAge(this.value);">
											</div>

											<div class="form-group label-floating">
											  <label class="">Edad</label>
											  <input name="Edad" disabled required="" id="Edad" class="form-control" type="number">
											</div>

												<div class="form-group label-floating">
											  <label class=""></label>
											  <input name="CPassword" required="" class="form-control" type="Password">
											</div>
									
										    <p class="text-center">
										    	<button type="submit" class="btn btn-info btn-raised"><i class="zmdi zmdi-floppy"></i> Save</button>
												</p>
												<div class="RespuestaAjax"></div>
									    </form>
									</div>
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Name</th>
											<th class="text-center">Last Name</th>
											<th class="text-center">Address</th>
											<th class="text-center">Email</th>
											<th class="text-center">Phone</th>
											<th class="text-center">Birthday</th>
											<th class="text-center">Gender</th>
											<th class="text-center">Type</th>
											<th class="text-center">Section</th>
											<th class="text-center">Update</th>
											<th class="text-center">Delete</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Carlos</td>
											<td>Alfaro</td>
											<td>El Salvador</td>
											<td>carlos@gmail.com</td>
											<td>+50312345678</td>
											<td>07/03/1997</td>
											<td>Male</td>
											<td>Old</td>
											<td>Section</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>2</td>
											<td>Alicia</td>
											<td>Melendez</td>
											<td>El Salvador</td>
											<td>alicia@gmail.com</td>
											<td>+50312345678</td>
											<td>07/07/1990</td>
											<td>Female</td>
											<td>New</td>
											<td>Section</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>3</td>
											<td>Sarai</td>
											<td>Mercado</td>
											<td>El Salvador</td>
											<td>sarai@gmail.com</td>
											<td>+50312345678</td>
											<td>09/09/1991</td>
											<td>Female</td>
											<td>Old</td>
											<td>Section</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>4</td>
											<td>Alba</td>
											<td>Bonilla</td>
											<td>El Salvador</td>
											<td>alba@gmail.com</td>
											<td>+50312345678</td>
											<td>01/10/1993</td>
											<td>Female</td>
											<td>New</td>
											<td>Section</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
									</tbody>
								</table>
								<ul class="pagination pagination-sm">
								  	<li class="disabled"><a href="#!">«</a></li>
								  	<li class="active"><a href="#!">1</a></li>
								  	<li><a href="#!">2</a></li>
								  	<li><a href="#!">3</a></li>
								  	<li><a href="#!">4</a></li>
								  	<li><a href="#!">5</a></li>
								  	<li><a href="#!">»</a></li>
								</ul>
							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	
<script type="text/javascript">
	
	function calculateAge(birthday) {
    var birthday_arr = birthday.split("-");
    var birthday_date = new Date(birthday_arr[0], birthday_arr[1] - 1, birthday_arr[2]);
    var ageDifMs = Date.now() - birthday_date.getTime();
    var ageDate = new Date(ageDifMs);
    
    var a = Math.abs(ageDate.getUTCFullYear() - 1970);

    document.getElementById('Edad').value = a;


}
</script>

</body>
</html>