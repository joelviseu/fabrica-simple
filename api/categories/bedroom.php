<?php
header('Content-Type: application/json');
echo json_encode([
  "title" => "Bedrooms - Choose Your Style",
  "items" => [
    [
      "name" => "Modern",
      "image" => "https://images.unsplash.com/photo-1460518451285-97b6aa326961?w=400&h=250&fit=crop",
      "description" => "Clean lines and calming colors for modern living.",
      "link" => "#bedroom_modern"
    ],
    [
      "name" => "Classic",
      "image" => "https://images.unsplash.com/photo-1519710164239-da123dc03ef4?w=400&h=250&fit=crop",
      "description" => "Traditional comfort and timeless style.",
      "link" => "#bedroom_classic"
    ],
    [
      "name" => "Luxury",
      "image" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&h=250&fit=crop",
      "description" => "Premium materials for a restful retreat.",
      "link" => "#bedroom_luxury"
    ]
  ]
]);
