<?php
include 'config.php';
include 'header.php';


?>
<div class="container mt-md-5">
    <div class="row">


        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-center">
                    Attendance Report

                </div>
                <div class="card-body">
                    <form action="get-report.php" autocomplete="off" id="report" method="post">
                        <div class="form-group">

                            <label for="grade">grade</label>
                            <input type="text" class="form-control" name="grade" id="grade-name" value="bca-2020" readonly>
                            <input type="hidden" class="form-control" name="grade-id" id="grade-id" value="<?php echo $_SESSION['grade_id'];  ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="sem">semester</label>
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
                        <div class="form-group" style="margin-right:10px">
                            <input type="submit" name="submit" value="get Report" class=" btn btn-primary" style="width:100%" id="submit">
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <div class="col-md-4"></div>

    </div>



</div>


<?php
include 'footer.php';

?>

<script>
    // $(document).ready(function() {
    //     $("#report").on('submit',function(event){
    //     event.preventDefault();
    //    $.ajax({
    //        type: "post",
    //        url: "get-report.php",
    //        data: "json",
    //        dataType: "dataType",
    //        success: function (response) {
               
    //        }
    //    });



    // });
    // });
</script>