<?php
$page_title = "Records";
require_once 'includes/db.php';
require_once 'includes/header.php';

$sql = "SELECT r.registration_id, r.student_name, r.admission_number, r.email, r.phone,
               r.course, e.event_name, r.registration_date
        FROM registrations r
        JOIN events e ON r.event_id = e.event_id
        ORDER BY r.registration_date DESC";
$result = mysqli_query($conn, $sql);
$total = $result ? mysqli_num_rows($result) : 0;
?>

<section class="page-banner records-banner">
    <div class="container">
        <div class="hero-line"></div>
        <p class="eyebrow">ADMIN / RECORDS</p>
        <h1>Registration Records</h1>
        <p>View and search student event registrations stored in the database.</p>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="records-toolbar">
            <div>
                <p class="eyebrow text-gold mb-1">REGISTRATION LIST</p>
                <h2 class="mb-0">Registered Students</h2>
            </div>
            <div class="stat-card"><i class="bi bi-people-fill"></i><div><small>Total Registered</small><strong id="totalCount"><?php echo $total; ?></strong></div></div>
        </div>

        <div class="records-card mt-4">
            <div class="records-search mb-4">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" id="searchInput" placeholder="Search by name, admission number, course or event...">
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="recordsTable">
                    <thead>
                        <tr>
                            <th>Registration ID</th>
                            <th>Student Name</th>
                            <th>Admission Number</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Event</th>
                            <th>Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($total > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><span class="reg-id">#<?php echo str_pad($row['registration_id'], 4, '0', STR_PAD_LEFT); ?></span></td>
                                    <td class="fw-semibold"><?php echo htmlspecialchars($row['student_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['admission_number']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($row['course']); ?></td>
                                    <td><span class="event-table-badge"><?php echo htmlspecialchars($row['event_name']); ?></span></td>
                                    <td><?php echo date('d M Y, g:i a', strtotime($row['registration_date'])); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="8" class="text-center text-muted py-5">No registrations yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="no-results" id="noResultsMsg" style="display:none;"><i class="bi bi-search"></i> No matching registrations found.</div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
<script src="js/search.js"></script>
