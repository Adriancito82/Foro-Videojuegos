<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<?php
    $categoria_actual = conseguirCategoria($db, $_GET['id']);
    if(!isset($categoria_actual['id'])) {
        header("Location: index.php");
    }
?>

<?php require_once 'includes/cabecera.php'; ?>

 <?php require_once 'includes/lateral.php'; ?>

            <div id="principal">
                <h1>Entradas de <?=$categoria_actual['nombre']?></h1>

                <?php
                    $entradas = conseguirEntradas($db, null, $_GET['id']);
                    if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
                        while($entrada = mysqli_fetch_assoc($entradas)):
                ?>

                    <article class="entrada">
                        <a href="entrada.php?id=<?=$entrada['id']?>">
                        <h2><?=$entrada['titulo']?></h2>
                            <span class="fecha"><?= $entrada['categoria'].' | '.$entrada['fecha']?></span>
                        </a>

                        <p>
                            <?=substr($entrada['descripcion'], 0, 180). '...'?>
                        </p>
                    </article>

                <?php
                    endwhile;
                    else:
                ?>
                <div class="alerta-error">No hay entradas en esta categoría</div>
                <?php
                    endif;
                ?>

                <div id="ver-todas">
                    <a href="index.php">Ver últimas entradas</a>
                </div>

            </div>

<?php require_once 'includes/pie.php'; ?>
