<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h2>Agregar SubCategoría</h2>        
    </div>
    <div class="edit-box">
        <a href="/gestion-productos">Volver</a>
        <br>
        
        <form id="formSub" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">

                    <div class="mb-3 row">                        
                        <label for="nameSub" class="row-sm-2 row-form-label">Nombre SubCategoría</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nameSub" name="nameSub" >
                        </div>
                    </div>                    
                    <br>
                    <select class="form-select" name="idcategory" id="idcategory" aria-label="Default select example">
                    <option selected disabled>Seleccionar Categoría</option>

                    <?php $objs = $this->showCategories(); ?>
                    <?php while($cat = $objs->fetch_object()): ?>                    
                        <option value=<?=$cat->id_cat ?>>
                            <?= $cat->cat ?>
                        </option>                    
                    <?php endwhile; ?>

                    </select>
                <br>
                <input type="button" class="btn-add-sub btn btn-primary" value="Guardar">
            </form><br>
    </div>

<?php require_once "layout/down.php"; ?>