<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h4>Locaciones/Comunas</h4>
</div>

<div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-location" type="button" role="tab" aria-controls="nav-location" aria-selected="true">Comunas</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-office" type="button" role="tab" aria-controls="nav-office" aria-selected="false">Asignar Sucursal</button>
        </div>
    </nav>
    <br>
    <div class="tab-content" id="nav-tabContent" style="max-width: 500px;">
        <!------------ Lista de locaciones-->
        <div class="tab-pane fade show active" id="nav-location" role="tabpanel" aria-labelledby="nav-home-tab">
            <a href="/agregar-locacion">
                <button class="btn btn-primary" style="margin-bottom: 20px;">
                    <?php require "layout/icons/btnadd.php" ?>
                </button>
            </a>
            <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width:100%">Locación/Comuna</th>        
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>                                                                                 
                        <?php $objLocation = $this->showLocation(); ?>
                        <?php if($objLocation): ?>
                            <?php $countlocation = 1;
                                while($location = $objLocation->fetch_object()): ?> 
                                <tr>
                                    <td scope="row"><?= $countlocation?></td>
                                    <td><?= $location->comuna_;?></td>
                                    <td>
                                        <a href="/editar-locacion/<?=$location->id_comuna?>">
                                            <button class="btn btn-warning" >
                                                <?php require "layout/icons/btnedit.php" ?>
                                            </button>  
                                        </a>                      
                                    </td>                    
                                </tr>
                                <?php $countlocation++; 
                                endwhile;?>
                            <?php else: ?>                    
                                    <tr>
                                        <td> - </td>
                                        <td><h3><span style="color: blue;">No hay nada agregado a esta sección.</span></h3></td> 
                                        <td> - </td>
                                    </tr>                   
                            <?php endif; ?>
                    </tbody>
                </table>
        </div>
        <!------------ Formulario de sucursal -->        
        <div class="tab-pane fade" id="nav-office" role="tabpanel" aria-labelledby="nav-profile-tab" >
            <?php $office = $this->showOffice();?>
            
            <form id="formBrachOffice">
            <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                <div class="mb-3 row">
                    <label for="office" class="col-sm-2 col-form-label">Sucursal</label>
                    <div class="col-sm-10">
                        <?php if($office): ?>
                            <span><?php require "layout/icons/btnedit.php" ?></span>
                            <input type="text" class="form-control" id="office" name="office" value="<?= $office->sucursal_?>">                            
                        <?php else: ?>
                            <input type="text" class="form-control" id="office" name="office">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="idaddress" class="col-sm-2 col-form-label">Dirección</label>
                    <div class="col-sm-10">
                    <?php if($office): ?>
                            <span><?php require "layout/icons/btnedit.php" ?></span>
                            <input type="text" class="form-control" id="idaddress" name="idaddress" value="<?= $office->direccion_sucursal?>">                            
                        <?php else: ?>
                            <input type="text" class="form-control" id="idaddress" name="idaddress">
                        <?php endif; ?>                        
                    </div>
                </div>
                
                <select class="form-select" name="loc" id="loc" aria-label="Default select example">
                    <?php if($office): ?> 
                            <option value=<?=$office->id_comuna?> selected><?=$office->comuna_ ?></option>
                        <?php else: ?>
                            <option selected disabled>Selecciona la región</option>
                        <?php endif; ?>                        
                    </div>                    

                    <?php $objLoc = $this->showLocation();  ?>
                    <?php while($loc = $objLoc->fetch_object()): ?>                    
                        <option value=<?=$loc->id_comuna ?>>
                            <?= $loc->comuna_ ?>
                        </option>                    
                    <?php endwhile; ?>                   

                </select>
                <br>
                <input type="button" value="Guardar" class="btn btn-primary" id="btn-new-office">
            </form><br>

        </div>       
    </div> 
</div>  

<?php require_once "layout/down.php"; ?>