<?php
header('Content-Type: application/json');
echo json_encode([
  "title" => "Storage - Choose Your Style",
  "items" => [
    [
      "name" => "Modern Storage",
      "image" => "https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?w=400&h=250&fit=crop",
      "description" => "Efficient and stylish storage for modern homes.",
      "link" => "#storage_modern"
    ],
    [
      "name" => "Classic Storage",
      "image" => "https://images.unsplash.com/photo-1460518451285-97b6aa326961?w=400&h=250&fit=crop",
      "description" => "Traditional storage with timeless appeal.",
      "link" => "#storage_classic"
    ],
    [
      "name" => "Luxury Storage",
      "image" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&h=250&fit=crop",
      "description" => "Premium storage solutions for elegant spaces.",
      "link" => "#storage_luxury"
    ]
  ]
]);
