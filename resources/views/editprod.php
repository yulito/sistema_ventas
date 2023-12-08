<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Editar Producto</h4>        
    </div>
    <div class="edit-box">
        <a href="/gestion-productos">Volver</a>
        <br>   
    <div class="scrollForm">    
        <form id="formEditProd" style="border: 8px solid gray; padding: 20px; width:600px">

            <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">

            <div class="mb-3 row">
            <input type="hidden" class="form-control" id="idprod" name="idprod" value="<?= $prod['id_prod']?>">    
                <label for="nameCod" class="row-sm-2 row-form-label">Código <span style="color: red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nameCod" name="nameCod" value="<?= $prod['cod']?>">
                </div>
            </div>

            <div class="mb-3 row">                        
                <label for="nameProd" class="row-sm-2 row-form-label">Nombre Producto <span style="color: red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nameProd" name="nameProd" value="<?= $prod['producto_']?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="nameText" class="form-label">Descripción</label>
                <textarea class="form-control" id="nameText" name="nameText" rows="3" ><?= $prod['proddescrip']?></textarea>
            </div>

            <select class="form-select" name="idmeasure" id="idmeasure" aria-label="Default select example">
                <option value="<?= $prod['umedida']?>" selected><?= $prod['umedida']?></option>
                <option value="Unidad">Unidad</option>
                <option value="Litros">Litros</option>
                <option value="Kilos">Kilos</option>
                <option value="Metros">Metros</option>
            </select>
            <br>
            <div class="mb-3 row">                        
                <label for="nameValue" class="row-sm-2 row-form-label">Valor Venta <span style="color: red;">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="nameValue" name="nameValue" value="<?= $prod['valor']?>">
                </div>
            </div>

            <div class="mb-3 row">                        
                <label for="nameDesc" class="row-sm-2 row-form-label">Descuento de Producto</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="nameDesc" name="nameDesc" value="<?= $prod['desc_x_prod']?>">
                </div>
            </div>
            <br>
            <select class="form-select" name="idcategory" id="idcategory" aria-label="Default select example">
                <option selected disabled>Seleccionar Categoría </option>

                <?php $objs = $this->showCategories(); ?>
                <?php while($cat = $objs->fetch_object()): ?>                    
                    <option value=<?=$cat->id_cat ?>>
                        <?= $cat->cat ?>
                    </option>                    
                <?php endwhile; ?>
            </select>
            <br>
            <div class="msgText">
                <label for="idsubcat">Subcategoría</label>
                <select class="form-select" name="idsubcat" id="idsubcat" aria-label="Default select example">
                    <option value="<?=$prod['id_sub']?>" selected><?= $prod['subcat']?></option>

                </select>
            </div>
            <br>
            <label for="idarea">Área</label>
            <select class="form-select" name="idarea" id="idarea" aria-label="Default select example">
                <option value="<?= $prod['id_area']?>" selected><?= $prod['area_']?></option>

                <?php $objs = $this->showArea(); ?>
                <?php while($area = $objs->fetch_object()): ?>                    
                    <option value=<?=$area->id_area ?>>
                        <?= $area->area_ ?>
                    </option>                    
                <?php endwhile; ?>
            </select>
            <br>
            <label for="idbrand">Marca</label>
            <select class="form-select" name="idbrand" id="idbrand" aria-label="Default select example">
                <option value="<?= $prod['id_marca']?>" selected><?= $prod['marca_']?></option>

                <?php $objs = $this->showBrand(); ?>
                <?php while($brand = $objs->fetch_object()): ?>                    
                    <option value=<?=$brand->id_marca ?>>
                        <?= $brand->marca_ ?>
                    </option>                    
                <?php endwhile; ?>
            </select>
            <br>
            <div class="mb-3">
                <label for="idFile" class="form-label">Subir foto de producto</label>
                <input class="form-control" type="file" id="idFile" name="idFile">
                <p class="selfot"><?= $prod['foto']?></p>
            </div>
            <input type="button" class="btn-update-prod btn btn-primary" value="Guardar">
        </form><br>
    </div>
    </div>

<script src="/assets/js/editprod.js"></script>
<?php require_once "layout/down.php"; ?>