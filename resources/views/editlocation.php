<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Editar Localidad/Comuna</h4>        
    </div>
    <div class="edit-box">
        <a href="/gestion-ubicacion">Volver</a>
        <br>       
        <form id="formEditLocation" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <div class="mb-3 row">       
                        <input type="hidden" class="form-control" id="idlocation" name="idlocation" value="<?= $location->id_comuna?>">                 
                        <label for="location" class="row-sm-2 row-form-label">Editar nombre</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="location" name="location" value="<?= $location->comuna_?>">
                        </div>
                    </div>                                   
                    <br>
                <input type="button" class="btn-edit-location btn btn-primary" value="Guardar">
        </form><br>

    </div>

<?php require_once "layout/down.php"; ?>