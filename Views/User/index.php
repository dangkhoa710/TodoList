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
    <style>
        .bg-done{
            background-color: #f5c2a3 !important;
        }
        .bg-active{
            background-color: #c9d8e8 !important;
        }
        .todo:hover {
            background-color: #c9d8e8 !important;
            cursor: pointer;
        }
    </style>

</head>
<body>
<div class="container-fluid p-5">
    <div>
        <h1>TodoList</h1>
    </div>
    <div class="row">
        <div class="col-md-5 pr-3 list-todo">
            <?php
            $done = null;
            foreach ($works as $key => $work) {
                if($work['name'] != null) {
                    $done = $work['id_status'] == 3 ? 'bg-done' : null;
                    echo '<div onclick="detail('.$work['id'].')" class="border rounded bg-light ' . $done . ' p-3 todo todo-id-' . $work['id'] . '" id="' . $work['id'] . '">
                         <div class="row">
                            <div class="col-md-2 col-sm-1">
                                <button class="btn btn-info done done-' . $work['id'] . '">DONE</button>
                            </div>
                            <div class="col-md-5 col-sm-3">
                                <span class="ml-2" id="name-' . $work['id'] . '"> ' . $work['name'] . '</span>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <input type="text" class="form-control" id="status-' . $work['id'] . '" value="' . $work['name_status'] . '" readonly>
                            </div>
                            <div class="col-md-2 col-sm-1">
                                <button class="btn btn-danger btn-delete">DEL</button>
                            </div>
                        </div>
                    </div>';
                }
            }
            ?>
            <div class="mt-3 ml-3" id="button-list-todo">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">
                   ADD
                </button>
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Add work</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <form method="POST" action="#" id="form-add">
                            <div class="modal-body form-group">
                                <h5 class="mt-2">Name</h5>
                                <input type="text" id="name" name="name" class="form-control" required>
                                <h5 class="mt-2">Date</h5>
                                <input type="text" id="datepicker-add" name="datepicker-add" class="form-control" required>
                                <h5>Content</h5>
                                <textarea class="w-100 p-3" id="content-add" name="content-add" rows="4" required></textarea>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="submit-add">ADD</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 border border-primary rounded p-3 form-group">
            <form id = "form-update">
            <div class="row">
                <div class="col-md-12">
                    <h5>Name</h5>
                    <input type="text" id="name-update" name="name-update" class="form-control" required>
                </div>
                <div class="col-md-5">
                    <h5>Status</h5>
                    <select id="status-update" name="status-update" class="form-control" required>
                        <option value=""></option>
                    <?php
                    foreach ($status as $key => $st) {
                        echo '<option value="'.$st['id'].'">'.$st['name_status'].'</option>';
                    }
                    ?>
                    </select>
                    <h5 class="mt-2">Date</h5>
                    <input type="text" id="datepicker-update" name="datepicker-update" class="form-control" required>
                </div>
                <div class="col-md-7">
                    <h5>Content</h5>
                    <div id="content-detail">
                        <textarea class="border border-primary rounded w-100 p-3" id="content-update" name="content-update" rows="3" required ></textarea>
                    </div>
                </div>
                <input type="hidden" id="id-update">
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-warning">APPLY</button>
            </div>
            </form>
        </div>
    </div>
</div>
</body>

<script>
    $(document).ready(function () {

        $('#form-add').submit(function(event) {
            event.preventDefault();
            if($("#name").val() == '' || $("#datepicker-add").val() == '' || $("#content-add").val() == '' )
            {
                if ($("#name").val() == '')
                {
                    $("#name").addClass('border border-danger')
                }
                if ($("#datepicker-add").val() == '')
                {
                    $("#datepicker-add").addClass('border border-danger')
                }
                if ($("#content-add").val() == '')
                {
                    $("#content-add").addClass('border border-danger')
                }
            }
            else {
                $('#myModal').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost/TodoList/?controller=todo&action=store',
                    data: $('#form-add').serialize(),
                    success: function (response) {
                        if (response.status == 201) {
                            alert('success');
                            $('#form-add')[0].reset();
                            $("#name").removeClass('border border-danger')
                            $("#datepicker-add").removeClass('border border-danger')
                            $("#content-add").removeClass('border border-danger')
                            $(
                                '<div class="border rounded bg-light p-3 todo todo-id-' + response.data['id'] + '" id="' + response.data['id'] + '" onclick="detail(' + response.data['id'] + ')">' +
                                '<div class="row"><div class="col-md-2 col-sm-1"><button type="button" class="btn btn-info done done-' + response.data['id'] + '" onclick="done(' + response.data['id'] + ')">DONE</button>' +
                                '</div>' +
                                '<div class="col-md-5 col-sm-3"><span class="ml-2" id="name-' + response.data['id'] + '"> ' + response.data['name'] + '</span></div>' +
                                '<div class="col-md-3 col-sm-3"><input type="text" class="form-control" id="status-' + response.data['id'] + '" value="Planning" readonly></div>' +
                                '<div class="col-md-2 col-sm-1"><button class="btn btn-danger btn-delete">DEL</button></div></div></div>').insertBefore("#button-list-todo");
                        } else {
                            alert('not success');
                        }
                    }
                });
            }
        });

        $("#datepicker-add").datepicker({
            format: "yyyy-mm-dd",
        });
        $("#datepicker-update").datepicker({
            format: "yyyy-mm-dd",
        });

        $('#form-update').submit(function(event) {
            event.preventDefault();
            var id = $('#id-update').val();
            var name_update = $("#name-update").val();
            var id_status = $("#status-update").val();
            var name_status = $("#status-update option:selected").text();
            var date = $("#datepicker-update").datepicker('getDate');
            var content = $("#content-update").val();
            if(name_update == '' || id_status == '' || $("#datepicker-update").val() == '' || content == '' )
            {
                if (name_update == '')
                {
                    $("#name-update").addClass('border border-danger')
                }
                if (id_status == '')
                {
                    $("#status-update").addClass('border border-danger')
                }
                if ($("#datepicker-update").val() == '')
                {
                    $("#datepicker-update").addClass('border border-danger')
                }
                if (content == '')
                {
                    $("#content-update").addClass('border border-danger')
                }
            }
            else{
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost/TodoList/?controller=todo&action=update&id=' + id,
                    data: $('#form-update').serialize(),
                    success: function (response) {
                        if (response.status == 201) {
                            alert('success');
                            $("#name-" + id).text(name_update);
                            $("#status-" + id).text(name_status);
                            if (id_status == 3) {
                                $(".todo-id-" + id).addClass('bg-done');
                                $("#status-" + id).val('Done')
                            } else {
                                $(".todo-id-" + id).removeClass('bg-done');
                                $("#status-" + id).val(name_status)

                            }
                            $("#name-update").removeClass('border border-danger')
                            $("#status-update").removeClass('border border-danger')
                            $("#datepicker-update").removeClass('border border-danger')
                            $("#content-update").removeClass('border border-danger')
                        } else {
                            alert('not success');
                        }
                    }
                });
            }
        });


        $('.btn-delete').click(function(e) {
            e.stopPropagation();
            var id = $(this).parent().parent().parent().attr('id');
            if(confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost/TodoList/?controller=todo&action=delete&id='+id,
                    success: function(response) {
                        if (response.status == 200)
                        {
                            $("#id-update").val('');
                            $("#name-update").val('');
                            $("#status-update").val('');
                            $("#datepicker-update").val('');
                            $("#content-update").text('');
                            alert('success');
                            $("#"+id).remove();
                        }
                        else
                        {
                            alert('no success');
                        }

                    }
                });
            }
            else
            {
                return false;
            }
        });

        $('.done').on('click', function(e) {
            e.stopPropagation();
            var id = $(this).parent().parent().parent().attr('id');
            done(id,e)
        });
    });
    // $('.todo').on('click', function() {
    //     var id = $(this).attr('id');
    //     detail(id);
    // });
    function detail(id)
    {
        $("#name-update").removeClass('border border-danger')
        $("#status-update").removeClass('border border-danger')
        $("#datepicker-update").removeClass('border border-danger')
        $("#content-update").removeClass('border border-danger')
        $(".todo").removeClass('bg-active');
        $(".todo-id-"+id).addClass('bg-active');
        $.ajax({
            type: 'GET',
            url: 'http://localhost/TodoList/?controller=todo&action=detail&id='+Number(id),
            success: function(response) {
                if (response.status == 200)
                {
                    console.log(response.data);
                    $("#id-update").val(response.data['id']);
                    $("#name-update").val(response.data['name']);
                    $("#status-update").val(response.data['id_status']);
                    $("#datepicker-update").val(response.data['date']);
                    $("#content-detail").empty().append(' <textarea class="border border-primary rounded w-100 p-3" id="content-update" name="content-update" rows="3" required>'+
                        +'</textarea>');
                    $("#content-update").html(response.data['content']);
                }
                else
                {
                    alert('no data');
                }

            }
        });
    }

    function done(id)
    {
        var id_status = $("#status-"+id).val() == 'Done' ? 2 : 3;
        console.log($("#status-"+id).val());
        $.ajax({
            type: 'GET',
            url: 'http://localhost/TodoList/?controller=todo&action=done&id='+id+'&id_status='+id_status,
            success: function(response) {
                if (response.status == 201)
                {
                    if($(".todo-id-"+id).hasClass('bg-done'))
                    {
                        $(".todo-id-"+id).removeClass('bg-done');
                        $("#status-"+id).val('Planning')
                    }
                    else
                    {
                        $(".todo-id-"+id).addClass('bg-done');
                        $("#status-"+id).val('Done')
                    }

                }
                else
                {
                    alert('not success');
                }
            }
        });

    }
</script>
