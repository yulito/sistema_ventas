<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4 id="document-sale"><?=$document?></h4>        
    </div>
    <div class="edit-box">  
        <div style="text-align:center;"><h4 id="msg-wait" hidden></h4></div>
        <!------------------- DETALLE DE VENTA (usando table)----------------->
        <h2 style="text-align: center;">TOTAL VENTA: $<span id="tValue"></span></h2> 
               
            <form id="formBill" style="border: 8px solid gray; padding: 20px; width:600px">
                <div class="mb-3 row">

                    <?php if($document == "factura"): ?> 
                        <label for="area" class="row-sm-2 row-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="area" name="area" >
                        </div>
                        <label for="area" class="row-sm-2 row-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="area" name="area" >
                        </div>
                        <label for="area" class="row-sm-2 row-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="area" name="area" >
                        </div>
                        <label for="area" class="row-sm-2 row-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="area" name="area" >
                        </div>
                    <?php endif; ?>
                        <label for="descxtotal" class="row-sm-2 row-form-label">Descuento Adicional al total de la compra</label>
                        <div class="col-sm-10 mb-2">
                            <input type="number" class="form-control" id="descxtotal" name="descxtotal" value=0>
                        </div>
                        
                        <div class="col-sm-10">
                        <label for="pay" class="row-sm-2 row-form-label">Medio de pago</label>
                            <select name="pay" id="pay" class="form-control">                                
                                <option value=1>EFECTIVO</option>
                                <option value=2>DEBITO</option>
                                <option value=3>CREDITO</option>
                            </select>
                        </div>

                </div>                        
                <br>
                <input type="button" class="btn-save-doc btn btn-primary" value="Guardar">
            </form><br>        
       
        <!----------------------- BTN PDF ---------------------->        
        <div>
            <button id="pdf-generator" style="padding: 4px;width:auto;border-radius:8px;background-color:yellow;" hidden>
                DESCARGAR PDF
            </button>
        </div>
    </div>

<script src="/assets/js/sale.js"></script>
<?php require_once "layout/down.php"; ?>