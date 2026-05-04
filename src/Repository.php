<?php

class Repository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getServices(): array
    {
        return $this->pdo->query('SELECT title, description, icon FROM services ORDER BY display_order')->fetchAll();
    }

    public function getGallery(): array
    {
        return $this->pdo->query('SELECT image_url, caption FROM gallery ORDER BY id DESC')->fetchAll();
    }

    public function saveContact(string $name, string $email, string $message): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)');
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message,
        ]);
    }

    public function getContacts(): array
    {
        return $this->pdo->query('SELECT id, name, email, message, created_at FROM contacts ORDER BY created_at DESC')->fetchAll();
    }
}
