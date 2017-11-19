<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<title>{{ config('app.name', 'MegaSystem') }} | Inicio de Sesión </title>
    
    <!-- Bootstrap -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">

</head>

<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
				{!! BootForm::open(['url' => url('/login'), 'method' => 'post']) !!}
                    
				<h1>Iniciar sesión</h1>
			
				{!! BootForm::email('email', 'Correo electrónico', old('email'), ['placeholder' => 'nombre@ejemplo.com', 'afterInput' => '<span>test</span>'] ) !!}
			
				{!! BootForm::password('password', 'Contraseña', ['placeholder' => 'Password']) !!}
				
				<div>
					{!! BootForm::submit('Log in', ['class' => 'btn btn-primary btn-block submit', 'style' => 'margin-left: 0px;']) !!}
					<a class="reset_pass" href="{{  url('/password/reset') }}" style="margin-left: 0px;">Perdiste tu contraseña?</a>
				</div>
                    
				<div class="clearfix"></div>
                    
				<div class="separator">
					<p class="change_link">Nuevo en el sitio?
						<a href="{{ url('/register') }}" class="to_register"> Crear cuenta </a>
					</p>
                        
					<div class="clearfix"></div>
					<br />
                        
					<div>
						<h1><i class="fa fa-gg-circle"></i> MegaSystem</h1>
						<p>©2017 iso2MegaSystem - Branch [sisControl]</p>
					</div>
				</div>
				{!! BootForm::close() !!}
            </section>
        </div>
    </div>
</div>
</body>
</html>