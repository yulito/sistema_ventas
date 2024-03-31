<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>
    
    <div>
        <a href="/despachos">Volver</a>
    </div>    
    <div class="edit-box">         
        <div class="scrollForm"> 
            <div style="width:92%;border-bottom:1px solid #000;">
                <h4>Detalle despacho - <strong>Nro: </strong><span><?= $delivery->id_despacho ?></span> - <strong>Estado: </strong><span id="statusChange" style="color:<?= ($delivery->estado == 1) ? "yellow" : "green"; ?>;text-shadow:1px 1px 2px #000"> <?= ($delivery->estado == 1) ? "Pendiente" : "Despachado"; ?> </span></h4><hr>                
                <strong>Fecha de Emisión: </strong><span> <?= $delivery->fecdespacho ?> </span>
                <strong>Dirección Despacho: </strong><span style="color:green;"> <?= $delivery->dir_desp ?> - <?= $delivery->comuna_desp ?></span>                
                <strong>Descripción: </strong><p> <?= $delivery->observacion ?> </p>                
            </div>        
            <div style="width:92%; text-align: start;">
                <h4>Datos cliente</h4><hr>
                <h6 ><strong>Rut: </strong> <?= $delivery->run ?> <strong>Nombre Cliente: </strong> <?= $delivery->nomcliente?></h6>
                <h6 ><strong>Teléfono: </strong> <?= $delivery->fono ?></h6>
                <h6 ><strong>Dirección cliente: </strong> <?= $delivery->dir_cli ?> - <?= $delivery->comuna_cli ?> </h6>
            </div>
            <hr>
            <div style="width:92%; text-align: start;">
                <h4>Lista productos | Nro Documento de venta: <strong><?= $delivery->id_venta ?></strong></h4><hr>
                <ul style="background-color: white !important ;color:#000 !important ;">
                    <?php foreach($details as $item):?>
                        <li style="background-color: white !important ;color:#000 !important ;">
                            <strong>Producto: </strong><?= $item['producto_'] ?> - <strong>Cantidad: </strong> <?= $item['cantidad'] ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php if($delivery->estado == 1): ?>
                <form id="formDeliveryCheck">
                    <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <input type="hidden" name="idDelivery" id="idDelivery" value=<?= $delivery->id_despacho ?>>
                    <label for="idcheck">Cambiar estado a "Despachado"</label>                
                    <input type="checkbox" name="idcheck" id="idcheck">
                </form>
            <?php endif; ?>
        </div>
    </div>

<script src="/assets/js/deliverystatus.js"></script>
<?php require_once "layout/down.php"; ?>