<?php
include 'config.php';
include 'header.php';
$teacher = $_SESSION['teacher_id'];
$sql = "select * from tbl_teacher where teacher_id = '$teacher'";
$result = mysqli_query($conn, $sql);


?>


<div class="container mt-5">
    <div id="message_operation"></div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary">
                    <h4 style="color:white;font-weight:200px">Update Details</h4>
                </div>
                <div class="card-body">
                    <?php
                    if ($ts = mysqli_fetch_assoc($result)) { ?>
                        <form action="post" autocomplete="off" id="t_update">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <label for="teacher_name">name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="tname" id="teacher_name" class="form-control" value="<?php echo $ts['teacher_name'];  ?>" required>
                                        <input type="hidden" name="tid" id="teacher_id" class="form-control" value="<?php echo $ts['teacher_id'];  ?>" required>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <label for="temail">email <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="email" name="temail" id="temail" class="form-control" value="<?php echo $ts['teacher_emailid']; ?>" required>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <label for="tphone">phone <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" name="tphone" id="tphone" class="form-control" value="<?php echo $ts['teacher_phno']; ?>" required>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <label for="pass">password <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="password" name="tpass" id="pass" class="form-control" placeholder="if you like to change please fill it ">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-8">
                                        <input type="hidden" name="action" id="action" value="Add" />
                                        <input type="submit" class="btn btn-primary" name="Submit" id="submit" class="form-control" value="Update">

                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                    ?>
                </div>


            </div>

            <div class="col-md-2"></div>



        </div>


    </div>

    <?php
    include 'footer.php';
    ?>

    <script>
        $(document).ready(function() {
            $('#t_update').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    type: "post",
                    url: "update_action.php",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(data) {
                        if (data.success) {
                            $('#message_operation').fadeIn().html('<div class="alert alert-success" >' + data.success + '</div>');

                            setTimeout(function() {
                                $('#message_operation').fadeOut("slow");
                            }, 2000);

                        }

                    }
                });
            });



        });
    </script>