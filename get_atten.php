<?php
include 'config.php'

?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center table-md" id="att_table">
            <thead>
                <tr>
                    <th> student name</th>
                    <th>roll no</th>
                    <th>grade</th>
                    <th>sem</th>
                    <th>date</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tbl_attendance 
    INNER JOIN tbl_student 
    ON tbl_student.student_id = tbl_attendance.student_id
    INNER JOIN tbl_grade
    ON tbl_grade.grade_id = tbl_attendance.grade_id";
   
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($rs = mysqli_fetch_assoc($result)) {

                        if ($rs['attendance_status'] == "Present") {

                            $status = '<h6><label class="badge badge-pill badge-success">Present</label></h6>';
                        } else if ($rs['attendance_status'] == "Absent") {
                            $status = '<h6><label class="badge badge-pill badge-danger">Absent</label></h6>';
                        }

                ?>
                        <tr>

                            <td><?php echo $rs['student_name']; ?></td>
                            <td><?php echo $rs['student_roll_number']; ?></td>
                            <td><?php echo $rs['grade_name']; ?></td>
                            <td><?php echo $rs['sem']; ?></td>
                            <td><?php echo $rs['attendance_date']; ?></td>
                            <td><?php echo $status; ?></td>
                    <?php

                    }
                }

                    ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#att_table").DataTable();
    })
</script>