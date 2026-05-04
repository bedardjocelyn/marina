CREATE DATABASE IF NOT EXISTS marina_site CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE marina_site;

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(120) NOT NULL,
    description TEXT NOT NULL,
    icon VARCHAR(10) DEFAULT '⚓',
    display_order INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_url VARCHAR(255) NOT NULL,
    caption VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO services (title, description, icon, display_order) VALUES
('Amarrage sécurisé', 'Pontons récents, accès badge 24/7 et surveillance vidéo.', '🛟', 1),
('Conciergerie', 'Assistance équipage, réservation taxi, avitaillement premium.', '🧭', 2),
('Maintenance', 'Partenaires techniques pour entretien mécanique et carénage.', '🔧', 3)
ON DUPLICATE KEY UPDATE title = VALUES(title);

INSERT INTO gallery (image_url, caption) VALUES
('https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=1200&q=80', 'Vue panoramique de la marina'),
('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80', 'Coucher de soleil sur les pontons'),
('https://images.unsplash.com/photo-1521207418485-99c705420785?auto=format&fit=crop&w=1200&q=80', 'Espaces détente et capitainerie')
ON DUPLICATE KEY UPDATE caption = VALUES(caption);
