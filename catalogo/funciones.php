<?php
declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function precio(float $valor): string
{
    return number_format($valor, 2, ',', '.') . ' €';
}

function categorias(array $productos): array
{
    $categorias = array_values(array_unique(array_column($productos, 'categoria')));
    sort($categorias, SORT_STRING);

    return $categorias;
}

function buscar(array $productos, string $texto): array
{
    $texto = mb_strtolower(trim($texto), 'UTF-8');
    if ($texto === '') {
        return $productos;
    }

    return array_filter(
        $productos,
        static fn(array $producto): bool => str_contains(
            mb_strtolower($producto['nombre'], 'UTF-8'),
            $texto
        )
    );
}

function filtrarPorCategoria(array $productos, string $categoria): array
{
    if ($categoria === '') {
        return $productos;
    }

    return array_filter(
        $productos,
        static fn(array $producto): bool => $producto['categoria'] === $categoria
    );
}

function ordenarPorPrecio(array $productos, string $orden): array
{
    if ($orden !== 'asc' && $orden !== 'desc') {
        return $productos;
    }

    usort(
        $productos,
        static fn(array $a, array $b): int => $orden === 'asc'
            ? $a['precio'] <=> $b['precio']
            : $b['precio'] <=> $a['precio']
    );

    return $productos;
}

function buscarPorId(array $productos, int $id): ?array
{
    foreach ($productos as $producto) {
        if ($producto['id'] === $id) {
            return $producto;
        }
    }

    return null;
}
