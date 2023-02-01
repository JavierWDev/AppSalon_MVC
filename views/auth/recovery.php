<h1>Recuperar Password</h1>


<?php if(!$error) :?>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>
<form class="formulario" method="POST">

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
    <label for="password">Contraseña</label>
    <input 
        type="password"
        id="password"
        name="password"
        placeholder="Tu nueva contraseña"
    />
</div>
<input type="submit" class="boton" value="Actualizar Contraseña">
</form>

<div class="acciones">
    <a href="/">Ya te acordaste? Inicia sesión</a>
</div>

<?php endif;?>

<?php if($error) : ?>
    <p class="descripcion-pagina">No se ha encontrado a ese usuario</p>

    <div class="acciones">
        <a href="/">Regresar a la ventana de login</a>
    </div>
<?php endif;?>

