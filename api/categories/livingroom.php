<?php
header('Content-Type: application/json');
echo json_encode([
  "title" => "Living Rooms - Choose Your Style",
  "items" => [
    [
      "name" => "Modern",
      "image" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&h=250&fit=crop",
      "description" => "Minimalist design and comfort for modern homes.",
      "link" => "#livingroom_modern"
    ],
    [
      "name" => "Classic",
      "image" => "https://images.unsplash.com/photo-1519710164239-da123dc03ef4?w=400&h=250&fit=crop",
      "description" => "Warmth and tradition for family gatherings.",
      "link" => "#livingroom_classic"
    ],
    [
      "name" => "Luxury",
      "image" => "https://images.unsplash.com/photo-1460518451285-97b6aa326961?w=400&h=250&fit=crop",
      "description" => "Elegant finishes and premium comfort.",
      "link" => "#livingroom_luxury"
    ]
  ]
]);
