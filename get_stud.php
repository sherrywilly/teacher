<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id='st_table'>
            <thead>
                <tr>
                    <th>roll no</th>
                    <th>name</th>
                    <th>address</th>
                    <th>phone no</th>
                    <th>email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';
                session_start();
                $query = "select * from tbl_student where student_grade_id = ".$_SESSION["grade_id"]."";
                $res = mysqli_query($conn, $query);
                if (mysqli_num_rows($res) > 0) {
                    while ($rs = mysqli_fetch_assoc($res)) {
                ?>
                        <tr>
                            <td><?php echo $rs['student_roll_number']; ?></td>
                            <td><?php echo $rs['student_name']; ?></td>
                            <td><?php echo $rs['student_address']; ?></td>
                            <td><?php echo $rs['student_phno']; ?></td>
                            <td><?php echo $rs['student_emailid']; ?></td>
                        </tr>
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
        $('#st_table').DataTable();

    })
</script>