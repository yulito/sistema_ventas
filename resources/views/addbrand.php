<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h2>Agregar Marca</h2>        
    </div>
    <div class="edit-box">
        <a href="/gestion-productos">Volver</a>
        <br>
        
        <form id="formBrand" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <div class="mb-3 row">                        
                        <label for="nameBrand" class="row-sm-2 row-form-label">Nombre Marca</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nameBrand" name="nameBrand" >
                        </div>
                    </div>                                   
                    <br>
                <input type="button" class="btn-add-brand btn btn-primary" value="Guardar">
            </form><br>
    </div>

<?php require_once "layout/down.php"; ?>