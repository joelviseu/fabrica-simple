
<?php
header('Content-Type: application/json');
echo json_encode([
  "title" => "Kitchens",
  "items" => [
    [
      "name" => "Modern Kitchen",
      "description" => "Sleek, minimalist design with high-gloss cabinets and integrated appliances.",
      "image" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400&h=250&fit=crop",
      "details" => [
        [
          "name" => "Island Counter",
          "description" => "Spacious island with quartz countertop and built-in storage.",
          "image" => "https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?w=400&h=250&fit=crop"
        ],
        [
          "name" => "LED Lighting",
          "description" => "Under-cabinet LED lighting for a modern ambiance.",
          "image" => "https://images.unsplash.com/photo-1464983953574-0892a716854b?w=400&h=250&fit=crop"
        ]
      ]
    ],
    [
      "name" => "Classic Kitchen",
      "description" => "Timeless wood cabinetry, marble countertops, and elegant fixtures.",
      "image" => "https://images.unsplash.com/photo-1519125323398-675f0ddb6308?w=400&h=250&fit=crop",
      "details" => [
        [
          "name" => "Farmhouse Sink",
          "description" => "Large porcelain sink with vintage brass faucet.",
          "image" => "https://images.unsplash.com/photo-1503389152951-9c3d8b6e9c94?w=400&h=250&fit=crop"
        ],
        [
          "name" => "Crown Molding",
          "description" => "Decorative crown molding for a classic touch.",
          "image" => "https://images.unsplash.com/photo-1465101046530-73398c7f28ca?w=400&h=250&fit=crop"
        ]
      ]
    ],
    [
      "name" => "Luxury Kitchen",
      "description" => "Premium appliances, custom cabinetry, and designer lighting.",
      "image" => "https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?w=400&h=250&fit=crop",
      "details" => [
        [
          "name" => "Wine Cooler",
          "description" => "Built-in wine cooler with dual temperature zones.",
          "image" => "https://images.unsplash.com/photo-1519864600265-abb23847ef2c?w=400&h=250&fit=crop"
        ],
        [
          "name" => "Chandelier",
          "description" => "Crystal chandelier for a touch of elegance.",
          "image" => "https://images.unsplash.com/photo-1465101178521-c1a9136a3fdc?w=400&h=250&fit=crop"
        ]
      ]
    ]
  ]
]);
