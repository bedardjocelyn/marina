<?php
session_start();
$config = require __DIR__ . '/../config/config.php';
require __DIR__ . '/../src/Database.php';
require __DIR__ . '/../src/Repository.php';

if (isset($_POST['username'], $_POST['password'])) {
    if ($_POST['username'] === $config['admin']['username'] && $_POST['password'] === $config['admin']['password']) {
        $_SESSION['admin'] = true;
        header('Location: admin.php');
        exit;
    }
}

if (!($_SESSION['admin'] ?? false)): ?>
<!doctype html><html lang="fr"><body>
<form method="post">
  <h1>Connexion admin</h1>
  <input name="username" placeholder="Utilisateur" required>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <button type="submit">Se connecter</button>
</form>
</body></html>
<?php exit; endif;

$db = new Database($config['db']);
$repo = new Repository($db->pdo());
$contacts = $repo->getContacts();
?>
<!doctype html>
<html lang="fr"><body>
<h1>Messages reçus</h1>
<p><a href="index.php">Retour au site</a></p>
<table border="1" cellpadding="8">
<tr><th>Date</th><th>Nom</th><th>Email</th><th>Message</th></tr>
<?php foreach ($contacts as $c): ?>
<tr>
<td><?= htmlspecialchars($c['created_at']) ?></td>
<td><?= htmlspecialchars($c['name']) ?></td>
<td><?= htmlspecialchars($c['email']) ?></td>
<td><?= nl2br(htmlspecialchars($c['message'])) ?></td>
</tr>
<?php endforeach; ?>
</table>
</body></html>
