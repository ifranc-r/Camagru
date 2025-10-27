<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../db.php'; // pour connecter avec MariaDB

// import Faker
use Faker/Factory;



// config de la tailles de l'autoremplisement de la database
$NB_USERS    = 15;
$NB_IMAGES   = 40;
$NB_COMMENTS = 80;
$NB_LIKES    = 150;

// creation de classe faker en francais 
$faker = Factory::create('fr_FR');


// recupeter un user et une image aleatoire pour connecter 
function rand_user_id(PDO $pdo): int {
    return (int)$pdo->query('SELECT id FROM users ORDER BY RAND() LIMIT 1')->fetchColumn();
}
function rand_image_id(PDO $pdo): int {
    return (int)$pdo->query('SELECT id FROM images ORDER BY RAND() LIMIT 1')->fetchColumn();
}

echo "🌱 Start seeding data ...\n ";

try {
    ->beginTransaction();

    // Add Users
    $stmtUser = $pdo->prepare("INSERT INTO  users (username, email, password_hash, email_verified) VALUES (?, ? ,? , ?)")
    foreach($i = 0; $i < $NB_USERS; $i++){
        $username = $faker->unique()->userName();
        $email = $email->unique()->email();
        $password_hash = password_hash("123456", PASSWORD_DEFAULT);
        $email_verified = $faker->boolan(80) ? $faker->dateTimeBetween("-30 days", "now")->date('Y_m_d H:i:s') : null;
        $stmtUser->execute(array($username,$email,$password_hash,$email_verified));
    }
    
    // Add Images
    $stmtImgs = $pdo->prepare("INSERT INTO  images (user_id, path, thumb_path, created_at) VALUES (?, ? ,? , ?)")
    foreach($i = 0; $i < $NB_IMAGES; $i++){
        $user_id = rand_user_id($pdo);

        //option 1 avec site randomuser pour des profils
        if (random_int(0, 1)) {
            $path = 'https://randomuser.me/api/portraits/' 
            . (random_int(0, 1) ? 'men/' : 'women/') 
            . random_int(1, 99) . '.jpg';
        
        // option 2 sur picsum pour des paysages
        } else {
            $seed = random_int(1, 999999);
            $path = 'https://picsum.photos/seed/' . $seed . '/800/600';
        }

        //generer des miniatures plus tards
        $thumb_path = $path;
        $created_at = $faker->dateTimeBetween("-30 days", "now")->date('Y_m_d H:i:s');
        $stmtImgs->execute(array($user_id, $path, $thumb_path, $created_at));
    }

    /* Commit the changes */
    $pdo->commit();

    /* Database connection is now back in autocommit mode */
}

