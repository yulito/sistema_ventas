<?php require_once "layout/up.php"; ?>
<?php require_once "layout/partials/sidebar.php"; ?>

    <div class="textTitle">
        <h2>Editar usuario </h2>        
    </div>
    <div class="edit-box">
        <a href="/gestion-usuario">Volver</a>
        <br>

        <form id="formUserEdit" style="border: 8px solid gray; padding: 20px;">
                <input  type="hidden" name="token_" value="<?php echo $this->createTokenCsrf(); ?>">
                    <div class="mb-3 row">
                        <input type="hidden" name="idUser" value="<?= $user->id_usuario?>">
                        <label for="nameUser" class="row-sm-2 row-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nameUser" name="nameUser" value="<?= $user->nomusuario ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="row-sm-2 row-form-label">Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="*******">
                        </div>
                    </div>
                    <select class="form-select" name="type" id="type" aria-label="Default select example">
                        <option value=<?= $user->id_tipo ?> selected><?= $user->nomtipo ?></option>

                        <?php $objs = $this->showTypeUser(); ?>
                        <?php while($typeUser = $objs->fetch_object()): ?>                    
                            <option value=<?=$typeUser->id_tipo ?>>
                                <?= $typeUser->nomtipo ?>
                            </option>                    
                        <?php endwhile; ?>

                    </select>
                    <br>
                <input type="button" value="Guardar" class="btn btn-primary" id="edit-save">
            </form><br>

    </div>

<script src="/assets/js/editUser.js"></script>
<?php require_once "layout/down.php"; ?>