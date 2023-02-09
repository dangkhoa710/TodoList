<!DOCTYPE html>
<html>
<head>
    <title>TodoList</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
    />
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2"
            crossorigin="anonymous"
    ></script>
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"
    ></script>
    <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"
    ></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</head>
<body>
<div class="container-fluid p-5">
    <div>
        <h1>TodoList</h1>
    </div>
    <div class="row">
        <div class="col-md-5 pr-3">
            <?php
            foreach ($works as $key => $work) {
                echo '<div class="border rounded bg-light p-3 todo todo-id-' . $work['id'] . '">
                         <div class="row">
                            <div class="col-md-2 col-sm-1">
                                <button class="btn btn-info">DONE</button>
                            </div>
                            <div class="col-md-5 col-sm-3">
                                <span class="ml-2"> ' . $work['name'] . '</span>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <input type="text" class="form-control" id="exampleInputEmail1" value="' . $work['status'] . '" readonly>
                            </div>
                            <div class="col-md-2 col-sm-1">
                                <button class="btn btn-danger">DEL</button>
                            </div>
                        </div>
                    </div>';
            }
            ?>
            <div class="mt-3 ml-3">
                <button type="button" class="btn btn-success">ADD</button>
            </div>
        </div>
        <div class="col-md-7 border border-primary rounded p-3 form-group">
            <div class="row">
                <div class="col-md-5">
                    <h5>Status</h5>
                    <select id="mySelect1" class="form-control">
                        <option value="js">Javascript</option>
                        <option value="css">Css</option>
                        <option value="bootstrap">Bootstrap</option>
                    </select>
                    <h5 class="mt-2">Date</h5>
                    <input type="text" id="datepicker" class="form-control">
                </div>
                <div class="col-md-7">
                    <h5>Content</h5>
                    <textarea class="border border-primary rounded w-100 p-3" id="myTextarea1"
                              rows="3">Line1<br>Line2</textarea>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-warning">APPLY</button>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    $(document).ready(function () {

        $('#myForm').submit(function (e) {
            e.preventDefault();
            var name = $('#name').val();
            var email = $('#email').val();
            $.ajax({
                type: 'POST',
                url: 'submit.php',
                data: {name: name, email: email},
                success: function (data) {
                    alert('Form submitted successfully!');
                }
            });
        });
        $("#datepicker").datepicker({
            format: "dd/mm/yyyy",
        });
    });
</script>
