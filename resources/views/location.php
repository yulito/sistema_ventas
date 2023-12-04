<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h2>Locaciones/Comunas</h2>
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
        <!------------ Lista de usuarios -->
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
        <!------------ Formulario de usuario -->        
        <div class="tab-pane fade" id="nav-office" role="tabpanel" aria-labelledby="nav-profile-tab" >
            
            <form id="formBrachOffice">
            <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                <div class="mb-3 row">
                    <label for="office" class="col-sm-2 col-form-label">Sucursal</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="office" name="office">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="idaddress" class="col-sm-2 col-form-label">Dirección</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="idaddress" name="idaddress">
                    </div>
                </div>
                
                <select class="form-select" name="location" id="location" aria-label="Default select example">
                    <option selected disabled>Selecciona la región</option>

                    <?php $objs = $this->showTypeUser(); ?>
                    <?php while($typeUser = $objs->fetch_object()): ?>                    
                        <option value=<?=$typeUser->id_tipo ?>>
                            <?= $typeUser->nomtipo ?>
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