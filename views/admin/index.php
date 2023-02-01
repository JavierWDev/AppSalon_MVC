<h1 class="nombre-pagina">Panel de Administración</h1>

<div class="barra">
    <p>Bienvenid@: <?php echo $nombre;?></p>

    <a class="boton" href="/logout">Cerrar Sessión</a>
</div>

<div class="barra-servicios">
    <a href="/admin" class="boton">Ver Citas</a>
    <a href="/servicios" class="boton">Ver Servicios</a>
    <a href="/servicios/crear" class="boton">Nuevo Servicio</a>
</div>

<div class="busqueda">
    <h2>Buscar Citas</h2>
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?=$fecha;?>">
        </div>
    </form>
</div>

<div id="citas-admin">
    <?php echo $citas === [] ? "<h2>No hay citas en esta fecha</h2>": ""?>
    <ul class="citas">
        <?php $idCita = 0;?>
        <?php if($citas !== []): ?>
            <?php foreach ($citas as $key => $cita) : ?>
                <?php 
                    if($idCita !== $cita->id):  
                    $idCita = $cita->id;
                    $total = 0;
                ?>

                    <li>
                        <p>Id: <span><?= $cita->id; ?></span></p>
                        <p>Cliente: <span><?= $cita->cliente; ?></span></p>
                        <p>Email: <span><?= $cita->email; ?></span></p>
                        <p>Telefono: <span><?= $cita->telefono; ?></span></p>
                        <p>Hora: <span><?= $cita->hora; ?></span></p>

                        <h3>Servicios</h3>
                
                <?php endif; ?>
                    <p class="servicio"><?= $cita->servicio. " " . $cita->precio; ?></p>

                <?php 
                    $actual = $cita->id;
                    $proximo = $citas[$key + 1]->id ?? 0;
                    $total += $cita->precio;
                    if($actual !== $proximo){
                        echo "<p>Total: <span>$$total</span></p>";
                        $formulario = "<form method='POST' action='/api/eliminar'>";
                        $formulario .= "<input type='hidden' name='id' value='$cita->id'>";
                        $formulario .= "<input type='submit' class='boton-eliminar' value='Eliminar Cita'>";
                        echo $formulario;
                    }
                ?>
                
            <?php endforeach;?>
        <?php endif; ?>
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>";
?>