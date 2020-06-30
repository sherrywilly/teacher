<?php
include 'header.php';
?>
<div class="container" style="margin-top: 30px">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9 text-primary text-center">
                    <h1>Students List</h1>
                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="stud_table">
                
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {

        $.ajax({
            type: "post",
            url: "get_stud.php",
            dataType: "html",
            success: function(response) {
            $('#stud_table').html(response);

            }
        });

    });
</script>




<?php
include 'footer.php';

?>