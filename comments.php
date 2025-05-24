<?php
header("Content-Type: application/json");

// Shembull i komenteve të ruajtura në një array
$comments = [
    [
        "author" => "Arta",
        "comment" => "E kam dhuruar 'Birthday Box' dhe është mrekulli!",
        "date" => "2024-12-01"
    ],
    [
        "author" => "Blendi",
        "comment" => "‘Golden Surprise’ ishte zgjedhje perfekte për ditëlindjen e motrës.",
        "date" => "2024-12-05"
    ],
    [
        "author" => "Lea",
        "comment" => "Aromat janë shumë të këndshme dhe pakoja shumë elegante.",
        "date" => "2024-12-10"
    ]
];

// Kthe si JSON
echo json_encode($comments);
