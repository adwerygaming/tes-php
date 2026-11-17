<?php
session_start();
include '../config/koneksi.php';
include '../functions/checkAttendanceCode.php';

$attendance_code = $_POST['the_code'];

if (empty($attendance_code)) {
    header("Location: ../dashboard/index.php?err_code=not_satisfied");
    exit();
}

$lecture = checkAttendanceCode($attendance_code);

if ($lecture === null) {
    header("Location: ../dashboard/index.php?err_code=invalid_code");
    exit();
}


$pageTitle = 'Dashboard Mahasigma';
include '../components/header.php';
?>

<div class="container flex-grow-1 d-flex flex-column gap-4" style="max-width: 80rem;">
    <section>
        <div class="card shadow-sm">
            <div class="card-body ">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <a>#<?= htmlspecialchars($lecture['id']) ?></a>
                        <h5 class="card-title mb-1"><?= htmlspecialchars($lecture['name']) ?></h5>
                        <p class="card-text text-body-secondary mb-0"><?= htmlspecialchars($lecture['lecturer_name']) ?></p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="flex-grow-1 d-flex">
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Attendance Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM attendances WHERE lecture_id = '" . $lecture['id'] . "'";
                $result = mysqli_query($GLOBALS['config'], $query) or exit("Error query: $query");

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</div>

<?php include '../components/footer.php'; ?>
