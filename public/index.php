<?php
session_start();

$configFile = __DIR__ . '/../config/config.php';
if (!file_exists($configFile)) {
    die('Configuration manquante. Copiez config/config.example.php en config/config.php');
}

$config = require $configFile;

require __DIR__ . '/../src/Database.php';
require __DIR__ . '/../src/Repository.php';

$db = new Database($config['db']);
$repo = new Repository($db->pdo());

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Merci de renseigner un nom, un email valide et un message.';
    } else {
        $repo->saveContact($name, $email, $message);
        $success = 'Merci ! Votre message a bien été envoyé.';
    }
}

$services = $repo->getServices();
$gallery = $repo->getGallery();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($config['site']['name']) ?></title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="nav">
  <div class="container nav-inner">
    <strong><?= htmlspecialchars($config['site']['name']) ?></strong>
    <nav>
      <a href="#services">Services</a>
      <a href="#tarifs">Tarifs</a>
      <a href="#galerie">Galerie</a>
      <a href="#contact">Contact</a>
    </nav>
  </div>
</header>

<section class="hero">
  <div class="container">
    <h1>Votre escale premium au cœur de la côte</h1>
    <p>Un port de plaisance moderne, sécurisé et pensé pour les plaisanciers exigeants.</p>
    <a class="btn" href="#contact">Réserver un anneau</a>
  </div>
</section>

<section id="services" class="section container">
  <h2>Nos services</h2>
  <div class="grid">
    <?php foreach ($services as $service): ?>
      <article class="card">
        <h3><?= htmlspecialchars($service['icon'] . ' ' . $service['title']) ?></h3>
        <p><?= htmlspecialchars($service['description']) ?></p>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section id="tarifs" class="section alt">
  <div class="container">
    <h2>Tarifs indicatifs</h2>
    <div class="pricing">
      <div><strong>Journée:</strong> 28€ / 10m</div>
      <div><strong>Semaine:</strong> 160€ / 10m</div>
      <div><strong>Mensuel:</strong> 520€ / 10m</div>
    </div>
  </div>
</section>

<section id="galerie" class="section container">
  <h2>Galerie</h2>
  <div class="gallery">
    <?php foreach ($gallery as $item): ?>
      <figure>
        <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['caption']) ?>">
        <figcaption><?= htmlspecialchars($item['caption']) ?></figcaption>
      </figure>
    <?php endforeach; ?>
  </div>
</section>

<section id="contact" class="section alt">
  <div class="container">
    <h2>Contact</h2>
    <?php if ($success): ?><p class="success"><?= htmlspecialchars($success) ?></p><?php endif; ?>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post" class="contact-form">
      <input type="text" name="name" placeholder="Votre nom" required>
      <input type="email" name="email" placeholder="Votre email" required>
      <textarea name="message" rows="5" placeholder="Votre message" required></textarea>
      <button class="btn" type="submit">Envoyer</button>
    </form>
  </div>
</section>

<footer class="footer">
  <div class="container">
    <p><?= htmlspecialchars($config['site']['name']) ?> • <?= htmlspecialchars($config['site']['email']) ?> • <?= htmlspecialchars($config['site']['phone']) ?></p>
  </div>
</footer>
</body>
</html>
