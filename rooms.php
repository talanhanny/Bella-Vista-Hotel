<?php
$rooms = [
    [
        'name'        => 'Standard Room(A)',
        'capacity'    => '2-3 pax',
        'image'       => 'standard.jpg',
        'price'       => 3500,
        'description' => 'Your cozy tropical escape. Perfect for couples, friends, or small groups, the Standard Room offers a comfortable and intimate retreat surrounded by a relaxing atmosphere. Enjoy a restful stay with convenient amenities, a private balcony, and a kitchen area for a home-away-from-home experience.',
        'features'    => ['2 Double Beds', 'Private Toilet and Bath', 'Closet', 'Kitchen Area', 'Private Balcony'],
        'amenities'   => ['Smart TV', 'Wi-Fi Internet Access', 'Refrigerator', 'Laundry Facilities', 'Iron', 'Safety Deposit Box', 'Microwave', 'Kitchen Sink'],
    ],
    [
        'name'        => 'Standard Room(B)',
        'capacity'    => '2-3 pax',
        'image'       => 'standard.jpg',
        'price'       => 3500,
        'description' => 'Your cozy tropical escape. Perfect for couples, friends, or small groups, the Standard Room offers a comfortable and intimate retreat surrounded by a relaxing atmosphere. Enjoy a restful stay with convenient amenities, a private balcony, and a kitchen area for a home-away-from-home experience.',
        'features'    => ['2 Double Beds', 'Private Toilet and Bath', 'Closet', 'Kitchen Area', 'Private Balcony'],
        'amenities'   => ['Smart TV', 'Wi-Fi Internet Access', 'Refrigerator', 'Laundry Facilities', 'Iron', 'Safety Deposit Box', 'Microwave', 'Kitchen Sink'],
    ],
    [
        'name'        => 'Standard Room(C)',
        'capacity'    => '2-3 pax',
        'image'       => 'standard.jpg',
        'price'       => 3500,
        'description' => 'Your cozy tropical escape. Perfect for couples, friends, or small groups, the Standard Room offers a comfortable and intimate retreat surrounded by a relaxing atmosphere. Enjoy a restful stay with convenient amenities, a private balcony, and a kitchen area for a home-away-from-home experience.',
        'features'    => ['2 Double Beds', 'Private Toilet and Bath', 'Closet', 'Kitchen Area', 'Private Balcony'],
        'amenities'   => ['Smart TV', 'Wi-Fi Internet Access', 'Refrigerator', 'Laundry Facilities', 'Iron', 'Safety Deposit Box', 'Microwave', 'Kitchen Sink'],
    ],
    [
        'name'        => 'Family Room(A)',
        'capacity'    => '4-5 pax',
        'image'       => 'family.jpg',
        'price'       => 6000,
        'description' => 'Make tropical memories together. Designed for families and larger groups, the Family Room provides a spacious and welcoming environment for bonding, relaxation, and quality time. With comfortable sleeping arrangements, a private balcony, and convenient kitchen facilities, it is the perfect place to unwind and enjoy your getaway together.',
        'features'    => ['2 Queen Beds', 'Private Toilet and Bath', 'Closet Area', 'Kitchen Area', 'Private Balcony'],
        'amenities'   => ['Smart TV', 'Wi-Fi Internet Access', 'Refrigerator', 'Laundry Facilities', 'Iron', 'Safety Deposit Box', 'Microwave', 'Kitchen Sink'],
    ],
    [
        'name'        => 'Family Room(B)',
        'capacity'    => '4-5 pax',
        'image'       => 'family.jpg',
        'price'       => 6000,
        'description' => 'Make tropical memories together. Designed for families and larger groups, the Family Room provides a spacious and welcoming environment for bonding, relaxation, and quality time. With comfortable sleeping arrangements, a private balcony, and convenient kitchen facilities, it is the perfect place to unwind and enjoy your getaway together.',
        'features'    => ['2 Queen Beds', 'Private Toilet and Bath', 'Closet Area', 'Kitchen Area', 'Private Balcony'],
        'amenities'   => ['Smart TV', 'Wi-Fi Internet Access', 'Refrigerator', 'Laundry Facilities', 'Iron', 'Safety Deposit Box', 'Microwave', 'Kitchen Sink'],
    ],
    [
        'name'        => 'Family Room(C)',
        'capacity'    => '4-5 pax',
        'image'       => 'family.jpg',
        'price'       => 6000,
        'description' => 'Make tropical memories together. Designed for families and larger groups, the Family Room provides a spacious and welcoming environment for bonding, relaxation, and quality time. With comfortable sleeping arrangements, a private balcony, and convenient kitchen facilities, it is the perfect place to unwind and enjoy your getaway together.',
        'features'    => ['2 Queen Beds', 'Private Toilet and Bath', 'Closet Area', 'Kitchen Area', 'Private Balcony'],
        'amenities'   => ['Smart TV', 'Wi-Fi Internet Access', 'Refrigerator', 'Laundry Facilities', 'Iron', 'Safety Deposit Box', 'Microwave', 'Kitchen Sink'],
    ],
    [
        'name'        => 'Event Hall',
        'capacity'    => 'Up to 30 pax (40 max)',
        'image'       => 'deluxe.jpg',
        'price'       => 15000,
        'description' => 'Celebrate, connect, and create unforgettable moments. Our open-air Event Hall offers a refreshing tropical setting for family gatherings, intimate celebrations, recreational activities, and special occasions. Designed with natural ventilation and spacious surroundings, it provides a relaxing atmosphere where guests can enjoy meaningful moments together. Accommodating up to 30 guests comfortably, with a maximum capacity of 40, it is an ideal venue for memorable gatherings.',
        'features'    => ['Powder Room', 'Kitchen Room', 'Al Fresco Dining Area', 'Elevated Platform / Stage'],
        'amenities'   => ['Large Projector Screen', 'Wi-Fi Internet Access', 'Refrigerator', 'Kitchen Sink', 'Kitchen Burner', 'Microwave'],
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms | Bella Vista</title>
    <link rel="stylesheet" href="Design.css">
    <link rel="stylesheet" href="room.css">
</head>
<body>

<?php include __DIR__ . '/navbar.php'; ?>

<section class="section">
    <h1>Our Rooms</h1>
    <p>Choose the perfect room for your stay.</p>

    <div class="gallery-container">
        <?php foreach ($rooms as $room): ?>
        <div class="gallery-item room-card">
            <img src="<?= htmlspecialchars($room['image']) ?>" alt="<?= htmlspecialchars($room['name']) ?>">
            <p class="room-price">₱<?= number_format($room['price']) ?> / night</p>
            <a href="booking.php" class="btn">Book Now</a>
            <h1><?= htmlspecialchars($room['name']) ?></h1>
            <span class="room-capacity"><?= htmlspecialchars($room['capacity']) ?></span>

            <p class="room-desc"><?= htmlspecialchars($room['description']) ?></p>

            <div class="room-lists">
                <div>
                    <h4>Features</h4>
                    <ul>
                        <?php foreach ($room['features'] as $feature): ?>
                            <li><?= htmlspecialchars($feature) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <h4>Amenities</h4>
                    <ul>
                        <?php foreach ($room['amenities'] as $amenity): ?>
                            <li><?= htmlspecialchars($amenity) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
</section>

<footer>
    <p>&copy; 2026 Modern Kubo Hotel.</p>
</footer>

<script src="JavaScriptt.js"></script>
</body>
</html>