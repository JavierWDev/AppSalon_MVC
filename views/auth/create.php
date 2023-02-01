<?php //debuguear($usuario); 
?>

<h1 class="login-pagina">Crear una cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<form action="/create" method="POST" class="formulario">

    <!-- mostrar alertas -->
    <?php if ($alertas !== []) : ?>
        <?php foreach ($alertas as $key => $alerta) : ?>
            <?php
            if ($key === "error") {
                foreach ($alerta as $errores => $error) {
                    echo "<p class='alerta'>$error</p>";
                }
            }else{
                echo "<p class='alerta'>$alerta</p>";
            }
            ?>
        <?php endforeach; ?>
    <?php endif; ?>

    

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?= s($usuario->nombre) ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" value="<?= s($usuario->apellido) ?>">
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Tu telefono" value="<?= s($usuario->telefono) ?>">
    </div>

    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu email" value="<?= s($usuario->email) ?>">
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Tu contraseña">
    </div>

    <input type="submit" value="Crear cuenta" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/forgotpw">¡Olvidaste tu contraseña?</a>
</div>