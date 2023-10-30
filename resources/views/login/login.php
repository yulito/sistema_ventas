<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>
    <h1>Sistema de ventas</h1><br>

    <div class="container-sm">
        <div class="mb-3 row enter">
            <label class="col-sm-2 col-form-label"><strong>Entrar</strong></label>            
        </div>        
        <div class="mb-3 row">
            <label for="user" class="col-sm-2 col-form-label">Usuario</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" name="user" id="user" >
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
            <div class="col-sm-8">
            <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>
    </div>

    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>