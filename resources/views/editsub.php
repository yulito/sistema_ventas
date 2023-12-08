<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Editar SubCategoría</h4>        
    </div>
    <div class="edit-box">
        <a href="/gestion-productos">Volver</a>
        <br>       
        <form id="formEditSub" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <div class="mb-3 row">       
                        <input type="hidden" class="form-control" id="idsub" name="idsub" value="<?= $sub->id_sub?>">                 
                        <label for="subcat" class="row-sm-2 row-form-label">Editar nombre SubCategoría</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="subcat" name="subcat" value="<?= $sub->subcat?>">
                        </div>
                    </div>
                    <select class="form-select" name="idCat" id="idCat" aria-label="Default select example">
                    <option value=<?=$sub->id_cat?> selected ><?=$sub->cat?></option>

                    <?php $objcat = $this->showCategories(); ?>
                    <?php while($cat = $objcat->fetch_object()): ?>                    
                        <option value=<?=$cat->id_cat ?>>
                            <?= $cat->cat ?>
                        </option>                    
                    <?php endwhile; ?>

                    </select>                               
                    <br>
                <input type="button" class="btn-edit-sub btn btn-primary" value="Guardar">
        </form><br>

    </div>

<?php require_once "layout/down.php"; ?>