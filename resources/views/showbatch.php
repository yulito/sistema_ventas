<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>
    
    <div>
        <a href="/lotes">Volver</a>
    </div>
    <hr>
    <div class="edit-box">        
        <div style="width:92%;border-bottom:1px solid #000;">
            <h2><strong>Lote: </strong><span style="color:var(--color11);"><?= $bat['lote_cod'] ?></span></h2>
            <h4><strong><?= $bat['producto_'] ?></strong></h4>
            <strong>Código: </strong><span style="color:var(--color0);"> <?= $bat['cod'] ?> </span>
            <strong>Fecha de ingreso: </strong><span style="color:var(--color0);"> <?= $bat['feceingreso'] ?> </span>
        </div>        
        <div style="width:92%; text-align: start;">
            <h5 ><strong>Fecha elaboración: </strong> <?= $bat['fecproduccion'] ?></h5>
            <h5 ><strong>Fecha vencimiento: </strong> <?= $bat['vencimiento'] ?></h5>
            <h5 ><strong>Peso: </strong> <?= $bat['pesaje'] ?> - Kg</h5>
            <h5 ><strong>Cantidad ingresada: </strong><span style="color:orangered;"> <?= $bat['cantidad'] ?> </span> - <?= $bat['umedida'] ?></h5>
        </div>  
        
        <?php if(isset($_SESSION['auth']) && $_SESSION['auth']->id_tipo == 1): ?>
            <div style="width:92%;">            
                <form action="/eliminar-lote/<?= $bat['id_lote'] ?>" method="post">
                    <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <input  type="hidden" id="cantidad" name="cantidad" value="<?= $bat['cantidad'] ?>">
                    <input  type="hidden" id="codprod" name="codprod" value="<?= $bat['cod'] ?>">
                    <input type="submit" class="btn btn-danger" value="Eliminar">            
                </form>
                <p>
                    <em>Recuerda que al eliminar este lote se descontará la cantidad ingresada en este lote 
                        al total del stock del producto.
                    </em>
                </p>
            </div>
        <?php endif; ?>
    </div>

<?php require_once "layout/down.php"; ?>