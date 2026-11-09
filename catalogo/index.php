<?php
declare(strict_types=1);

require __DIR__ . '/datos.php';
require __DIR__ . '/funciones.php';

$valorQ = $_GET['q'] ?? '';
$valorCategoria = $_GET['cat'] ?? '';
$valorOrden = $_GET['orden'] ?? '';
$q = trim(is_scalar($valorQ) ? (string) $valorQ : '');
$categoriaActiva = is_scalar($valorCategoria) ? (string) $valorCategoria : '';
$orden = is_scalar($valorOrden) ? (string) $valorOrden : '';

$resultado = buscar($productos, $q);
$resultado = filtrarPorCategoria($resultado, $categoriaActiva);
$resultado = ordenarPorPrecio($resultado, $orden);
$categorias = categorias($productos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <header class="bg-dark text-white">
        <div class="container py-4">
            <h1 class="mb-0">Catálogo PHP</h1>
            <p class="mb-0">Encuentra tu próximo dispositivo</p>
        </div>
    </header>
    <main class="container py-4">
        <form method="get" class="row g-3 align-items-end mb-4">
            <div class="col-md-5">
                <label class="form-label" for="q">Buscar por nombre</label>
                <input class="form-control" type="search" id="q" name="q" value="<?= e($q) ?>" placeholder="Ej.: portátil">
            </div>
            <div class="col-md-3">
                <label class="form-label" for="cat">Categoría</label>
                <select class="form-select" id="cat" name="cat">
                    <option value="" <?= $categoriaActiva === '' ? 'selected' : '' ?>>Todas</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= e($categoria) ?>" <?= $categoriaActiva === $categoria ? 'selected' : '' ?>><?= e($categoria) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label" for="orden">Ordenar precio</label>
                <select class="form-select" id="orden" name="orden">
                    <option value="" <?= $orden !== 'asc' && $orden !== 'desc' ? 'selected' : '' ?>>Original</option>
                    <option value="asc" <?= $orden === 'asc' ? 'selected' : '' ?>>Menor a mayor</option>
                    <option value="desc" <?= $orden === 'desc' ? 'selected' : '' ?>>Mayor a menor</option>
                </select>
            </div>
            <div class="col-md-2 d-grid"><button class="btn btn-primary" type="submit">Aplicar</button></div>
        </form>

        <nav class="d-flex flex-wrap gap-2 mb-4" aria-label="Filtrar por categoría">
            <?php
            $parametrosTodas = ['q' => $q, 'cat' => '', 'orden' => $orden];
            $urlTodas = '?' . http_build_query($parametrosTodas);
            ?>
            <a class="btn <?= $categoriaActiva === '' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= e($urlTodas) ?>">Todas</a>
            <?php foreach ($categorias as $categoria): ?>
                <?php $urlCategoria = '?' . http_build_query(['q' => $q, 'cat' => $categoria, 'orden' => $orden]); ?>
                <a class="btn <?= $categoriaActiva === $categoria ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= e($urlCategoria) ?>"><?= e($categoria) ?></a>
            <?php endforeach; ?>
        </nav>

        <p class="text-secondary"><?= count($resultado) ?> producto(s) encontrado(s)</p>
        <?php if ($resultado === []): ?>
            <div class="alert alert-warning">No hay productos que coincidan con la búsqueda.</div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($resultado as $producto): ?>
                    <div class="col-sm-6 col-lg-3">
                        <article class="card h-100 shadow-sm">
                            <img class="card-img-top" src="<?= e($producto['imagen']) ?>" alt="<?= e($producto['nombre']) ?>" loading="lazy">
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-secondary align-self-start mb-2"><?= e($producto['categoria']) ?></span>
                                <h2 class="h5 card-title"><?= e($producto['nombre']) ?></h2>
                                <p class="fw-bold fs-5"><?= e(precio($producto['precio'])) ?></p>
                                <?php if ($producto['stock'] === 0): ?>
                                    <span class="badge bg-danger align-self-start mb-3">Agotado</span>
                                <?php endif; ?>
                                <a class="btn btn-outline-primary mt-auto" href="detalle.php?id=<?= e((string) $producto['id']) ?>">Ver detalle</a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
