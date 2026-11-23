
USE `modern_kubo_db`;

START TRANSACTION;

-- 1. rooms: new columns used by booking.php and booking_process.php
ALTER TABLE `rooms`
  CHANGE `capacity` `base_capacity` INT(11) NOT NULL,
  ADD COLUMN `room_type`    VARCHAR(50)   NOT NULL DEFAULT 'Standard' AFTER `room_name`,
  ADD COLUMN `max_capacity` INT(11)       NOT NULL DEFAULT 1          AFTER `base_capacity`,
  ADD COLUMN `extra_after`  INT(11)       NOT NULL DEFAULT 0          AFTER `max_capacity`,
  ADD COLUMN `extra_fee`    DECIMAL(10,2) NOT NULL DEFAULT 0.00       AFTER `extra_after`;

-- 2. reservations: pricing breakdown columns
ALTER TABLE `reservations`
  ADD COLUMN `extra_fee_total` DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER `total_amount`,
  ADD COLUMN `downpayment`     DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER `extra_fee_total`,
  ADD COLUMN `balance`         DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER `downpayment`;

-- 3. Rooms: the 7 units shown on rooms.php (ids 1-3 are overwritten, 4-7 are new)
--    extra_fee is 0.00 as a placeholder: set your real per-person fee below.
INSERT INTO `rooms`
  (`room_id`, `room_name`, `room_type`, `description`, `price`, `base_capacity`, `max_capacity`, `extra_after`, `extra_fee`)
VALUES
  (1, 'Standard Room(A)', 'Standard',   'Cozy room for couples, friends, or small groups', 3500.00,  2,  3,  2, 0.00),
  (2, 'Standard Room(B)', 'Standard',   'Cozy room for couples, friends, or small groups', 3500.00,  2,  3,  2, 0.00),
  (3, 'Standard Room(C)', 'Standard',   'Cozy room for couples, friends, or small groups', 3500.00,  2,  3,  2, 0.00),
  (4, 'Family Room(A)',   'Family',     'Spacious room for families and larger groups',    6000.00,  4,  5,  4, 0.00),
  (5, 'Family Room(B)',   'Family',     'Spacious room for families and larger groups',    6000.00,  4,  5,  4, 0.00),
  (6, 'Family Room(C)',   'Family',     'Spacious room for families and larger groups',    6000.00,  4,  5,  4, 0.00),
  (7, 'Event Hall',       'Event Hall', 'Open-air hall for gatherings and celebrations',  15000.00, 30, 40, 30, 0.00)
ON DUPLICATE KEY UPDATE
  `room_name`     = VALUES(`room_name`),
  `room_type`     = VALUES(`room_type`),
  `description`   = VALUES(`description`),
  `price`         = VALUES(`price`),
  `base_capacity` = VALUES(`base_capacity`),
  `max_capacity`  = VALUES(`max_capacity`),
  `extra_after`   = VALUES(`extra_after`),
  `extra_fee`     = VALUES(`extra_fee`);

-- 4. Fill the new money columns for reservations made before this update (50% downpayment)
UPDATE `reservations`
SET `downpayment` = ROUND(`total_amount` * 0.50, 2),
    `balance`     = `total_amount` - ROUND(`total_amount` * 0.50, 2)
WHERE `downpayment` = 0;

COMMIT;

-- To set an extra-guest fee later, for example 500 pesos per extra person in Standard rooms:
-- UPDATE `rooms` SET `extra_fee` = 500.00 WHERE `room_type` = 'Standard';