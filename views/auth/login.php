<h1 class="login-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesion con tus datos</p>

<!-- mostrar alertas -->
<?php 
    if(!empty($alertas)){
        foreach ($alertas as $key => $alerta) {
            echo "<p class='alerta'>$alerta</p>";
        }
    }
?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email">
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu Contraseña" name="password">
    </div>

    <input type="submit" value="Iniciar Sesion" class="boton">
</form>

<div class="acciones">
    <a href="/create">¿Aún no tienes una cuenta? Crea una</a>
    <a href="/forgotpw">¡Olvidaste tu contraseña?</a>
</div>