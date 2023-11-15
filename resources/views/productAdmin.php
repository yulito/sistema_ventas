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
        </div>
    </nav>
    <br>
    <div class="tab-content" id="nav-tabContent">
        <!------------ PRODUCTOS -->
        <div class="tab-pane fade show active" id="nav-prod" role="tabpanel" aria-labelledby="nav-home-tab">

            <button class="btn btn-primary" style="margin-bottom: 20px;">
            Agregar
            </button>
        
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">COD.</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Stock</th>
                    <th scope="col">modificación</th>
                    <th scope="col">Detalle | Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>10034404prod</td>
                    <td>Cemento Melon 20 kg</td>
                    <td>Melon</td>
                    <td>200</td>
                    <td>02/12/2023</td>
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#prodModal">Detalle</button>   
                        <button class="btn btn-warning">Editar</button>                        
                    </td>                    
                    </tr>                    
                </tbody>
            </table>
        </div>

        <?php require_once "layout/modals/prodmodal.php"; ?>

        <!------------ CATEGORIAS -->

        <div class="tab-pane fade" id="nav-cat" role="tabpanel" aria-labelledby="nav-profile-tab" >
        <a href="/agregar-categoria">
            <button class="btn btn-primary" style="margin-bottom: 20px;">
            Agregar
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
                    <?php if(!empty($objCat)): ?>
                        <?php $countcat = 1;
                            while($cat = $objCat->fetch_object()): ?> 
                            <tr>
                                <th scope="row"><?= $countcat?></th>
                                <td><?= $cat->cat;?></td>
                                <td>
                                    <a href="/editar-categoria/<?=$cat->id_cat?>">
                                        <button class="btn btn-warning" >Editar</button>  
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
            <button class="btn btn-primary" style="margin-bottom: 20px;">
            Agregar
            </button>
            
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
                    <tr>
                    <th scope="row">1</th>
                    <td>Cemento Blanco</td>
                    <td>Cemento</td>
                    <td>
                        <button class="btn btn-warning">Editar</button>                        
                    </td>                    
                    </tr>                    
                </tbody>
            </table>
        </div>             

        <!------------ AREAS -->
        <div class="tab-pane fade" id="nav-area" role="tabpanel" aria-labelledby="nav-profile-tab" >
            <a href="/agregar-area">
                <button class="btn btn-primary" style="margin-bottom: 20px;">
                Agregar
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
                <?php if(isset($objArea)): ?>
                    <?php $count = 1;
                        while($area = $objArea->fetch_object()): ?> 
                    <tr>
                        <th scope="row"><?= $count?></th>
                        <td><?= $area->area_;?></td>
                        <td>
                            <a href="/editar-area/<?=$area->id_area?>">
                                <button class="btn btn-warning" >Editar</button>  
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

    </div>

</div>


<?php require_once "layout/down.php"; ?>