<?php require_once 'includes/cabecera.php'; ?>

 <?php require_once 'includes/lateral.php'; ?>

            <div id="principal">
                <h1>Todas las entradas</h1>

                <?php
                    $entradas = conseguirEntradas($db, null);
                    if(!empty($entradas)):
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
                    endif;
                ?>

                <div id="ver-todas">
                    <a href="index.php">Ver últimas entradas</a>
                </div>

            </div>

<?php require_once 'includes/pie.php'; ?>
