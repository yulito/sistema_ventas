<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h4>Mermas</h4>
</div>
<div class="box-tab" >
    <!------------ Agregar Merma -->
        <div >
            <div class="box-fxd">
                <?php if(isset($_SESSION['auth']) && $_SESSION['auth']->id_tipo == 2):?>
                <a href="/agregar-merma">
                    <button class="btn btn-primary btn-add-shrinkage" style="margin-bottom: 20px;">
                        <?php require "layout/icons/btnadd.php" ?>
                    </button>
                </a> 
                <?php endif; ?>              
                
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <!-- buscador -->
                        <div class="d-flex">
                            <input class="form-control me-2" type="search" name="searchShrinkage" id="searchShrinkage" placeholder="Buscador" aria-label="Buscador">                    
                        </div>
                        <!------------->
                    </div>
                </nav>
            </div>
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha Ingreso</th>
                        <th scope="col">Código Prod.</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Detalle                      
                        </th>
                    </tr>
                </thead>
                <tbody id="tbd-shrinkage">
                    <template id="tmp-tbd-shrinkage">
                        <tr>
                            <th scope="row" id="count"> </th>
                            <td id="fecha-tb"> </td>
                            <td><strong id="cod-tb"> </strong></td>
                            <td id="cantidad-tb"> </td>                                                   
                            <td>                                  
                                <button class="btn btn-info btn-see-shrinkage" data-bs-toggle="modal" data-bs-target="#shrinkageModal">
                                    <?php require "layout/icons/btnlook.php" ?>
                                </button>                            
                            </td> 
                        </tr> 
                    </template>                   
                </tbody>
            </table>
        </div>  
        <?php require_once "layout/modals/shrinkagemodal.php"; ?>     
</div>

<script src="/assets/js/shrinkage.js"></script>
<?php require_once "layout/down.php"; ?>