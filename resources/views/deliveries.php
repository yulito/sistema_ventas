<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h4>Despachos</h4>
</div>
<div class="box-tab" >
        <div >
            <div class="box-fxd">
                <a href="/agregar-despacho">
                    <button class="btn btn-primary btn-add-delivery" style="margin-bottom: 20px;">
                        <?php require "layout/icons/btnadd.php" ?>
                    </button>
                </a>                     
                
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <!-- buscador -->
                        <div class="d-flex">
                            <input class="form-control me-2" type="search" name="searchDelivery" id="searchDelivery" placeholder="Buscar nro despacho" aria-label="Buscador">                    
                        </div>
                        <!------------->
                    </div>
                </nav>
            </div>
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nro Despacho</th>
                        <th scope="col">Fecha Emisión</th>
                        <th scope="col">Fecha modificación</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Checkear</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tbd-delivery">
                    <template id="tmp-tbd-delivery">
                    <tr>
                        <th scope="row">-</th>
                        <td id="nro-tb"> </td>
                        <td><strong id="date-tb"> </strong></td>
                        <td><strong id="date2-tb"></strong></td>
                        <td id="status-tb"> </td>
                        <td> 
                            <a id="link-check">
                                <button class="btn btn-light btn-check-delivery" >
                                    <?php require "layout/icons/btncheck.php" ?>
                                </button>
                            </a>
                        </td>                        
                        <td>
                            <a id="link-del">
                                <button class="btn btn-danger btn-del-delivery" >
                                    <?php require "layout/icons/btndel.php" ?>
                                </button>
                            </a>             
                        </td> 
                    </tr> 
                    </template>
                </tbody>
            </table>
        </div>       
</div>

<script src="/assets/js/delivery.js"></script>
<?php require_once "layout/down.php"; ?>