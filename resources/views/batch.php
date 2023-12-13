<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h4>Lotes registrados</h4>
</div>

    <form class="row g-3" id="formBatchList">
        
        <div class="col-md-4">
            <label for="idfrom" class="form-label">Desde</label>
            <input type="date" class="form-control " id="idfrom" name="idfrom">   
        </div>

        <div class="col-md-4">
            <label for="idto" class="form-label">Hasta</label>
            <input type="date" class="form-control " id="idto" name="idto" disabled>    
        </div>
        
        <div">
            <input type="button" class="btn btn-primary btn-list-batch" value="Buscar" disabled>
        </div>
    
    </form>

    <br><hr>
    <!------------------------------------------------------------------------------------------>

    <p class="text-center">
        <span style="color: blue;" class="msgEmpty"></span>
    </p>
    <div>
        <table class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Lote</th>
                    <th scope="col" style="width:57%">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Fecha ingreso</th>
                    <th scope="col">Detalle</th>
                </tr>
            </thead>
            <tbody id="tbd-batch">
                <!--template-->
                <template id="tmp-batch">
                    <tr>
                        <th id="id-count-batch" scope="row"></th>
                        <td id="td-batch"></td>
                        <td id="td-prod"></td> 
                        <td id="td-quantity"></td> 
                        <td id="td-date"></td> 
                        <td id="td-btn">
                            <a id="a-batch" class="btn btn-primary">                                
                                <?php require "layout/icons/btnlook.php" ?>     
                            </a>
                        </td>                
                    </tr>
                </template> 
            </tbody>
        </table>
    </div>  

<script src="/assets/js/batch.js"></script>
<?php require_once "layout/down.php"; ?>