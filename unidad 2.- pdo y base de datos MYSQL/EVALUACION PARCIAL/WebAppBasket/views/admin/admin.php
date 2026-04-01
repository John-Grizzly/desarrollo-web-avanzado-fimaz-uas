<?php
require_once __DIR__ . "/template/header.php";
?>

<div class="text-center mb-3">
    <span class="text-muted">Alumno:</span>
    <strong>Jonathan García</strong>
</div>

<div class="card text-center">

    <div class="card-header">
        MENÚ
    </div>

    <div class="card-body">
        <div class="row mb-3">

            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        CREAR TORNEO
                    </div>
                    <div class="card-body">
                        <a href="frmTorneos.php" class="btn btn-primary">
                            <img src="img/torneo-admin.png" alt="Crear un torneo." class="img-fluid rounded shadow" width="180" height="180">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        LISTA DE TORNEOS
                    </div>
                    <div class="card-body">
                        <a href="readAllTorneos.php" class="btn btn-primary">
                            <img src="img/lista-torneos-admin.png" alt="Listar torneos." class="img-fluid rounded shadow" width="180" height="180">
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        ESTADISTICAS
                    </div>
                    <div class="card-body">
                        <img src="img/estadisticas.png" alt="Estadísticas" class="img-fluid rounded shadow" width="180" height="180">
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        ANUNCIOS
                    </div>
                    <div class="card-body">
                        <img src="img/anuncios.png" alt="Anuncios" class="img-fluid rounded shadow" width="180" height="180">
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="card-footer text-body-secondary">
        Configuración de torneos. Web App Basket-Ball.
    </div>

</div>

<?php
require_once __DIR__ . "/template/footer.php";
?>