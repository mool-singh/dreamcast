<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        label.error {
            color: red !important;
            display: block !important;
        }
    </style>
</head>

<body class="">

    <div class="container p-4">

        <div class="row">

            <div class="col-lg-5 m-lg-auto col-lg-offset-8 col-12">
                <form id="userForm">
                    <div class="card p-3">
                        <h4 class="text-center text-uppercase fw-bold" id="title">User Form</h4>

                       

                        <div class="row">

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter your name"
                                        class="form-control">
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email"
                                        placeholder="Enter your email address" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="phone">Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">+91</span>
                                        <input type="text" name="phone" id="phone"
                                            placeholder="Enter your phone number" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" placeholder="Write something about yourselft here.." class="form-control"></textarea>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="role">Role</label>
                                    <select class="form-select" name="role" id="role">
                                        <option value="">Select your role</option>
                                        @if(!empty($roles))
                                            @foreach($roles as $role)

                                            <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>

                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="image" class="d-block">Image</label>
                                    <input type="file" name="image" id="image" accept="image/*">
                                </div>
                            </div>

                            <div class="col-12 text-center mt-2">
                                <button id="sub-btn" class="btn btn-success px-3">Submit</button>
                            </div>



                        </div>

                    </div>
                </form>
            </div>

            <h5 class="my-2">Users List</h5>

            <div class="col-12 user-div">

                            

            </div>

        </div>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
<script>
    $.validator.addMethod("filesize", function(value, element, param) {
        if (element.files.length > 0) {
            return element.files[0].size <= param;
        }
        return true;
    }, "Image size must be less than 2 mb.");


    $.validator.addMethod("indianPhone", function(value, element) {
        return this.optional(element) || /^[6-9]\d{9}$/.test(value);
    }, "Please enter a valid 10-digit Indian phone number");

    $(document).ready(function() {

        $("#userForm").validate({
            rules: {
                name:{
                    required:true,
                    maxlength:255,
                },
                email:{
                    required:true,
                    email:true,
                },
                phone:{
                    required:true,
                    indianPhone:true
                },
                role:{
                    required:true
                },
                description:{
                    maxlength:1000,
                },
                image:{
                    required:true,
                    extension:"png|jpg|jpeg",
                    filesize: 1048576*2,
                }
            },
            messages: {
                name: {
                    required: "Please enter your name.",
                    maxlength: "Name cannot be longer than 255 characters."
                },
                email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address."
                },
                phone: {
                    required: "Please enter your phone number.",
                    indianPhone: "Please enter a valid 10-digit Indian phone number"
                },
                role: {
                    required: "Please specify your role."
                },
                description: {
                    maxlength: "Description cannot be longer than 1000 characters."
                },
                image: {
                    required: "Please upload an image.",
                    extension: "Only PNG, JPG, and JPEG files are allowed.",
                    filesize: "File size must be less than 2 MB."
                }
            },
            errorPlacement: function(error, element) {
                if ($(element).attr('name') == 'phone') {
                    error.appendTo(element.parent().parent());
                } else {
                    error.appendTo(element.parent());
                }
            },
            submitHandler: function(form) {

                startLoader();

                var formData = new FormData(form);

                $(".alert").remove();
                $(".error").remove();

                $.ajax({
                    url: "{{ route('users.save') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        stopLoader();
                        $(".user-div").html(response.html);
                        $("#userForm").trigger('reset');
                    },
                    error: function(xhr) {
                        
                        stopLoader();
                        if (xhr.status === 422) {
                            $("#title").after(
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong> Please check your form carefully<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                                );

                            

                            var errors = xhr.responseJSON.errors;

                            $.each(errors, function(key, messages) {
                                var element = $('[name="' + key + '"]');

                                if (key == 'phone') {
                                    element.parent().parent().append(
                                        '<label class="error">' + messages[
                                            0] + '</label>');
                                } else {
                                    element.parent().append(
                                        '<label class="error">' + messages[
                                            0] + '</label>');
                                }
                            });


                        } else {

                            $("#title").after(
                                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong> Something went wrong, Please try again.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                                );
                        }
                    }
                })

            }
        })

    })


    function startLoader()
    {
        $("#sub-btn").attr('disabled',true);
        $("#sub-btn").html('<i class="fa fa-spinner fa-spin"></i>');

    }
    
    function stopLoader()
    {
        $("#sub-btn").attr('disabled',false);
        $("#sub-btn").html('Submit');
    }

</script>

</html>
