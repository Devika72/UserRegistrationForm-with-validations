$(document).ready(function() {
    $('#registrationForm').on('submit', function(e) {
        e.preventDefault();
        var firstName = $('#first_name').val();
        var lastName = $('#last_name').val();
        var email = $('#email').val();
        var phoneNumber = $('#phone_number').val();
        var profilePic = $('#profile_pic').prop('files')[0];
        var gender = $('#gender').val();
        var password = $('#password').val();

        // Perform client-side validations
        var valid = true;

        if (firstName.length < 3) {
            $('#firstNameError').text('First name should be at least 3 characters');
            $('#first_name').focus();
            valid = false;
        } else {
            $('#firstNameError').text('');
        }

        if (lastName.length < 3) {
            $('#lastNameError').text('Last name should be at least 3 characters');
            $('#last_name').focus();
            valid = false;
        } else {
            $('#lastNameError').text('');
        }

        // Validate email format
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $('#emailError').text('Invalid email format');
            $('#email').focus();
            valid = false;
        } else {
            $('#emailError').text('');
        }

        // Validate phone number format
        var phoneRegex = /^[0-9]{10}$/;
        if (!phoneRegex.test(phoneNumber)) {
            $('#phoneError').text('Invalid phone number format');
            $('#phone_number').focus();
            valid = false;
        } else {
            $('#phoneError').text('');
        }

        // Validate password length
        if (password.length < 8) {
            $('#passwordError').text('Password should be at least 8 characters');
            $('#password').focus();
            valid = false;
        } else {
            $('#passwordError').text('');
        }

        // Validate profile picture size
        var maxFileSize = 2 * 1024 * 1024; 
        if (profilePic && profilePic.size > maxFileSize) {
            $('#profilePicError').text('Profile picture size should be up to 2MB');
            valid = false;
        } else {
            $('#profilePicError').text('');
        }

        if (valid) {
            // Check if email exists
            $.ajax({
                url: 'check_email.php',
                type: 'POST',
                data: { email: email },
                success: function(response) {
                    if (response === 'exists') {
                        $('#emailError').text('Email already exists');
                        $('#email').focus();
                    } else {
                        // Email does not exist, proceed with form submission
                        var formData = new FormData();
                        formData.append('first_name', firstName);
                        formData.append('last_name', lastName);
                        formData.append('email', email);
                        formData.append('phone_number', phoneNumber);
                        formData.append('profile_pic', profilePic);
                        formData.append('gender', gender);
                        formData.append('password', password);

                        $.ajax({
                            url: 'reg.php',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                // Handle the success response
                                window.location.href = 'welcome.php';
                            },
                            error: function(xhr, status, error) {
                                // Handle the error response
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                }
            });
        }
    });
});
