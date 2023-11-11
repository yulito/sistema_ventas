<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h2>Gestión de Productos</h2>
</div>

<div class="box-tab" style="max-width: 600px;">

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-prod" type="button" role="tab" aria-controls="nav-prod" aria-selected="true">Productos</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-cat" type="button" role="tab" aria-controls="nav-cat" aria-selected="false">Categorias</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-sub" type="button" role="tab" aria-controls="nav-sub" aria-selected="false">Sub-categorias</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-area" type="button" role="tab" aria-controls="nav-area" aria-selected="false">Áreas</button>
    </div>
    </nav>
    <br>
    <div class="tab-content" id="nav-tabContent">
        <!------------  -->
        <div class="tab-pane fade show active" id="nav-prod" role="tabpanel" aria-labelledby="nav-home-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>                    
                    <th scope="col">Editar | Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>
                        <button class="btn btn-warning">Editar</button>
                        <button class="btn btn-danger">Eliminar</button>
                    </td>                    
                    </tr>                    
                </tbody>
            </table>
        </div>
        <!------------  -->

        <div class="tab-pane fade" id="nav-cat" role="tabpanel" aria-labelledby="nav-profile-tab" >
            
        </div>

        <!------------  -->
        <div class="tab-pane fade" id="nav-sub" role="tabpanel" aria-labelledby="nav-profile-tab" >
            
        </div>
        
        <!------------  -->
        <div class="tab-pane fade" id="nav-area" role="tabpanel" aria-labelledby="nav-profile-tab" >
            
        </div>
    </div>

</div>

<?php require_once "layout/down.php"; ?>