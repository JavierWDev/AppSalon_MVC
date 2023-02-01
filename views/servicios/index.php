<h1>Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<div class="barra">
    <a class="boton" href="/logout">Cerrar Sessión</a>
</div>

<div class="barra-servicios">
    <a href="/admin" class="boton">Ver Citas</a>
    <a href="/servicios" class="boton">Ver Servicios</a>
    <a href="/servicios/crear" class="boton">Nuevo Servicio</a>
</div>

<ul class="servicios">
    <?php foreach ($servicios as $servicio) : ?>
        <li>
            <p>Nombre: <span><?= $servicio->nombre; ?></span></p>
            <p>Precio: <span><?= $servicio->precio; ?></span></p>

            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?= $servicio->id?>">Actualizar</a>

                <form action="/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?= $servicio->id?>">
                    <input type="submit" class="boton-eliminar" value="Borrar">
                </form>

            </div>
        </li>
    <?php endforeach; ?>
</ul>