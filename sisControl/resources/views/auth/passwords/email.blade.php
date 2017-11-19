<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ config('app.name', 'MegaSystem') }} | Restablecer contraseña </title>
    
    <!-- Bootstrap -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">

</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
				{!! BootForm::open(['url' => url('/password/email'), 'method' => 'post']) !!}
				<h1>Contraseñas</h1>
                
				{!! BootForm::email('email', 'Correo electrónico', old('email'), ['placeholder' => 'nombre@ejemplo.com']) !!}
					
				{!! BootForm::submit('Restablecer contraseña', ['class' => 'btn btn-primary btn-block', 'style' => 'margin-left: 0px;']) !!}
                <div class="clearfix"></div>
				<br/>	
				<div class="separator">
					<p class="change_link">Tienes contraseña?
						<a href="{{ url('/login') }}" class="to_register"> Iniciar sesión </a>
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