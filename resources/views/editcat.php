<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h2>Editar Categoría</h2>        
    </div>
    <div class="edit-box">
        <a href="/gestion-productos">Volver</a>
        <br>       
        <form id="formEditCat" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <div class="mb-3 row">       
                        <input type="hidden" class="form-control" id="idcat" name="idcat" value="<?= $cat->id_cat?>">                 
                        <label for="cat" class="row-sm-2 row-form-label">Editar nombre Categoría</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="cat" name="cat" value="<?= $cat->cat?>">
                        </div>
                    </div>                                   
                    <br>
                <input type="button" class="btn-edit-cat btn btn-primary" value="Guardar">
        </form><br>

    </div>

<?php require_once "layout/down.php"; ?>