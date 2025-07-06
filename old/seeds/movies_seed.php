<?php
require __DIR__ . '/../connection/connection.php';

$movies = [
    [
        'title' => 'moana',
        'description' => 'girl',
        'genre' => 'animation',
        'rating' => '13+',
        'poster_url' => 'https://upload.wikimedia.org/wikipedia/en/2/26/Moana_Teaser_Poster.jpg',
        'cast' => 'hannah montana'
    ],
    [
        'title' => 'Ice age',
        'description' => 'It is twenty-thousand years ago. The Earth is a wondrous, prehistoric world.',
        'genre' => 'animation',
        'rating' => '13+',
        'poster_url' => 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRmMagGJl70-wcSHW-koqU4iVv3txlhGNDl82Tv41hArtyxP1wh35efHdIJjjKQf9Lc3XtV',
        'cast' => 'Ray Romano, John Leguizamo, Denis Leary, Jack Black'
    ],
    [
        'title' => 'Shrek',
        'description' => 'Winner of the first Academy® Award for Best Animated Feature.',
        'genre' => 'animation',
        'rating' => '13+',
        'poster_url' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQg_Lj-AwA3TKS-FSwZ8c8V0zDIA4cnGrMGz0tGfAzakmcYhWr6ndm6EXpSrYYXCprXW9d6',
        'cast' => 'Mike Myers, Eddie Murphy, Cameron Diaz, John Lithgow'
    ],
    [
        'title' => 'The croods',
        'description' => 'A disaster sends a caveman and his sheltered family on an adventure.',
        'genre' => 'animation',
        'rating' => '13+',
        'poster_url' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSaYx-qOP4faVy7OM-rsIkN4WE_RWqix4K8oWbwxr3KBEzbxlt8A-OdeAx7E0qOK6DHgNC4Uw',
        'cast' => 'Nicolas Cage, Emma Stone, Ryan Reynolds, Catherine Keener'
    ],
    [
        'title' => 'Fury',
        'description' => 'A grizzled tank commander makes tough decisions as he and his crew fight in WWII.',
        'genre' => 'war',
        'rating' => '18+',
        'poster_url' => 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcT2y_8q7vIrebfHgIygbQNfdfKM-oQiCWxiUgYczXaF7tXWrzx1fZonJhW7O4pd-UEsCofi6g',
        'cast' => 'brad pitt'
    ],
    [
        'title' => 'Little man',
        'description' => 'A wannabe-dad mistakes a vertically-challenged criminal on the run for his newly adopted son.',
        'genre' => 'comedy',
        'rating' => '18+',
        'poster_url' => 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSyw2VCywg-MYMCSWFpiM3_fjhqdc1ruL59TA8SEN3g4DBXPFWuhGbvBtGCtAcul_6j8A0j8w',
        'cast' => 'Shawn Wayans, Marlon Wayans, Kerry Washington'
    ],
    [
        'title' => 'Grown ups',
        'description' => 'After their high school basketball coach passes away, five friends reunite.',
        'genre' => 'comedy',
        'rating' => '13+',
        'poster_url' => 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRdve6fd__VnirwAgD_cZWE6o8wQJ5jgOgQrIUVo6w0MeBZ-zpaWdT6g9__vLp3hEPAfnEI',
        'cast' => 'Adam sandler'
    ],
    [
        'title' => 'The gorge',
        'description' => 'Two operatives are appointed to posts in guard towers.',
        'genre' => 'romance',
        'rating' => '13+',
        'poster_url' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQVhs0zWJkL9afwN2gqJJ3vtmX4yJVAeZchddbahTVkHzCi9fyKtXwj0OEcznWUsFRn_VKd',
        'cast' => 'Miles Teller, Anya Taylor-Joy, Sigourney Weaver'
    ]
];

$stmt = $conn->prepare("INSERT IGNORE INTO movies (title, description, genre, rating, poster_url, cast) 
                        VALUES (:title, :description, :genre, :rating, :poster_url, :cast)");

foreach ($movies as $movie) {
    $stmt->execute([
        ':title' => $movie['title'],
        ':description' => $movie['description'],
        ':genre' => $movie['genre'],
        ':rating' => $movie['rating'],
        ':poster_url' => $movie['poster_url'],
        ':cast' => $movie['cast']
    ]);
}

echo "Movies table seeded successfully.\n";
?>
