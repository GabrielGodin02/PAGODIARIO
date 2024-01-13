<?php
$fecha = $reporte ? new DateTime($reporte["create_time"]) : new DateTime();
$time = new DateTime();
$meses = [
    "01" => "Enero",
    "02" => "Febrero",
    "03" => "Marzo",
    "04" => "Abril",
    "05" => "Mayo",
    "06" => "Junio",
    "07" => "Julio",
    "08" => "Agosto",
    "09" => "Septiembre",
    "10" => "Octubre",
    "11" => "Noviembre",
    "12" => "Diciembre"
]
?>
<main>
    <h3 class="vista-titulo">Reporte del mes</h3>
    <div class="row">
        <div class="card col-9 p-0">
            <?php if ($reporte) { ?>
                <div class="card-header">
                    <div class="fs-2"> <?php echo $fecha->format("Y") ?> - <?php echo $fecha->format("m") ?></div>
                </div>
                <div class="card-body fs-4">
                    <span class="fs-3"><?php echo $reporte["pagodiario"] ?></span>
                    <div>Prestamos Solicitados: <?php echo $reporte["solicitudes"] ?></div>
                    <div>Aceptados: <?php echo $reporte["aceptados"] ?></div>
                    <div>Rechazados: <?php echo $reporte["rechazados"] ?></div>
                    <div>Completados: <?php echo $reporte["completados"] ?></div>
                    <div>Total prestada en el Mes: <?php echo $reporte["total"] ?></div>
                    <div class="text-<?php echo ($reporte["balance"] > 0) ? 'success' : (($reporte["balance"] < 0) ? 'danger' : 'primary') ?>">
                    Balance del mes: <?php echo (($reporte["balance"] > 0 ? '+' : '') . $reporte["balance"]) ?>
                    </div>
                </div>
                <div class="card-footer text-end"><button class="btn btn-primary"><i class="fa fa-download"></i></button></div>
            <?php } else { ?>
                <div class="position-absolute top-50 start-50 translate-middle">
                    <?php NoRegistrosComponent() ?>
                </div>
            <?php } ?>
        </div>
        <ul class="card col-3 p-0 list-group">
            <form action="" method="GET">
                <div class="card-header">Historial</div>
                <ul class="list-group-horizontal list-group fs-4 row mx-0">
                    <li class="
                        list-group-item 
                         col-6">
                        <input <?php if ((isset($_GET["date_year"]) && $_GET["date_year"] == $fecha->format("Y") - 1)) echo "checked" ?> type="radio" id="lastYear" name="date_year" value="<?php echo $fecha->format("Y") - 1 ?>" class="
                        form-check-input me-1">
                        <label class="form-check-label" for="lastYear">
                            <?php echo $fecha->format("Y") - 1 ?>
                        </label>
                    </li>
                    <li class="
                        list-group-item 
                        col-6">
                        <input <?php if ((isset($_GET["date_year"]) && $fecha->format("Y") == $_GET["date_year"]) || !isset($_GET["date_year"])) echo "checked" ?> type="radio" id="currYear" name="date_year" value="<?php echo $fecha->format("Y") ?>" class="
                        form-check-input me-1">
                        <label class="form-check-label" for="currYear">
                            <?php echo $fecha->format("Y") ?>
                        </label>
                    </li>
                </ul>
                <?php foreach ($meses as $key => $mes) { ?>
                    <button class="
                        list-group-item 
                        <?php if ((isset($_GET["date_month"]) && $key == $_GET["date_month"]) || (!isset($_GET["date_month"]) && $fecha->format("m") == $key)) echo 'active' ?> 
                        list-group-item-action" name="date_month" value="<?php echo $key ?>">
                        <?php echo $mes ?>
                    </button>
                <?php } ?>
            </form>
        </ul>
    </div>
</main>