<?php
header('Content-Type: application/json');
echo json_encode([
  "title" => "Home",
  "items" => [
    [
      "name" => "Kitchens",
      "description" => "Modern, classic, and luxury kitchen collections.",
      "image" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&h=250&fit=crop",
      "section" => "kitchen"
    ],
    [
      "name" => "Living Rooms",
      "description" => "Comfort and style for your living space.",
      "image" => "https://images.unsplash.com/photo-1519710164239-da123dc03ef4?w=400&h=250&fit=crop",
      "section" => "livingroom"
    ],
    [
      "name" => "Bedrooms",
      "description" => "Relaxing bedroom sets for every taste.",
      "image" => "https://images.unsplash.com/photo-1460518451285-97b6aa326961?w=400&h=250&fit=crop",
      "section" => "bedroom"
    ],
    [
      "name" => "Storage",
      "description" => "Smart storage solutions for every room.",
      "image" => "https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?w=400&h=250&fit=crop",
      "section" => "storage"
    ]
  ]
]);
