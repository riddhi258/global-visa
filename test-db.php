<?php

try {
    $dsn = "pgsql:host=dpg-d4176qa4d50c73dtfcq0-a.oregon-postgres.render.com;port=5432;dbname=growmore_c1tn;sslmode=require";
    $pdo = new PDO($dsn, "growmore_c1tn_user", "CjzTtIVUbsQgTVFzzlFa0vzGAOUnZggG", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✅ DB Connection Successful";
} catch (PDOException $e) {
    die("❌ DB Connection Failed: " . $e->getMessage());
}
?>