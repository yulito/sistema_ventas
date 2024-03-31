<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h4>Eliminar venta</h4>        
    </div>
    <div class="edit-box">
        <a href="/">Volver</a>
        <br>   
    <div class="scrollForm">    
        <form id="formDelSale" style="border: 8px solid gray; padding: 20px; width:600px">

            <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">

            <div class="mb-3 row">             
                <label for="idSale" class="row-sm-2 row-form-label">Ingrese el número del documento (boleta o factura) <span style="color: red;">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="idSale" name="idSale">
                </div>
            </div>
           
            <input type="button" class="btn-del-sale btn btn-danger" value="Eliminar">
        </form><br>
    </div>
    </div>

<script src="/assets/js/delSale.js"></script>
<?php require_once "layout/down.php"; ?>