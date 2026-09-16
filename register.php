<?php
$page_title = "Register";
require_once 'includes/db.php';
require_once 'includes/header.php';

$selected_event = isset($_GET['event_id']) ? (int) $_GET['event_id'] : 0;
$status = $_GET['status'] ?? '';

$events_result = mysqli_query($conn, "SELECT event_id, event_name, event_description, event_date, event_venue FROM events ORDER BY event_date ASC");
?>

<section class="page-banner register-banner">
    <div class="container">
        <div class="hero-line"></div>
        <p class="eyebrow">MACMILLAN COLLEGE</p>
        <h1>Event Registration</h1>
        <p>Fill in your details and register for an upcoming college event.</p>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <?php if ($status === 'success'): ?>
            <div class="alert alert-success status-alert" id="statusAlert"><i class="bi bi-check-circle-fill me-2"></i><strong>Registration successful!</strong> Your details have been saved.</div>
        <?php elseif ($status === 'error'): ?>
            <div class="alert alert-danger status-alert" id="statusAlert"><i class="bi bi-exclamation-triangle-fill me-2"></i>Something went wrong. Please try again.</div>
        <?php elseif ($status === 'invalid'): ?>
            <div class="alert alert-warning status-alert" id="statusAlert"><i class="bi bi-exclamation-circle-fill me-2"></i>Please check your details and complete all required fields.</div>
        <?php endif; ?>

        <div class="row g-4 g-xl-5 align-items-stretch">
            <div class="col-lg-8">
                <div class="form-card h-100">
                    <div class="form-card-header">
                        <div class="section-icon"><i class="bi bi-person-fill"></i></div>
                        <div><h3>Student Registration</h3><p>Enter your information below.</p></div>
                    </div>

                    <form action="process_registration.php" method="POST" id="registrationForm" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="student_name">Student Name <span>*</span></label>
                                <input type="text" class="form-control" id="student_name" name="student_name" placeholder="Enter your full name" required minlength="3">
                                <div class="invalid-feedback">Please enter your full name.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="admission_number">Admission Number <span>*</span></label>
                                <input type="text" class="form-control" id="admission_number" name="admission_number" placeholder="e.g. CS11/005/24" required>
                                <div class="invalid-feedback">Please enter your admission number.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="email">Email Address <span>*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="phone">Phone Number <span>*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="07XXXXXXXX" required pattern="^[0-9+\s-]{7,15}$">
                                <div class="invalid-feedback">Please enter a valid phone number.</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="course">Course <span>*</span></label>
                                <input type="text" class="form-control" id="course" name="course" placeholder="Enter your course" required>
                                <div class="invalid-feedback">Please enter your course.</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="event_id">Select Event <span>*</span></label>
                                <select class="form-select" id="event_id" name="event_id" required>
                                    <option value="" disabled <?php echo $selected_event === 0 ? 'selected' : ''; ?>>Choose an event...</option>
                                    <?php while ($ev = mysqli_fetch_assoc($events_result)): ?>
                                        <option
                                            value="<?php echo $ev['event_id']; ?>"
                                            data-name="<?php echo htmlspecialchars($ev['event_name']); ?>"
                                            data-description="<?php echo htmlspecialchars($ev['event_description']); ?>"
                                            data-venue="<?php echo htmlspecialchars($ev['event_venue']); ?>"
                                            data-date="<?php echo $ev['event_date']; ?>"
                                            <?php echo $selected_event === (int)$ev['event_id'] ? 'selected' : ''; ?>
                                        >
                                            <?php echo htmlspecialchars($ev['event_name']); ?> — <?php echo date('d M Y', strtotime($ev['event_date'])); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="invalid-feedback">Please choose an event.</div>
                            </div>
                        </div>

                        <div class="selection-hint" id="selectionHint">
                            <i class="bi bi-calendar2-event"></i>
                            <div><strong>Select an event to see more details</strong><span>Event date, venue and description will appear on the right.</span></div>
                        </div>

                        <div class="form-actions">
                            <a href="events.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Back to Events</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i> Confirm Registration</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="selected-event-card h-100" id="selectedEventCard">
                    <div class="selected-event-header"><i class="bi bi-calendar2-week"></i><span>Selected Event</span></div>
                    <div class="selected-event-body" id="selectedEventBody">
                        <div class="event-empty-state" id="eventEmptyState">
                            <div class="big-calendar-icon"><i class="bi bi-calendar-event"></i></div>
                            <h4>No event selected</h4>
                            <p>Please select an event from the dropdown to view the details.</p>
                        </div>

                        <div class="event-details" id="eventDetails" style="display:none;">
                            <div class="detail-icon"><i class="bi bi-calendar-check"></i></div>
                            <span class="detail-label">EVENT</span>
                            <h3 id="selectedEventName"></h3>
                            <div class="detail-row"><i class="bi bi-geo-alt"></i><span id="selectedEventVenue"></span></div>
                            <div class="detail-row"><i class="bi bi-calendar3"></i><span id="selectedEventDate"></span></div>
                            <p id="selectedEventDescription" class="selected-description"></p>
                        </div>

                        <div class="selected-card-motto"><span></span><em>Great Events. Greater Opportunities.</em><span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirm-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel"><i class="bi bi-check-circle me-2"></i>Confirm Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="confirmModalBody">Please review your details before submitting.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Go Back</button>
                <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Yes, Register</button>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
<script src="js/validation.js"></script>
