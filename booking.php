<?php
session_start();
include __DIR__ . '/database.php';
$rooms = $conn->query("SELECT * FROM rooms ORDER BY room_type, room_name");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking | Modern Kubo</title>
    <link rel="stylesheet" href="Design.css">
    <style>
        .info-box { background:#f7f3ea; border-left:4px solid #8b6b3d; padding:10px 14px; margin:12px 0; }
        #summary  { background:#fff; border:1px solid #ddd; padding:12px 14px; margin:12px 0; }
        #summary p { margin:4px 0; }
        dialog { max-width:560px; border:none; border-radius:10px; padding:24px; }
        dialog::backdrop { background:rgba(0,0,0,.55); }
        dialog ol { padding-left:20px; }
        dialog li { margin-bottom:10px; }
    </style>
</head>
<body>

<?php include __DIR__ . '/navbar.php'; ?>

<section class="form-section">

    <h1>Hotel Reservation</h1>
    <p>Complete the information below to reserve your stay.</p>

    <div class="info-box">
        <strong>Open:</strong> Monday to Sunday &nbsp;|&nbsp;
        <strong>Check-in:</strong> 2:00 PM &nbsp;|&nbsp;
        <strong>Check-out:</strong> 12:00 NN
    </div>

    <form action="booking_process.php" method="POST">

        <h3>Stay Information</h3>

        <label>Check-in Date (from 2:00 PM)</label>
        <input type="date" name="check_in" id="check_in" required>

        <label>Check-out Date (until 12:00 NN)</label>
        <input type="date" name="check_out" id="check_out" required>

        <h3>Room Selection</h3>

        <label>Select Room</label>
        <select name="room_id" id="room_id" required>
            <option value="">Choose a Room</option>
            <?php while ($r = $rooms->fetch_assoc()): ?>
                <option value="<?= (int)$r['room_id'] ?>"
                    data-price="<?= (float)$r['price'] ?>"
                    data-base="<?= (int)$r['base_capacity'] ?>"
                    data-max="<?= (int)$r['max_capacity'] ?>"
                    data-extra-fee="<?= (float)$r['extra_fee'] ?>"
                    data-extra-after="<?= (int)$r['extra_after'] ?>">
                    <?= htmlspecialchars($r['room_name']) ?> (<?= htmlspecialchars($r['room_type']) ?>)
                    - ₱<?= number_format($r['price'], 2) ?>/night
                    - up to <?= (int)$r['max_capacity'] ?> guests
                </option>
            <?php endwhile; ?>
        </select>

        <label>Number of Guests</label>
        <input type="number" name="guests" id="guests" min="1" max="40" required>
        <small id="capacity_note"></small>

        <div id="summary" hidden>
            <p><strong>Booking Estimate</strong></p>
            <p>Room rate: <span id="s_rate"></span> x <span id="s_nights"></span> night(s)</p>
            <p>Extra guest fee: <span id="s_extra"></span></p>
            <p><strong>Total: <span id="s_total"></span></strong></p>
            <p>Required downpayment (50%): <span id="s_down"></span></p>
            <p>Balance upon check-in: <span id="s_balance"></span></p>
        </div>

        <h3>Guest Information</h3>

        <label>Full Name</label>
        <input type="text" name="fullname" required>

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Contact Number</label>
        <input type="tel" name="contact" required>

        <h3>Membership</h3>

        <label>
            <input type="checkbox" name="is_member" value="1">
            I am a registered member.
        </label>

        <h3>Policies and Rules</h3>

        <p>
            Please read the
            <a href="#" id="open_terms">Terms and Conditions</a>
            before continuing.
        </p>

        <label>
            <input type="checkbox" name="agree" id="agree" value="1" required disabled>
            I have read and agree to the hotel's Terms and Conditions.
        </label>

        <button type="submit" class="btn">Continue Reservation</button>

    </form>
</section>

<!-- Terms and Conditions modal -->
<dialog id="terms_modal">
    <h2>Terms and Conditions</h2>
    <p><strong>Check-in:</strong> 2:00 PM &nbsp; <strong>Check-out:</strong> 12:00 NN<br>
       <strong>Operating Days:</strong> Monday to Sunday</p>
    <ol>
        <li><strong>Booking Confirmation &amp; Downpayment:</strong> A downpayment is required to secure and confirm any reservation. The remaining balance must be settled upon check-in.</li>
        <li><strong>Cancellation Policy:</strong> Cancellations made less than 3 days prior to the check-in date are strictly non-refundable.</li>
        <li><strong>Damage Policy:</strong> Guests shall be held liable and billed for any damage or loss caused to hotel property, furniture, or fixtures during their stay.</li>
        <li><strong>No Smoking Policy:</strong> Smoking is strictly prohibited inside all guest rooms. A fine of <strong>₱2,000</strong> will be charged for violations.</li>
        <li><strong>Quiet Hours:</strong> Noise and loud activities must be kept to a minimum after 10:00 PM around the accommodation areas to ensure the peace and comfort of all guests.</li>
    </ol>
    <button type="button" class="btn" id="accept_terms">I Understand and Accept</button>
    <button type="button" class="btn" id="close_terms">Close</button>
</dialog>

<footer>
    <p>&copy; 2026 Modern Kubo Hotel.</p>
</footer>

<script>
const checkIn   = document.getElementById('check_in');
const checkOut  = document.getElementById('check_out');
const roomSel   = document.getElementById('room_id');
const guestsEl  = document.getElementById('guests');
const note      = document.getElementById('capacity_note');
const summary   = document.getElementById('summary');
const peso = n => '₱' + Number(n).toLocaleString('en-PH', {minimumFractionDigits:2, maximumFractionDigits:2});

// No past dates, checkout after checkin
const today = new Date().toISOString().split('T')[0];
checkIn.min = today;
checkIn.addEventListener('change', () => {
    const next = new Date(checkIn.value);
    next.setDate(next.getDate() + 1);
    checkOut.min = next.toISOString().split('T')[0];
    update();
});
checkOut.addEventListener('change', update);
roomSel.addEventListener('change', update);
guestsEl.addEventListener('input', update);

function update() {
    const opt = roomSel.selectedOptions[0];
    if (!opt || !opt.value) { summary.hidden = true; return; }

    const price = +opt.dataset.price, max = +opt.dataset.max;
    const base = +opt.dataset.base, fee = +opt.dataset.extraFee, after = +opt.dataset.extraAfter;

    guestsEl.max = max;
    note.textContent = `Good for ${base} guest(s), maximum of ${max}.` +
        (fee > 0 ? ` Extra guest fee: ${peso(fee)} per person beyond ${after}.` : '');

    const guests = +guestsEl.value || 0;
    const nights = (checkIn.value && checkOut.value)
        ? Math.round((new Date(checkOut.value) - new Date(checkIn.value)) / 86400000) : 0;
    if (nights < 1 || guests < 1) { summary.hidden = true; return; }

    const extraPeople = fee > 0 ? Math.max(0, guests - after) : 0;
    const extra = extraPeople * fee * nights;
    const total = price * nights + extra;

    document.getElementById('s_rate').textContent    = peso(price);
    document.getElementById('s_nights').textContent  = nights;
    document.getElementById('s_extra').textContent   = peso(extra);
    document.getElementById('s_total').textContent   = peso(total);
    document.getElementById('s_down').textContent    = peso(total * 0.5);
    document.getElementById('s_balance').textContent = peso(total - total * 0.5);
    summary.hidden = false;
}

// Terms modal
const modal = document.getElementById('terms_modal');
const agree = document.getElementById('agree');
document.getElementById('open_terms').addEventListener('click', e => { e.preventDefault(); modal.showModal(); });
document.getElementById('close_terms').addEventListener('click', () => modal.close());
document.getElementById('accept_terms').addEventListener('click', () => {
    agree.disabled = false;
    agree.checked = true;
    modal.close();
});
</script>
<script src="JavaScriptt.js"></script>
</body>
</html>