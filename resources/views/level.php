<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h4>Nivelar stock de producto</h4>
</div>

    <div class="edit-box">
        <form class="row g-3" id="formLevel">
        <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
            <div class="mb-3 row">
                <label for="idcod" class="form-label">Código de Producto</label>                
                <div class="col-sm-4">
                    <input type="text" class="form-control " id="idcod" name="idcod">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="idstock" class="form-label">Actualización de Stock</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control " id="idstock" name="idstock">
                </div>                
            </div>            
            
            <div>
                <input type="button" class="btn btn-primary btn-save-level" value="Guardar">                
            </div>
        
        </form>
    </div>
    <hr>
    <!------------------------------------------------------------------------------------------>
    <p>
        <em>*Recuerda que la cantidad que ingreses para nivelar el producto dará como 
            resultado el nuevo stock total de este producto.
        </em>
    </p>    

<script src="/assets/js/level.js"></script>
<?php require_once "layout/down.php"; ?>