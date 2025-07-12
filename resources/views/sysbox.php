<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Sistema de ventas</h4>
    </div>

    <!-- buscador -->
    <div class="d-flex">
        <input class="form-control me-2" type="search" name="searchCod" id="searchCod" 
        list="options" placeholder="Nombre de producto" aria-label="Buscador">
        <datalist id="options">
            <template id="tmp-ops">
                <option class="item-op"></option> 
            </template>
        </datalist>
    </div>

    <div class="d-flex flex-nowrap justify-content-around">
        <figure>
            <img id="foto-prod" alt="img-product" style="height: 160px; width:160px; border:2px solid #000;">
            <figcaption><strong>Código: </strong><span id="cod"></span></figcaption>
        </figure>       
        <div class="d-flex flex-nowrap align-items-start flex-column">
            <h5 id="prod"></h5>
            <h6>Área: <strong><span id="area"></span></strong></h6>
            <h6>Marca: <strong><span id="brand"></span></strong></h6>
            <h6>Valor x <span id="uni"></span>: $<strong><span id="price"></span></strong></h6>
            <h6>Descuento: <span style="color: blue;" id="desc">0</span><strong>%</strong> | Valor final: $<strong><span style="color: green;" id="final"></span></strong></h6>
            <h6>Stock: <strong><span style="color: red;" id="stock"></span></strong></h6>
            <input type="hidden" name="idp" id="idp">                 
        </div>
        <div>
            <div>
                <div>
                    <label for="idnro">Ingrese cantidad</label>
                </div>
                <input type="number" name="idnro" id="idnro" disabled> 
            </div>
            <br>
            <div style="border-radius: 8px; border:1px solid #000; padding:4px;">
                <h2>Total</h2>
                <h3>$<span id="saleTotal">0</span></h3>
            </div>                      
        </div>
    </div>

    <div class="d-flex flex-row flex-nowrap justify-content-between">
        <div id="list" class="p-2 flex-fill">                            
            <table class="table table-striped text-center" style="height:200px;"> <!--width:90%;--->
                <thead>
                    <tr>      
                        <th scope="col">#</th>
                        <th scope="col" class="text-start" style="width:44%">Producto</th>
                        <th scope="col">Valor Unidad</th>
                        <th scope="col">Desc. Adicional</th>  
                        <th scope="col">Cantidad</th>  
                        <th scope="col">Subtotal</th>  
                        <th scope="col">Eliminar</th>                                
                    </tr>
                </thead>
                <tbody id="tbsale">
                    <!--template-->
                    <template id="tmp-salelist">
                        <tr class="lead" style="font-size: 16px;">
                            <th scope="row">*</th>
                            <th scope="row" class="text-start listprod"></th>
                            <td >$<span class="listprice"></span></td>
                            <td>
                                <input type="number" class="listdesc" value=0 style="width:80px;">
                            </td>
                            <td class="listqn"></td>
                            <td >$<span class="listtotal"></span></td>
                            <td>
                                <button class="btn btn-danger deleterow">X</button>
                            </td>
                        </tr>
                    </template>                    
                    <!--template-->        
                </tbody>
            </table>
        </div>  
    
        <div id="btns" class="d-flex flex-nowrap align-items-center flex-column">            
            <input type="button" class="btn btn-info mt-2" id="idBoleta" value="BOLETA">
            <input type="button" class="btn btn-info mt-2" id="idFactura" value="FACTURA">
        </div>
    </div>
    
    <!------------------------------------------------------------------------------------------>     

<script src="/assets/js/sysbox.js"></script>
<?php require_once "layout/down.php"; ?>
