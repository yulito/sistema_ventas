<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h2>Agregar Producto</h2>        
    </div>
    <div class="edit-box">
        <a href="/gestion-productos">Volver</a>
  
        <div class="scrollForm">
        <form id="formProd" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">

                    <div class="mb-3 row">                        
                        <label for="nameCod" class="row-sm-2 row-form-label">Código <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nameCod" name="nameCod" >
                        </div>
                    </div>
                    
                    <div class="mb-3 row">                        
                        <label for="nameProd" class="row-sm-2 row-form-label">Nombre Producto <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nameProd" name="nameProd" >
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nameText" class="form-label">Descripción</label>
                        <textarea class="form-control" id="nameText" name="nameText" rows="3">...</textarea>
                    </div>

                    <select class="form-select" name="idmeasure" id="idmeasure" aria-label="Default select example">
                        <option selected disabled>Seleccionar Unidad de medida <span style="color: red;">*</span></option>
                        <option value=1>Unidad</option>
                        <option value=2>Litros</option>
                        <option value=3>Kilos</option>
                        <option value=4>Metros</option>
                    </select>
                    <br>
                    <div class="mb-3 row">                        
                        <label for="nameValue" class="row-sm-2 row-form-label">Valor Venta <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="nameValue" name="nameValue" >
                        </div>
                    </div>

                    <div class="mb-3 row">                        
                        <label for="nameDesc" class="row-sm-2 row-form-label">Descuento de Producto</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="nameDesc" name="nameDesc" >
                        </div>
                    </div>
                    <br>
                    <select class="form-select" name="idcategory" id="idcategory" aria-label="Default select example">
                        <option selected disabled>Seleccionar Categoría <span style="color: red;">*</span></option>

                        <?php $objs = $this->showCategories(); ?>
                        <?php while($cat = $objs->fetch_object()): ?>                    
                            <option value=<?=$cat->id_cat ?>>
                                <?= $cat->cat ?>
                            </option>                    
                        <?php endwhile; ?>
                    </select>
                    <br>
                    <div class="msgText">
                        <select class="form-select" name="idsubcat" id="idsubcat" aria-label="Default select example" disabled>
                            <option selected disabled>Seleccionar Subcategoría <span style="color: red;">*</span></option>                    
                        </select>
                    </div>
                    <br>
                    <select class="form-select" name="idarea" id="idarea" aria-label="Default select example">
                        <option selected disabled>Seleccionar Área <span style="color: red;">*</span></option>

                        <?php $objs = $this->showArea(); ?>
                        <?php while($area = $objs->fetch_object()): ?>                    
                            <option value=<?=$area->id_area ?>>
                                <?= $area->area_ ?>
                            </option>                    
                        <?php endwhile; ?>
                    </select>
                    <br>
                    <select class="form-select" name="idbrand" id="idbrand" aria-label="Default select example">
                        <option selected disabled>Seleccionar Marca <span style="color: red;">*</span></option>

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
                    </div>

                <input type="button" class="btn-add-prod btn btn-primary" value="Guardar">
            </form><br>
        </div>
    </div>

<script src="/assets/js/productadd.js"></script>
<?php require_once "layout/down.php"; ?>