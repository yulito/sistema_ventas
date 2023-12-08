<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Editar Marca</h4>        
    </div>
    <div class="edit-box">
        <a href="/gestion-productos">Volver</a>
        <br>       
        <form id="formEditBrand" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <div class="mb-3 row">       
                        <input type="hidden" class="form-control" id="idbrand" name="idbrand" value="<?= $brand->id_marca?>">                 
                        <label for="brand" class="row-sm-2 row-form-label">Editar nombre Marca</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="brand" name="brand" value="<?= $brand->marca_?>">
                        </div>
                    </div>                                   
                    <br>
                <input type="button" class="btn-edit-brand btn btn-primary" value="Guardar">
        </form><br>

    </div>

<?php require_once "layout/down.php"; ?>