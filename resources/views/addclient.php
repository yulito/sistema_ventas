<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4><?= $accion ?> Cliente</h4>
    </div>
    <div class="edit-box">        
        <div class="row">                
                <div class="col-sm">
                    <a href="/clientes">Volver a lista de clientes</a>
                </div>
                <div class="col-sm">                    
                    <a href="/agregar-despacho">
                        <strong>Agregar despacho</strong>
                    </a>  
                </div>                             
            </div> 
  
        <div class="scrollForm">
        <form id="formClient" style="border: 8px solid gray; padding: 20px; width:600px">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">

                    <div class="mb-3 row">                        
                        <label for="nRun" class="row-sm-2 row-form-label">Run <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nRun" name="nRun" value="<?= isset($client->run) ? $client->run : '' ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3 row">                        
                        <label for="nName" class="row-sm-2 row-form-label">Nombre <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nName" name="nName" value="<?= isset($client->nomcliente) ? $client->nomcliente : '' ?>">
                        </div>
                    </div> 
                    
                    <div class="mb-3 row">                        
                        <label for="nPhone" class="row-sm-2 row-form-label">Teléfono <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nPhone" name="nPhone" value="<?= isset($client->fono) ? $client->fono : '' ?>">
                        </div>
                    </div> 

                    <div class="mb-3 row">                        
                        <label for="nAddress" class="row-sm-2 row-form-label">Dirección <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nAddress" name="nAddress" value="<?= isset($client->direcliente) ? $client->direcliente : '' ?>">
                        </div>
                    </div> 
                    
                    <select class="form-select" name="idLocation" id="idLocation" aria-label="Default select example">
                        <?php if(isset($client->run)): ?>
                            <option selected value="<?= $client->id_comuna?>"><?= $client->comuna_?> </option>
                        <?php else: ?>
                            <option selected disabled>Seleccionar Comuna <span style="color: red;">*</span></option>
                        <?php endif;?>

                        <?php $objs = $this->showLocation(); ?>
                        <?php while($location = $objs->fetch_object()): ?>                    
                            <option value=<?=$location->id_comuna ?>>
                                <?= $location->comuna_ ?>
                            </option> 
                        <?php endwhile; ?>
                    </select>

                    <?php if(isset($client->id_cliente)): ?>
                        <input type="hidden" name="nId" value="<?= $client->id_cliente?>">                                                    
                    <?php endif;?>
                    <br>
                <input type="button" class="btn-add-cli btn btn-primary" value=<?= $accion ?>>
            </form><br>
        </div>
    </div>

<script src="/assets/js/clientadd.js"></script>
<?php require_once "layout/down.php"; ?>