<?php
declare(strict_types=1);

require __DIR__ . '/datos.php';
require __DIR__ . '/funciones.php';

$valorId = $_GET['id'] ?? null;
$idValidado = is_scalar($valorId) ? filter_var((string) $valorId, FILTER_VALIDATE_INT) : false;
$producto = buscarPorId($productos, is_int($idValidado) ? $idValidado : 0);

if ($producto === null) {
    http_response_code(404);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $producto === null ? 'Producto no encontrado' : e($producto['nombre']) ?> · Catálogo PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-4">
        <?php if ($producto === null): ?>
            <div class="alert alert-danger" role="alert">El producto solicitado no existe.</div>
            <a class="btn btn-primary" href="index.php">← Volver al catálogo</a>
        <?php else: ?>
            <a class="btn btn-outline-secondary mb-3" href="index.php">← Volver al catálogo</a>
            <article class="card shadow-sm">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" src="<?= e($producto['imagen']) ?>" alt="<?= e($producto['nombre']) ?>">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-4">
                            <span class="badge bg-secondary mb-2"><?= e($producto['categoria']) ?></span>
                            <h1 class="card-title"><?= e($producto['nombre']) ?></h1>
                            <p><?= e($producto['descripcion']) ?></p>
                            <dl class="row">
                                <dt class="col-sm-5">Precio</dt><dd class="col-sm-7"><?= e(precio($producto['precio'])) ?></dd>
                                <dt class="col-sm-5">Precio con IVA (21 %)</dt><dd class="col-sm-7"><?= e(precio(round($producto['precio'] * 1.21, 2))) ?></dd>
                                <dt class="col-sm-5">Stock</dt>
                                <dd class="col-sm-7">
                                    <?php if ($producto['stock'] === 0): ?>
                                        <span class="badge bg-danger">Agotado</span>
                                    <?php else: ?>
                                        <?= e((string) $producto['stock']) ?> unidades
                                    <?php endif; ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </article>
        <?php endif; ?>
    </main>
</body>
</html>
