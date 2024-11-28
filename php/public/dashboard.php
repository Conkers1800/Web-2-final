<?php
include('../includes/header.php');  // Incluye el encabezado
include('../../datos/queries.php');  // Incluye las consultas necesarias


// Obtener los temas de salud desde la base de datos
$temas = getTemasSalud();
?>

<div class="container">
    <h1>Temas de Salud</h1>

    <?php if (count($temas) > 0): ?>
        <ul class="temas-list">
            <?php foreach ($temas as $tema): ?>
                <li class="tema-item">
                    <a href="detalle_tema.php?id=<?php echo $tema['id']; ?>" class="tema-link">
                        <?php echo htmlspecialchars($tema['titulo']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay temas disponibles en este momento.</p>
    <?php endif; ?>
</div>

<?php include('../includes/footer.php'); ?>  <!-- Incluye el pie de página -->
