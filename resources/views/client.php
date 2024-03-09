<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h4>Clientes</h4>
</div>
<div class="box-tab" >
    <!------------ CLIENTES -->
        <div >
            <div class="box-fxd">
                <a href="/agregar-cliente/false">
                    <button class="btn btn-primary btn-add-prod" style="margin-bottom: 20px;">
                        <?php require "layout/icons/btnadd.php" ?>
                    </button>
                </a>                     
                
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <!-- buscador -->
                        <div class="d-flex">
                            <input class="form-control me-2" type="search" name="searchCli" id="searchCli" placeholder="Buscador" aria-label="Buscador">                    
                        </div>
                        <!------------->
                    </div>
                </nav>
            </div>
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Run</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fono</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Editar                        
                        </th>
                    </tr>
                </thead>
                <tbody id="tbd-cli">
                    <template id="tmp-tbd-cli">
                        <tr>
                            <th scope="row" id="count"> </th>
                            <td id="run-tb"> </td>
                            <td><strong id="name-tb"> </strong></td>
                            <td id="phone-tb"> </td>
                            <td id="address-tb"> </td>                        
                            <td>                               
                                <a id="link-edit-cli">
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
</div>

<script src="/assets/js/client.js"></script>
<?php require_once "layout/down.php"; ?>