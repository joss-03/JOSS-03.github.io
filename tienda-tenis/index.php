<?php include('db.php'); ?> 
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Tienda de Tenis</title>
  <link rel="stylesheet" href="css/estilo.css" />
  <style>
    /* Estilos header, logo y menú */
    .header-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #50c9c3;
      padding: 10px 20px;
    }
    .logo {
      height: 50px;
      cursor: pointer;
    }
    nav ul.menu {
      list-style: none;
      display: flex;
      gap: 15px;
      margin: 0;
      padding: 0;
    }
    nav ul.menu li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      padding: 6px 12px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    nav ul.menu li a:hover {
      background-color: rgba(255,255,255,0.3);
    }
    /* Marquesina para títulos */
    .marquesina-titulo {
      color: white;
      font-weight: 700;
      font-size: 1.8rem;
      background-color: #31708f;
      padding: 5px 0;
      margin: 0 0 1rem 0;
      overflow: hidden;
      white-space: nowrap;
      box-sizing: border-box;
      animation: marquee 15s linear infinite;
    }
    @keyframes marquee {
      0%   { text-indent: 100% }
      100% { text-indent: -100% }
    }
    /* Productos */
    .productos {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      padding: 1rem;
    }
    .producto {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      width: 220px;
      padding: 15px;
      cursor: pointer;
      text-align: center;
      transition: transform 0.2s ease;
      position: relative;
    }
    .producto:hover {
      transform: translateY(-6px);
    }
    .producto img {
      width: 100%;
      height: 140px;
      object-fit: contain;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    /* Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0; top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5);
    }
    .modal-contenido {
      background-color: #fff;
      margin: 80px auto;
      padding: 20px;
      border-radius: 10px;
      max-width: 450px;
      position: relative;
      text-align: center;
    }
    .modal-contenido img {
      width: 100%;
      height: 250px;
      object-fit: contain;
      border-radius: 8px;
      margin-bottom: 15px;
    }
    .modal-contenido h3 {
      margin-bottom: 10px;
      color: #31708f;
    }
    .modal-contenido p {
      color: #555;
      font-size: 1rem;
      margin-bottom: 10px;
    }
    .cerrar {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 28px;
      font-weight: bold;
      color: #333;
      cursor: pointer;
      user-select: none;
    }
    .cerrar:hover {
      color: #000;
    }
  </style>
</head>
<body>

<header>
  <div class="header-container">
    <img src="img/logo.png" alt="Logo Tienda de Tenis" class="logo" />
    <nav>
      <ul class="menu">
        <li><a href="#inicio">Inicio</a></li>
        <li><a href="#catalogo">Catálogo</a></li>
        <li><a href="#ofertas">Ofertas</a></li>
        <li><a href="#video">Video</a></li>
        <li><a href="#imagenes">Galería</a></li>
        <li><a href="#ubicacion">Ubicación</a></li>
        <li><a href="#contacto">Contacto</a></li>
        <li><a href="carrito.php">Carrito</a></li>
      </ul>
    </nav>
  </div>
  <div class="marquesina-titulo">¡Bienvenido a tu tienda favorita de tenis!</div>
</header>

<section id="inicio">
  <h2 class="marquesina-titulo">Bienvenido</h2>
  <p>Explora los mejores tenis del mercado.</p>
</section>

<section id="catalogo">
  <h2 class="marquesina-titulo">Catálogo</h2>
  <div class="productos">
    <?php
    $res = $conn->query("SELECT * FROM productos");
    while($row = $res->fetch_assoc()):
    ?>
      <div class="producto" 
           data-nombre="<?= htmlspecialchars($row['nombre']) ?>" 
           data-descripcion="<?= htmlspecialchars($row['descripcion']) ?>" 
           data-imagen="<?= htmlspecialchars($row['imagen']) ?>" 
           data-precio="<?= htmlspecialchars($row['precio']) ?>">
        <img src="<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>" />
        <h3><?= $row['nombre'] ?></h3>
        <p>$<?= $row['precio'] ?></p>
        <form action="carrito.php" method="POST" onclick="event.stopPropagation();">
          <input type="hidden" name="id" value="<?= $row['id'] ?>" />
          <label>Cantidad:</label>
          <input type="number" name="cantidad" value="1" min="1" />
          <button type="submit" name="agregar">Agregar al carrito</button>
        </form>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<section id="ofertas">
  <h2 class="marquesina-titulo">Ofertas Especiales</h2>
  <div class="productos">
    <div class="producto" 
         data-nombre="Tenis Puma RSX" 
         data-descripcion="Tenis Puma RSX cómodos y resistentes para tu día a día." 
         data-imagen="img/puma_rsx.jpg" 
         data-precio="1500">
      <img src="img/puma_rsx.jpg" alt="Tenis Puma RSX" />
      <h3>Tenis Puma RSX</h3>
      <p><del>$2000</del> <strong>$1500</strong></p>
      <form action="carrito.php" method="POST" onclick="event.stopPropagation();">
        <input type="hidden" name="id" value="101" />
        <label>Cantidad:</label>
        <input type="number" name="cantidad" value="1" min="1" />
        <button type="submit" name="agregar">Agregar al carrito</button>
      </form>
    </div>

    <div class="producto" 
         data-nombre="Tenis Nike Air" 
         data-descripcion="Tenis Nike Air con máxima amortiguación y estilo." 
         data-imagen="img/nike_air.jpg" 
         data-precio="1700">
      <img src="img/nike_air.jpg" alt="Tenis Nike Air" />
      <h3>Tenis Nike Air</h3>
      <p><del>$2200</del> <strong>$1700</strong></p>
      <form action="carrito.php" method="POST" onclick="event.stopPropagation();">
        <input type="hidden" name="id" value="102" />
        <label>Cantidad:</label>
        <input type="number" name="cantidad" value="1" min="1" />
        <button type="submit" name="agregar">Agregar al carrito</button>
      </form>
    </div>
  </div>
</section>

<section id="video">
  <h2 class="marquesina-titulo">Video Promocional</h2>
  <iframe
    width="600"
    height="340"
    src="https://www.youtube.com/embed/S1-QwIRjM-A"
    title="Video Promocional"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen
  ></iframe>
</section>

<section id="imagenes">
  <h2 class="marquesina-titulo">Galería</h2>
  <div class="galeria">
    <img src="img/nike_air.jpg" alt="Nike Air" />
    <img src="img/adidas_boost.jpg" alt="Adidas Boost" />
    <img src="img/puma_rsx.jpg" alt="Puma RSX" />
    <img src="img/Adidas_St.jpg" alt="Adidas St" />
    <img src="img/Adidas3W.jpg" alt="Adidas 3W" />
    <img src="img/Jordan_1Retro.jpg" alt="Jordan 1 Retro" />
    <img src="img/jordan_4Black.jpg" alt="Jordan 4 Black" />
    <img src="img/Reebok_68.jpg" alt="Reebok 68" />
  </div>
</section>

<section id="ubicacion">
  <h2 class="marquesina-titulo">Ubicación</h2>
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.145172782512!2d-99.68616408469822!3d19.21066638675821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f58f1c2de5d7%3A0x8ff8f1d3b44a9c0b!2sTenango%20del%20Valle%2C%20Estado%20de%20M%C3%A9xico!5e0!3m2!1ses!2smx!4v1688000000000!5m2!1ses!2smx"
    width="600"
    height="450"
    style="border:0;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
  ></iframe>
</section>

<section id="contacto">
  <h2 class="marquesina-titulo">Contacto</h2>
  <p>Correo: <a href="mailto:Jocelyn.ldz@gmail.com">Jocelyn.ldz@gmail.com</a></p>
  <p>Teléfono: <a href="tel:+527291127524">7291127524</a></p>
</section>

<footer>
  <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
</footer>

<!-- Modal para descripción producto -->
<div id="modalProducto" class="modal">
  <div class="modal-contenido">
    <span class="cerrar">&times;</span>
    <img id="modalImagen" src="" alt="" />
    <h3 id="modalNombre"></h3>
    <p id="modalDescripcion"></p>
    <p id="modalPrecio"></p>
  </div>
</div>

<script>
  // Modal para mostrar descripción producto
  const modal = document.getElementById('modalProducto');
  const modalImagen = document.getElementById('modalImagen');
  const modalNombre = document.getElementById('modalNombre');
  const modalDescripcion = document.getElementById('modalDescripcion');
  const modalPrecio = document.getElementById('modalPrecio');
  const cerrar = document.querySelector('.cerrar');

  document.querySelectorAll('.producto').forEach(producto => {
    producto.addEventListener('click', () => {
      modalImagen.src = producto.dataset.imagen;
      modalNombre.textContent = producto.dataset.nombre;
      modalDescripcion.textContent = producto.dataset.descripcion || 'No hay descripción disponible.';
      modalPrecio.textContent = '$' + producto.dataset.precio;
      modal.style.display = 'block';
    });
  });

  cerrar.onclick = function() {
    modal.style.display = 'none';
  }

  window.onclick = function(event) {
    if(event.target == modal){
      modal.style.display = 'none';
    }
  }
</script>

</body>
</html>

