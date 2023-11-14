<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h2>Agregar área</h2>        
    </div>
    <div class="edit-box">
        <a href="/gestion-productos">Volver</a>
        <br>
        
        <form id="formArea" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <div class="mb-3 row">                        
                        <label for="nameArea" class="row-sm-2 row-form-label">Nombre Área</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nameArea" name="nameArea" >
                        </div>
                    </div>                                   
                    <br>
                <input type="button" class="btn-add-area btn btn-primary" value="Guardar">
            </form><br>
    </div>

<?php require_once "layout/down.php"; ?>