<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Editar área</h4>        
    </div>
    <div class="edit-box">
        <a href="/gestion-productos">Volver</a>
        <br>       
        <form id="formEditArea" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <div class="mb-3 row">       
                        <input type="hidden" class="form-control" id="idarea" name="idarea" value="<?= $area->id_area?>">                 
                        <label for="area" class="row-sm-2 row-form-label">Editar nombre Área</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="area" name="area" value="<?= $area->area_?>">
                        </div>
                    </div>                                   
                    <br>
                <input type="button" class="btn-edit-area btn btn-primary" value="Guardar">
        </form><br>

    </div>

<?php require_once "layout/down.php"; ?>