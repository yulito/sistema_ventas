<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h4>Ventas registrados</h4>
</div>

    <form class="row g-3" id="formSaleList">
        
        <div class="col-md-4">
            <label for="idfrom" class="form-label">Desde</label>
            <input type="date" class="form-control " id="idfrom" name="idfrom">   
        </div>

        <div class="col-md-4">
            <label for="idto" class="form-label">Hasta</label>
            <input type="date" class="form-control " id="idto" name="idto" disabled>    
        </div>
        
        <div">
            <input type="button" class="btn btn-primary btn-list-sale" value="Buscar" disabled>
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
                    <th scope="col">Nro venta</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Fecha - Hora</th>
                    <th scope="col">Total</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Detalle</th>
                </tr>
            </thead>
            <tbody id="tbd-sale">
                <!--template-->
                <template id="tmp-sale">
                    <tr>
                        <td id="id-count-sale"></td>
                        <td id="td-sale"></td>
                        <td id="td-type"></td>
                        <td id="td-date"></td> 
                        <td id="td-total"></td> 
                        <td id="td-seller"></td> 
                        <td id="td-btn">
                            <a id="a-sale" class="btn btn-primary">                                
                                <?php require "layout/icons/btnlook.php" ?>     
                            </a>
                        </td>                
                    </tr>
                </template> 
            </tbody>
        </table>
    </div>  

<script src="/assets/js/listsale.js"></script>
<?php require_once "layout/down.php"; ?>