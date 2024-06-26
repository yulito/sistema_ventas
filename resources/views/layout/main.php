
    <div class="textTitle">
        <h4>Panel principal</h4>
    </div>
    <div class="box-cards">

    <!------------------------------------ CONTENIDO (poner condicion para opciones admin y usuario) ------------------------------------>
    <?php if($_SESSION['auth']->id_tipo == 1): ?>
        <?php require_once "partials/dashadmin.php"; ?>
    <?php elseif($_SESSION['auth']->id_tipo == 2): ?>
        <?php require_once "partials/dashuser.php"; ?>
    <?php endif; ?>

    <a href="/lotes" style="text-decoration: none;color:#000;">
        <div class="item-card" >
            <div class="lote" style="height: 40px; width:90px;text-align:center; border:2px solid #000">
                <h2>LOT</h2>
            </div>
            <h6>Lotes</h6>
        </div>
    </a>
    
    <a href="/mermas" style="text-decoration: none;color:#000;">
        <div class="item-card orange">
            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
            </svg>
            <h6>Control mermas</h6>
        </div>
    </a>    

    </div>
