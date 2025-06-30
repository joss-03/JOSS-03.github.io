
<?php 
session_start(); 
include('db.php');

if (!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];

if (isset($_POST['agregar'])) {
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];
    $_SESSION['carrito'][$id] = $cantidad;
}

if (isset($_POST['eliminar_id'])) {
    $idEliminar = $_POST['eliminar_id'];
    unset($_SESSION['carrito'][$idEliminar]);
}

if (isset($_POST['vaciar_carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['actualizar_id']) && isset($_POST['nueva_cantidad'])) {
    $idActualizar = $_POST['actualizar_id'];
    $nuevaCantidad = max(1, intval($_POST['nueva_cantidad']));
    $_SESSION['carrito'][$idActualizar] = $nuevaCantidad;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<h2>Carrito de Compras</h2>

<?php if (!empty($_SESSION['carrito'])): ?>
<table>
  <tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th><th>Acciones</th></tr>
  <?php
  $total = 0;
  foreach ($_SESSION['carrito'] as $id => $cantidad):
    $res = $conn->query("SELECT * FROM productos WHERE id=$id");
    $prod = $res->fetch_assoc();
    $subtotal = $prod['precio'] * $cantidad;
    $total += $subtotal;
  ?>
  <tr>
    <td><?= $prod['nombre'] ?></td>
    <td>
      <form method="post" style="display:inline;">
        <input type="hidden" name="actualizar_id" value="<?= $id ?>">
        <input type="number" name="nueva_cantidad" value="<?= $cantidad ?>" min="1" style="width:50px;">
        <button class="actualizar">Actualizar</button>
      </form>
    </td>
    <td>$<?= $prod['precio'] ?></td>
    <td>$<?= $subtotal ?></td>
    <td>
      <form method="post" style="display:inline;">
        <input type="hidden" name="eliminar_id" value="<?= $id ?>">
        <button class="eliminar">Eliminar</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<h3>Total: $<?= $total ?></h3>

<form method="post">
  <button name="vaciar_carrito" class="vaciar">Vaciar Carrito</button>
</form>

<?php else: ?>
  <p>Tu carrito está vacío.</p>
<?php endif; ?>

<a href="index.php">← Seguir comprando</a>
</body>
</html>
