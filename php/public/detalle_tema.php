<?php
include('../includes/header.php');
include('../../datos/queries.php');

$id = $_GET['id'] ?? null;
if ($id) {
    $tema = getTemaById($id);
}

if ($tema):
?>

<h1><?php echo $tema['titulo']; ?></h1>
<p><?php echo $tema['descripcion']; ?></p>

<?php else: ?>
    <p>El tema no existe.</p>
<?php endif; ?>

<?php include('../includes/footer.php'); ?>
