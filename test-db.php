<?php
echo "Testing database connection...\n\n";

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=adminstr_website',
        'root',
        'LeNI35?ud{M?'
    );
    echo "✓ Connection successful with localhost!\n";
    echo "✓ Database credentials are correct!\n";
} catch (PDOException $e) {
    echo "✗ Connection failed with localhost\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    
    // Try with 127.0.0.1
    try {
        $pdo = new PDO(
            'mysql:host=127.0.0.1;dbname=adminstr_website',
            'root',
            'LeNI35?ud{M?'
        );
        echo "✓ Connection successful with 127.0.0.1!\n";
        echo "Note: Use 127.0.0.1 instead of localhost in .env\n";
    } catch (PDOException $e2) {
        echo "✗ Connection also failed with 127.0.0.1\n";
        echo "Error: " . $e2->getMessage() . "\n";
    }
}