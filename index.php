<?php
$page_title = "Home";
require_once 'includes/db.php';
require_once 'includes/header.php';

$sql = "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT 3";
$result = mysqli_query($conn, $sql);
?>

<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <div class="hero-line"></div>
        <p class="eyebrow">MACMILLAN COLLEGE EVENTS</p>
        <h1>Discover. Participate.<br><span>Make Your Mark.</span></h1>
        <p class="hero-text">Stay connected with what is happening around campus. Explore upcoming events and register online in just a few simple steps.</p>
        <div class="hero-actions">
            <a href="events.php" class="btn btn-gold btn-lg">Explore Events <i class="bi bi-arrow-right"></i></a>
            <a href="#how-it-works" class="btn btn-outline-light btn-lg">How It Works</a>
        </div>
    </div>
</section>

<section class="quick-strip">
    <div class="container">
        <div class="row g-0">
            <div class="col-md-4 quick-item"><i class="bi bi-calendar-event"></i><div><strong>Upcoming Events</strong><small>See what is coming up</small></div></div>
            <div class="col-md-4 quick-item"><i class="bi bi-pencil-square"></i><div><strong>Easy Registration</strong><small>Register without queuing</small></div></div>
            <div class="col-md-4 quick-item"><i class="bi bi-check-circle"></i><div><strong>Instant Record</strong><small>Your registration is saved</small></div></div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="section-heading d-flex flex-wrap justify-content-between align-items-end gap-3">
            <div>
                <p class="eyebrow text-gold">WHAT'S HAPPENING</p>
                <h2>Upcoming Events</h2>
                <p>Join activities, learning sessions and student experiences happening at the college.</p>
            </div>
            <a href="events.php" class="simple-link">View all events <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row g-4 mt-1">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4">
                        <div class="event-card h-100">
                            <div class="event-visual">
                                <span class="event-icon"><i class="bi bi-calendar2-event"></i></span>
                                <span class="event-date-chip"><?php echo date("d M Y", strtotime($row['event_date'])); ?></span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5><?php echo htmlspecialchars($row['event_name']); ?></h5>
                                <p class="event-location"><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($row['event_venue']); ?></p>
                                <p class="text-muted small flex-grow-1"><?php echo htmlspecialchars($row['event_description']); ?></p>
                                <a href="register.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-primary w-100">Register for Event</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12"><div class="empty-state">No upcoming events right now. Please check again later.</div></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section about-strip" id="how-it-works">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <p class="eyebrow text-gold">HOW IT WORKS</p>
                <h2>From event discovery to registration.</h2>
                <p class="text-muted">The system keeps the process simple for students while making registration records easy to view.</p>
            </div>
            <div class="col-lg-7">
                <div class="steps-grid">
                    <div class="step-box"><span>01</span><div><h5>Browse</h5><p>View available college events.</p></div></div>
                    <div class="step-box"><span>02</span><div><h5>Select</h5><p>Choose the event you want to attend.</p></div></div>
                    <div class="step-box"><span>03</span><div><h5>Register</h5><p>Enter your details and confirm.</p></div></div>
                    <div class="step-box"><span>04</span><div><h5>Recorded</h5><p>Your registration is saved in MySQL.</p></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
