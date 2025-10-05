<?php
header('Content-Type: application/json');
echo json_encode([
  "title" => "Kitchens - Choose Your Style",
  "items" => [
    [
      "name" => "Modern",
      "image" => "https://images.unsplash.com/photo-1519710164239-da123dc03ef4?w=400&h=250&fit=crop",
      "description" => "Sleek and contemporary.",
      "link" => "#kitchen_modern"
    ],

    [
      "name" => "Classic 2",
      "image" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&h=250&fit=crop",
      "description" => "Timeless elegance.",
      "link" => "#kitchen_classic"
    ],
    [
      "name" => "Classic",
      "image" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&h=250&fit=crop",
      "description" => "Timeless elegance.",
      "link" => "#kitchen_classic"
    ],
    [
      "name" => "Rustic",
      "image" => "https://images.unsplash.com/photo-1460518451285-97b6aa326961?w=400&h=250&fit=crop",
      "description" => "Warm and inviting.",
      "link" => "#kitchen_rustic"
    ],
    [
      "name" => "Personalized",
      "image" => "https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?w=400&h=250&fit=crop",
      "description" => "Made just for you.",
      "link" => "#kitchen_personalized"
    ]
  ]
]);
