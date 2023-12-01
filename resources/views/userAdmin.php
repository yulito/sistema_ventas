<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

<div class="textTitle">
    <h2>Gestión de usuarios Vendedores</h2>
</div>
<div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Lista de usuarios</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Crear perfil</button>
        </div>
    </nav>
    <br>
    <div class="tab-content" id="nav-tabContent" style="max-width: 500px;">
        <!------------ Lista de usuarios -->
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th> 
                    <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody class="tbody-reg">
                      
                    <template id="tmp-user">
                    <tr>
                        <th scope="row"> - </th>
                        <td class="td1"> </td>
                        <td class="td2"> </td>
                        <td>
                        <a href="">
                            <button type="button" id="btn-edit-user" class="btn btn-warning" > 
                                <?php require_once "layout/icons/btnedit.php" ?>
                            </button> 
                        </a>                                        
                        </td>                    
                    </tr> 
                    </template>

                </tbody>
            </table>
        </div>
        <!------------ Formulario de usuario -->        
        <div class="tab-pane fade msg-form-reg" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" >
            
            <form id="formUser">
            <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                <div class="mb-3 row">
                    <label for="user" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="user" name="user">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="min. 4 y max. 8 caracteres">
                    </div>
                </div>
                <select class="form-select" name="typeUser" id="typeUser" aria-label="Default select example">
                    <option selected disabled>Selecciona el tipo de usuario</option>

                    <?php $objs = $this->showTypeUser(); ?>
                    <?php while($typeUser = $objs->fetch_object()): ?>                    
                        <option value=<?=$typeUser->id_tipo ?>>
                            <?= $typeUser->nomtipo ?>
                        </option>                    
                    <?php endwhile; ?>

                </select>
                <br>
                <input type="button" value="Guardar" class="btn btn-primary" id="btn-new-user">
            </form><br>

        </div>       
    </div> 
</div>                    

<script src="/assets/js/register.js"></script>
<?php require_once "layout/down.php"; ?>