<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div class="barra">
    <p>Bienvenid@: <?php echo $nombre." ".$apellido;?></p>

    <a class="boton" href="/logout">Cerrar Sessión</a>
</div>

<div id="app">

    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Paso 1</button>
        <button type="button" data-paso="2">Paso 2</button>
        <button type="button" data-paso="3">Paso 3</button>
    </nav>

    <div id="paso-1" class="seccion mostrar">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>
        
        <form class="formulario" action="">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" disabled value="<?=$nombre." ".$apellido;?>">
            </div>
            
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" min="<?= date('Y-m-d', strtotime('+1 day'));?>">
            </div>
            
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora" name="hora">
            </div>

            <input type="hidden" id="id" value="<?=$id;?>">
        </form>

    </div>
    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
        <div id="servicios" class="listado-servicios resumen"></div>
    </div>

    <!--
    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
        >
            &laquo; Anterior
        </button>
        <button
            id="siguiente"
            class="boton"
        >
            Siguiente &raquo;
        </button>
    </div>
    -->
</div>

<?php 
    $script = '
                <script src="./build/js/app.js"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              ';
?>