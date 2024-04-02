<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>
    
    <div>
        <a href="/ventas-realizadas">Volver</a>
    </div>
    <hr>
    <div class="edit-box"> 
        <div style="width:92%;border-bottom:1px solid #000;">
            <h4><strong>Nro de <?= $sale->doc ?>: </strong><span style="color:var(--color11);"><?= $sale->id_venta ?></span></h4>
            <h5><strong>Medio de pago: </strong> <?= $sale->pago ?></h5>
            <strong>Fecha: </strong><span style="color:var(--color0);"> <?= $sale->fecventa ?> </span>
            <strong>Subtotal: $</strong><span style="color:var(--color0);"> <?= $sale->subtotal ?> </span>
            <strong>Descuento: </strong><span style="color:var(--color0);"> <?= $sale->descventa ?> %</span>
            <h4><strong>Total: $</strong><span style="color:var(--color0);"> <?= $sale->total ?> </span></h4>
        </div>   
        <?php if($sale->id_doc == 2):?>     
            <div style="width:92%; text-align: start;border-bottom:1px solid #000;">
                <h4><strong>Datos de Empresa</strong></h4>
                <h5 ><strong>Rut: </strong> <?= $sale->rutempresa ?></h5>
                <h5 ><strong>Razón social: </strong> <?= $sale->nomempresa ?></h5>
                <h5 ><strong>Dirección: </strong> <?= $sale->direcemp ?> - <?= $sale->comuna_ ?></h5>
            </div>  
        <?php endif; ?> 
        
        <div style="width:92%;border-bottom:1px solid #000;">
            <h4><strong>Detalle venta: </strong></h4>           
            <?php foreach($detail as $detail): ?>
                <h5>
                    <strong>Producto: </strong> <?= substr($detail['producto_'], 0,40) ?>... 
                    <strong>Cantidad: </strong> <?= $detail['cantidad'] ?> 
                    <strong>Descuento: </strong> <?= $detail['desc_detalle'] ?> % 
                    <strong>Total: $</strong> <?= $detail['total_detalle'] ?>
                </h5>
            <?php endforeach; ?>
        </div>
        
    </div>

<?php require_once "layout/down.php"; ?>