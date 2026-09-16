<?php
$page_title = "Events";
require_once 'includes/db.php';
require_once 'includes/header.php';

$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = mysqli_query($conn, $sql);
?>

<section class="page-banner">
    <div class="container">
        <div class="hero-line"></div>
        <p class="eyebrow">MACMILLAN COLLEGE</p>
        <h1>Upcoming Events</h1>
        <p>Find an event that interests you and reserve your place online.</p>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="row g-4">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="event-card h-100">
                            <!-- <div class="event-visual event-visual-large">
                                <span class="event-icon"><i class="bi bi-calendar2-week"></i></span>
                                <span class="event-date-chip"><?php echo date("d M Y", strtotime($row['event_date'])); ?></span>
                            </div> -->
                          <!-- Event Image -->
                        <div class="position-relative">
                            <img src="images/<?php echo htmlspecialchars($row['event_image']); ?>"
                                 class="card-img-top"
                                 alt="<?php echo htmlspecialchars($row['event_name']); ?>"
                                 style="height: 140px; object-fit: cover;">

                            <!-- Date -->
                            <span class="event-date-chip position-absolute top-0 end-0 m-2">
                                <?php echo date("d M Y", strtotime($row['event_date'])); ?>
                            </span>
                        </div>
                        
                            <div class="card-body d-flex flex-column">                              
                                <span class="small text-gold fw-semibold text-uppercase">College Event</span>
                                <h4 class="mt-2"><?php echo htmlspecialchars($row['event_name']); ?></h4>
                                <div class="event-meta"><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($row['event_venue']); ?></div>
                                <p class="text-muted small mt-3 flex-grow-1"><?php echo htmlspecialchars($row['event_description']); ?></p>
                                <a href="register.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-primary w-100">Register for Event <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12"><div class="empty-state">No events have been added yet.</div></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
