<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Agregar Stock</h4>        
    </div>
    <div class="edit-box">
        <a href="/">Volver</a>
        <br>
        
        <div class="scrollForm">
            <form id="formBatch" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <div class="mb-3 row">                        
                        <label for="batch" class="row-sm-2 row-form-label">Lote<span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="batch" name="batch" >
                        </div>
                    </div> 
                    <div class="mb-3 row">                        
                        <label for="codProd" class="row-sm-2 row-form-label">Código Producto<span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="codProd" name="codProd" >
                        </div>
                    </div> 
                    <div class="mb-3 row">                        
                        <label for="quantity" class="row-sm-2 row-form-label">Cantidad<span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="quantity" name="quantity" >
                        </div>
                    </div>
                    <div class="mb-3 row">                        
                        <label for="weight" class="row-sm-2 row-form-label">Pesaje</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="weight" name="weight" >
                        </div>
                    </div>
                    <div class="mb-3 row">                        
                        <label for="elaborated" class="row-sm-2 row-form-label">Fecha producción</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="elaborated" name="elaborated" >
                        </div>
                    </div> 
                    <div class="mb-3 row">                        
                        <label for="expiration" class="row-sm-2 row-form-label">Vencimiento</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="expiration" name="expiration" >
                        </div>
                    </div> 
                                                 
                    <br>
                <input type="button" class="btn-add-batch btn btn-primary" value="Guardar">
            </form>
        </div>
        
    </div>

<script src="/assets/js/addstock.js"></script>
<?php require_once "layout/down.php"; ?>