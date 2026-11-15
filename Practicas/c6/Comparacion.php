
<?php
$pruebas = [50, 70];

// Calcula las comparaciones del Candidato B
function calcularComparacionesB($n) {
    $categorias = 5;
    $base = intdiv($n, $categorias);
    $resto = $n % $categorias;

    $total = 0;

    for ($i = 0; $i < $categorias; $i++) {
        $cantidad = $base + ($i < $resto ? 1 : 0);
        $total += $cantidad * $cantidad;
    }

    return $total;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pruebas de rendimiento</title>

    <!-- Bootstrap 6 Alpha -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-dark text-light">

<div class="container py-5">

    <!-- ENCABEZADO -->
    <div class="text-center mb-5">

        <span class="badge text-bg-warning mb-3">
            MEDICIÓN DEL RENDIMIENTO
        </span>



        <p class="text-secondary">
            Comparación de los dos métodos según la cantidad de inscritos
        </p>

    </div>

    <!-- TARJETAS DE PRUEBAS -->
    <div class="row g-4">

        <?php foreach ($pruebas as $n):

            // Candidato A: búsqueda sin organizar
            $comparacionesA = $n * $n;

            // Candidato B: organización en cinco categorías
            $comparacionesB = calcularComparacionesB($n);

            $reduccion = (1 - $comparacionesB / $comparacionesA) * 100;

        ?>

        <div class="col-12 md:col-6">

            <div class="card bg-dark text-light border-secondary h-100">

                <div class="card-header border-secondary d-flex justify-content-between align-items-center">

                    <h4 class="text-warning fw-bold mb-0">
                        Cantidad <?= $n ?>
                    </h4>

                    <span class="badge text-bg-secondary">
                        <?= $n ?> inscritos
                    </span>

                </div>

                <div class="card-body">

                    <p class="text-secondary">
                        Comparación de operaciones realizadas:
                    </p>

                    <div class="table-responsive">

                        <table class="table table-dark table-bordered text-center align-middle">

                            <thead>
                                <tr>
                                    <th>Método</th>
                                    <th>Comparaciones</th>
                                    <th>Complejidad</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>Candidato A</td>

                                    <td class="fw-bold">
                                        <?= number_format($comparacionesA) ?>
                                    </td>

                                    <td>O(n²)</td>
                                </tr>

                                <tr>
                                    <td>Candidato B</td>

                                    <td class="text-success fw-bold">
                                        <?= number_format($comparacionesB) ?>
                                    </td>

                                    <td>O(n)</td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <div class="alert alert-success mt-3 mb-0">

                        <strong>Resultado:</strong>

                        <p class="mb-0">
                            El Candidato B reduce aproximadamente
                            <?= number_format($reduccion, 1) ?>%
                            las comparaciones estimadas.
                        </p>

                    </div>

                </div>

                <div class="card-footer border-secondary text-secondary">
                    Prueba con <?= $n ?> registros.
                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>
