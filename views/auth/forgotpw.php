<h1 class="login-pagina">Olvide mi contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña escribiendo tu email a continuacion</p>

<form action="/forgotpw" method="POST" class="formulario">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu email">
    </div>

    <input type="submit" value="Recuperar Contraseña" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/forgotpw">¿No tienes una cuenta? Create una</a>
</div>