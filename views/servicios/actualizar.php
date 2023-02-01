<h1>Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

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

<form method="POST" class="formulario">

    <?php
        include_once __DIR__ . '/formulario.php';
    ?>

    <input type="submit" class="boton" value="Actualizar Servicio">
</form>