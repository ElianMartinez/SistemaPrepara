<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
			<?php echo COMPANY; ?> <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="<?php echo SERVERURL; ?>/Vistas/assets/img/<?php echo $_SESSION['foto_sep'];  ?>" alt="UserIcon">
					<figcaption class="text-center text-titles"><?php echo $_SESSION['Nombre']; ?></figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="<?php echo $lc->encryption($_SESSION['token_sep']); ?>" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="<?php echo SERVERURL; ?>home/">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Inicio
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administration <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="<?php echo SERVERURL; ?>period/"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Period</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>asignatura/"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Asignatura</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>Sesion/"><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Sección</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>MatriculacionSeccion/"><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Matriculación de Sección</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>grado/"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Grado</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Users <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="<?php echo SERVERURL; ?>admin/"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Admin</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>teacher/"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Teacher</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>student/"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Student</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>representative/"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Representative</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Payments <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="<?php echo SERVERURL; ?>BEstudiante/"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Buscar Estudiantes</a>
						</li>
						<li>
							<a href="<?php echo SERVERURL; ?>SeccionACTIVE/"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Matricular</a>
						</li>
					</ul>
				</li>

				<li >
					<a  href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Notas  <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li >
							<a  href="<?php echo SERVERURL; ?>Boletin/"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>Boletin</a>
						</li>

						<li>
							<a href="<?php echo SERVERURL; ?>NotaAsignatura/"><i class="zmdi zmdi-library zmdi-hc-fw"></i>Nota por Asignatura</a>
						</li>


						<li>
							<a href="<?php echo SERVERURL; ?>ActaNota/"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Acta de Nota</a>
						</li>

						<li>
							<a href="<?php echo SERVERURL; ?>RecordNota/"><i class="zmdi zmdi-balance zmdi-hc-caret"></i> Record de Nota</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> Configuración Escolar <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="<?php echo SERVERURL; ?>school/"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> School Data</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</section>