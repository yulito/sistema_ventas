<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Agregar Merma</h4>
    </div>
    <div class="edit-box">
        <a href="/mermas">Volver</a>
  
        <div class="scrollForm">
        <form id="formShrinkage" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">

                    <div class="mb-3 row">                        
                        <label for="nfecha" class="row-sm-2 row-form-label">Ingreso <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="nfecha" name="nfecha" >
                        </div>
                    </div>
                    
                    <div class="mb-3 row">                        
                        <label for="ncod" class="row-sm-2 row-form-label">Código <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ncod" name="ncod" >
                        </div>
                    </div> 
                    
                    <div class="mb-3 row">                        
                        <label for="nqn" class="row-sm-2 row-form-label">Cantidad <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="nqn" name="nqn">
                        </div>
                    </div> 

                    <div class="mb-3">
                        <label for="nText" class="form-label">Descripción <span style="color: red;">*</span></label>
                        <textarea class="form-control" id="nText" name="nText" rows="3"></textarea>
                    </div>
                    <br>
                <input type="button" class="btn-add-shrinkage btn btn-primary" value="Guardar">
            </form><br>
        </div>
    </div>

<script src="/assets/js/shrinkagetadd.js"></script>
<?php require_once "layout/down.php"; ?>