<?php
include 'header.php';
include 'config.php';
?>
<div class="container" style="margin-top: 30px">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9 text-info text-center"><strong>
                        <h3>ATTENDANCE LIST</h3>
                    </strong>
                </div>
                <div class="col-md-3">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" id="add_button">Take attendance </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="message_operation"></div>
        <div id="atable"></div>
    </div>
    <?php

    include 'footer.php';


    ?>
    <div id="takeatten" class="modal fade" role="dialog">
        <div class="modal-dialog modal-auto">
            <form method="post" id="att_form">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Header</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-start">
                                    <h4>Date</h4><span style="color: red">* &nbsp;</span> <?php echo date("Y/m/d"); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="sem">sem:</label>
                                    <select class="form-control" name="sem" id="semester" required>
                                        <option selected disabled value="">select semester </option>
                                        <option value="sem1">sem 1</option>
                                        <option value="sem2">sem 2</option>
                                        <option value="sem3">sem 3</option>
                                        <option value="sem4">sem 4</option>
                                        <option value="sem5">sem 5</option>
                                        <option value="sem6">sem 6</option>

                                    </select>

                                </div>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>roll no</th>
                                        <th>name</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * from tbl_student where student_grade_id = " . $_SESSION["grade_id"] . "";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($dom = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $dom['student_roll_number'];   ?></td>
                                                <td><?php echo $dom['student_name'];  ?>
                                                    <input type="hidden" name="student_id[]" value="<?php echo $dom["student_id"]; ?>">
                                                </td>
                                                <td> <input type="radio" name="att_status<?php echo $dom["student_id"]; ?>" value="Present"></td>
                                                <td><input type="radio" name="att_status<?php echo $dom["student_id"]; ?>" value="Absent" checked></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="grade_id" value="<?php echo $_SESSION['grade_id'];  ?>">
                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" />
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "get_atten.php",
                dataType: "html",
                success: function(response) {
                    $("#atable").html(response);
                }
            });

            function fetch() {
                $.ajax({
                    type: "post",
                    url: "get_atten.php",
                    dataType: "html",
                    success: function(response) {
                        $("#atable").html(response);
                    }
                });
            }
            $('#add_button').click(function() {
                $('.modal-title').text('Take Attendance');


                $('#takeatten').modal('show');


            });
            $('#att_form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "attendance_action.php",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('#button_action').val('Validate...');
                        $('#button_action').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        // alert('a');
                        $('#button_action').attr('disabled', false);
                        $('#button_action').val($('#action').val());
                        if (data.success) {
                            $('#message_operation').html('<div class="alert alert-success">' + data.success + '</div>');
                            $('#takeatten').modal('hide');
                            $('#att_form').trigger("reset");
                            fetch();
                            setTimeout(function() {
                                $('#message_operation').fadeOut("slow");
                            }, 2000);

                        }
                        if (data.error) {
                            if (data.error_attendance_date != '') {
                                $('#message_operation').fadeIn().html('<div class="alert alert-danger">' + data.error_attendance_date + '</div>');
                                //$('#message_operation').fadeIn().html('<div class="alert alert-danger">' + data.error_semester + '</div>');

                                $('#att_form').trigger("reset");
                                setTimeout(function() {
                                    $('#message_operation').fadeOut("slow");
                                }, 2000);






                            } else {
                                $('#message_operation').text('');
                            }


                        }
                    }
                })
            });
        });
    </script>