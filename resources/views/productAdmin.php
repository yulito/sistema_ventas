<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h2>Gestión de Productos</h2>
</div>

<div class="box-tab" >

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-prod" type="button" role="tab" aria-controls="nav-prod" aria-selected="true">Productos</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-cat" type="button" role="tab" aria-controls="nav-cat" aria-selected="false">Categorías</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-sub" type="button" role="tab" aria-controls="nav-sub" aria-selected="false">Sub-categorías</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-area" type="button" role="tab" aria-controls="nav-area" aria-selected="false">Áreas</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-brand" type="button" role="tab" aria-controls="nav-brand" aria-selected="false">Marcas</button>
        </div>
    </nav>
    <br>
    <div class="tab-content" id="nav-tabContent">

        <!------------ PRODUCTOS -->
        <div class="tab-pane fade show active" id="nav-prod" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="box-fxd">
                <a href="/agregar-productos">
                    <button class="btn btn-primary btn-add-prod" style="margin-bottom: 20px;">
                        <?php require "layout/icons/btnadd.php" ?>
                    </button>
                </a>            
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <!-- buscador -->
                        <div class="d-flex">
                            <input class="form-control me-2" type="search" name="searchProd" id="searchProd" placeholder="Buscador" aria-label="Buscador">                    
                        </div>
                        <!------------->
                    </div>
                </nav>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">COD.</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Modificación</th>
                        <th scope="col">Detalle | Editar</th>
                    </tr>
                </thead>
                <tbody id="tbd-prod">
                    <template id="tmp-tbd-prod">
                        <tr>
                            <th scope="row" id="count"> </th>
                            <td id="cod-tb"> </td>
                            <td><strong id="prod-tb"> </strong></td>
                            <td id="brand-tb"> </td>
                            <td id="stock-tb"> </td>
                            <td id="price-tb"> </td>
                            <td id="date-tb"> </td>
                            <td>
                                <button class="btn btn-info btn-see-prod" data-bs-toggle="modal" data-bs-target="#prodModal" >
                                    <?php require "layout/icons/btnlook.php" ?>
                                </button>   

                                <a id="link-edit-prod">
                                    <button class="btn btn-warning btn-edit-prod" >
                                        <?php require "layout/icons/btnedit.php" ?>
                                    </button>
                                </a>

                            </td>                    
                        </tr> 
                    </template>                   
                </tbody>
            </table>
        </div>
        <?php require_once "layout/modals/prodmodal.php"; ?>

        <!------------ CATEGORIAS -->
        <div class="tab-pane fade" id="nav-cat" role="tabpanel" aria-labelledby="nav-profile-tab" >            
                <a href="/agregar-categoria">
                    <button class="btn btn-primary" style="margin-bottom: 20px;">
                        <?php require "layout/icons/btnadd.php" ?>
                    </button>
                </a>  
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Categoría</th>        
                        <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>                                                                                 
                        <?php $objCat = $this->showCategories(); ?>
                        <?php if($objCat): ?>
                            <?php $countcat = 1;
                                while($cat = $objCat->fetch_object()): ?> 
                                <tr>
                                    <th scope="row"><?= $countcat?></th>
                                    <td><?= $cat->cat;?></td>
                                    <td>
                                        <a href="/editar-categoria/<?=$cat->id_cat?>">
                                            <button class="btn btn-warning" >
                                                <?php require "layout/icons/btnedit.php" ?>
                                            </button>  
                                        </a>                      
                                    </td>                    
                                </tr>
                                <?php $countcat++; 
                                endwhile;?>
                            <?php else: ?>                    
                                    <tr>
                                        <th> - </th>
                                        <td><h3><span style="color: blue;">No hay nada agregado a esta sección.</span></h3></td> 
                                        <th> - </th>
                                    </tr>                   
                            <?php endif; ?>
                    </tbody>
                </table>
            </div>        

        <!------------ SUBCATEGORIAS -->
        <div class="tab-pane fade" id="nav-sub" role="tabpanel" aria-labelledby="nav-profile-tab" >
            <a href="/agregar-subcategoria">
                <button class="btn btn-primary" style="margin-bottom: 20px;">
                    <?php require "layout/icons/btnadd.php" ?>
                </button>
            </a>            
            
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sub-categoría</th>   
                    <th scope="col">Categoría</th>        
                    <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $objSub = $this->showSubCat(); ?>
                        <?php if($objSub): ?>
                            <?php $countsub = 1;
                            while($sub = $objSub->fetch_object()): ?> 
                            <tr>
                                <th scope="row"><?= $countsub?></th>
                                <td><?= $sub->subcat;?></td>
                                <td><?= $sub->cat;?></td>
                                <td>
                                    <a href="/editar-subcategoria/<?=$sub->id_sub?>">
                                        <button class="btn btn-warning" >
                                            <?php require "layout/icons/btnedit.php" ?>
                                        </button>  
                                    </a>                      
                                </td>                    
                            </tr>
                            <?php $countsub++; 
                            endwhile;?>
                        <?php else: ?>                    
                                <tr>
                                    <th> - </th>
                                    <td><h3><span style="color: blue;">No hay nada agregado a esta sección.</span></h3></td> 
                                    <th> - </th>
                                </tr>                   
                        <?php endif; ?>             
                </tbody>
            </table>
        </div>             
        <!------------ AREAS -->
        <div class="tab-pane fade" id="nav-area" role="tabpanel" aria-labelledby="nav-profile-tab" >
            <a href="/agregar-area">
                <button class="btn btn-primary" style="margin-bottom: 20px;">
                    <?php require "layout/icons/btnadd.php" ?>
                </button>
            </a>            
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Área</th>        
                    <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>
                <?php $objArea = $this->showArea(); ?>
                <?php if($objArea): ?>
                    <?php $count = 1;
                        while($area = $objArea->fetch_object()): ?> 
                    <tr>
                        <th scope="row"><?= $count?></th>
                        <td><?= $area->area_;?></td>
                        <td>
                            <a href="/editar-area/<?=$area->id_area?>">
                                <button class="btn btn-warning" >
                                    <?php require "layout/icons/btnedit.php" ?>
                                </button>  
                            </a>                      
                        </td>                    
                    </tr>
                    <?php $count++; 
                    endwhile;?>
                <?php else: ?>                    
                        <tr>
                            <th> - </th>
                            <td><h3><span style="color: blue;">No hay nada agregado a esta sección.</span></h3></td> 
                            <th> - </th>
                        </tr>                   
                <?php endif; ?>
                </tbody>
            </table>
        </div>         
        <!------------ MARCAS -->
        <div class="tab-pane fade" id="nav-brand" role="tabpanel" aria-labelledby="nav-profile-tab" >
            <a href="/agregar-marca">
                <button class="btn btn-primary" style="margin-bottom: 20px;">
                    <?php require "layout/icons/btnadd.php" ?>
                </button>
            </a>            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Marca</th>        
                        <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $objBrand = $this->showBrand(); ?>
                    <?php if($objBrand): ?>
                        <?php $countbrand = 1;
                            while($brand = $objBrand->fetch_object()): ?> 
                        <tr>
                            <th scope="row"><?= $countbrand?></th>
                            <td><?= $brand->marca_;?></td>
                            <td>
                                <a href="/editar-marca/<?=$brand->id_marca?>">
                                    <button class="btn btn-warning" >
                                        <?php require "layout/icons/btnedit.php" ?>
                                    </button>  
                                </a>                      
                            </td>                    
                        </tr>
                        <?php $countbrand++; 
                        endwhile;?>
                        <?php else: ?>                    
                                <tr>
                                    <th> - </th>
                                    <td><h3><span style="color: blue;">No hay nada agregado a esta sección.</span></h3></td> 
                                    <th> - </th>
                                </tr>                   
                        <?php endif; ?>
                </tbody>
            </table>
        </div>  

    </div>
</div>

<script src="/assets/js/product.js"></script>

<?php require_once "layout/down.php"; ?>