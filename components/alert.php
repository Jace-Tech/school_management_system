<?php

if (isset($_COOKIE['email'])) {
    $email = $_COOKIE['email'];
    $result = $conn->prepare("SELECT `name` FROM `login` WHERE `email` = ?");
    $result->execute([$email]);

    $row = $result->fetch();
    extract($row);

    if (isset($_GET['alert'])) {
        switch ($_GET['alert']) {
            case 'log_s':
            ?>
                <script>
                    swal('Welcome!', ' <?php echo $name; ?>', 'success');
                </script>
            <?php
                break;

            case 's_e':
            ?>
                <script>
                    swal('Student Already Exists', '', 'error');
                </script>
            <?php
                break;

            case 'b_a':
            ?>
                <script>
                    swal('Book Added', '', 'success');
                </script>
            <?php
                break;

            case 'b_e':
            ?>
                <script>
                    swal('Book Updated', '', 'success');
                </script>
            <?php
                break;

            case 'u_e':
            ?>
                <script>
                    swal('Uniform Updated', '', 'success');
                </script>
            <?php
                break;

            case 'u_a':
            ?>
                <script>
                    swal('Uniform Added', '', 'success');
                </script>
            <?php
                break;

            case 'b_d':
            ?>
                <script>
                    swal('Book Deleted', '', 'success');
                </script>
            <?php
                break;

            case 'u_d':
            ?>
                <script>
                    swal('Uniform Deleted', '', 'success');
                </script>
            <?php
                break;

            case 'b_a':
            ?>
                <script>
                    swal('Book Added', '', 'success');
                </script>
            <?php
                break;

            case 't_e':
            ?>
                <script>
                    swal('Teacher Already Exists', '', 'error');
                </script>
            <?php
                break;

            case 'e_e':
            ?>
                <script>
                    swal('Event Already Exists', '', 'error');
                </script>
            <?php
                break;

            case 'f_l':
            ?>
                <script>
                    swal('Image Size Too Large', '', 'error');
                </script>
            <?php
                break;

            case 'reg_f':
            ?>
                <script>
                    swal('Something Went Wrong', 'Try again later', 'error');
                </script>
            <?php
                break;

            case 'e':
            ?>
                <script>
                    swal('Something Went Wrong', 'Try again later', 'error');
                </script>
            <?php
                break;

            case 'reg_s':
            ?>
                <script>
                    swal('Registration Successful', '', 'success');
                </script>
            <?php
                break;

            case 'e_s':
            ?>
                <script>
                    swal('Event Created', '', 'success');
                </script>
            <?php
                break;

            case 'c_a':
            ?>
                <script>
                    swal('Course Added', '', 'success');
                </script>
            <?php
                break;

            case 't_s':
            ?>
                <script>
                    swal('Teacher Added', '', 'success');
                </script>
            <?php
                break;

            case 'tt_s':
            ?>
                <script>
                    swal('Teacher\'s Table Cleared', '', 'success');
                </script>
            <?php
                break;

            case 'et_s':
            ?>
                <script>
                    swal('Event\'s Table Cleared', '', 'success');
                </script>
            <?php
                break;

            case 'st_s':
            ?>
                <script>
                    swal('Student\'s Table Cleared', '', 'success');
                </script>
            <?php
                break;

            case 'up_f':
            ?>
                <script>
                    swal("Couldn't Upload Image", 'Try again later', 'error');
                </script>
            <?php
                break;

            case 'upd_s':
            ?>
                <script>
                    swal("Updated Successful", '', 'success');
                </script>
            <?php
                break;

            case 'pd_s':
            ?>
                <script>
                    swal("Profile Deleted", '', 'success');
                </script>
            <?php
                break;

            case 'md_s':
            ?>
                <script>
                    swal("Message Deleted", '', 'success');
                </script>
            <?php
                break;

            case 'te_s':
            ?>
                <script>
                    swal("Table Emptied", '', 'success');
                </script>
            <?php
                break;

            case 'cd_s':
            ?>
                <script>
                    swal("Course Deleted", '', 'success');
                </script>
            <?php
                break;

            case 'ed_s':
            ?>
                <script>
                    swal("Event Deleted", '', 'success');
                </script>
            <?php
                break;

            case 'e_s':
            ?>
                <script>
                    swal("Course Updated", '', 'success');
                </script>
            <?php
                break;

            case 'f_t':
            ?>
                <script>
                    swal("Upload Failed", 'File type not supported', 'error');
                </script>
            <?php
                break;

            case 'td_s':
            ?>
                <script>
                    swal("Teacher Deleted", '', 'success');
                </script>
<?php
                break;
        }
    }
}
