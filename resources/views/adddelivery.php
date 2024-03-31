<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Agregar Despacho</h4>            
    </div>
    <div class="edit-box">
            <div class="row">                
                <div class="col-sm">
                    <a href="/despachos">Volver</a>
                </div>
                <div class="col-sm">                    
                    <a href="/agregar-cliente/false">
                        <strong>Agregar cliente</strong>
                    </a>  
                </div>                             
            </div>                      
        <div class="scrollForm">
        <form id="formDelivery" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">

                    <div class="mb-3 row">                        
                        <label for="nRun" class="row-sm-2 row-form-label">Rut del cliente<span style="color: red;">*</span></label>
                        <div class="col-sm-10">                            
                            <input type="text" class="form-control" id="nRun" name="nRun">                                                                                                                        
                        </div>                        
                    </div>
                    
                    <div class="mb-3 row">                        
                        <label for="nro" class="row-sm-2 row-form-label">Numero de documento (boleta/factura) <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="nro" name="nro">
                        </div>
                    </div>                                         

                    <div class="mb-3 row">                        
                        <label for="nAddress" class="row-sm-2 row-form-label">Dirección de despacho<span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nAddress" name="nAddress">
                        </div>
                    </div> 
                    
                    <select class="form-select" name="nLocation" id="nLocation" aria-label="Default select example">
                        
                        <option selected disabled>Seleccionar Comuna <span style="color: red;">*</span></option>                        

                        <?php $objs = $this->showLocation(); ?>
                        <?php while($location = $objs->fetch_object()): ?>                    
                            <option value=<?=$location->id_comuna ?>>
                                <?= $location->comuna_ ?>
                            </option> 
                        <?php endwhile; ?>
                    </select>

                    <div class="mb-3">
                        <label for="nText" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="nText" name="nText" rows="3"></textarea>
                    </div>
                    <br>
                <input type="button" class="btn-add-delivery btn btn-primary" value="Guardar">
            </form><br>
        </div>
    </div>

<script src="/assets/js/deliveryadd.js"></script>
<?php require_once "layout/down.php"; ?>