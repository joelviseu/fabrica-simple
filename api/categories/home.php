<?php
header('Content-Type: application/json');
echo json_encode([
  "title" => "Home",
  "items" => [
    [
      "name" => "Kitchens",
      "description" => "Modern, classic, and luxury kitchen collections.",
      "image" => "https://images.unsplash.com/photo-1507089947368-19c1da9775ae?w=400&h=250&fit=crop", // Modern kitchen
      "section" => "kitchen"
    ],
    [
      "name" => "Living Rooms",
      "description" => "Comfort and style for your living space.",
      "image" => "https://images.unsplash.com/photo-1505691938895-1758d7feb511?w=400&h=250&fit=crop", // Cozy living room
      "section" => "livingroom"
    ],
    [
      "name" => "Bedrooms",
      "description" => "Relaxing bedroom sets for every taste.",
      "image" => "https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?w=400&h=250&fit=crop", // Modern bedroom
      "section" => "bedroom"
    ],
    [
      "name" => "Storage",
      "description" => "Smart storage solutions for every room.",
  "image" => "https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=400&h=250&fit=crop", // Closet shelving furniture
      "section" => "storage"
    ]
  ]
]);
