<?php
if (isset($_GET['alert'])) {
    switch ($_GET['alert']) {
        case 'log_s':
?>
            <script>
                swal('Welcome!', ' <?php echo $name; ?>', 'success');
            </script>
            <?php
            break;

        case 'log_f':
            $message = $_GET["q"];
            if ($message === "wp") {
            ?>
                <script>
                    swal('Login failed', 'Wrong Password!', 'error');
                </script>
            <?php
            } else {
            ?>
                <script>
                    swal('Login failed', 'Invalid User', 'error');
                </script>
            <?php
            }
            break;

        case 'logout_s':
            ?>
            <script>
                swal('Logged Out Successfully!', '', 'success');
            </script>
        <?php
            break;

        case 'p_f':
        ?>
            <script>
                swal('Passwords do not match ', '', 'error');
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

        case 'p_r':
        ?>
            <script>
                swal('Password Updated', '', 'success');
            </script>
        <?php
            break;

        case 'no_u':
        ?>
            <script>
                swal('Email Not Found', '', 'error');
            </script>
        <?php
            break;

        case 'no_u':
        ?>
            <script>
                swal('Email Not Found', '', 'error');
            </script>
        <?php
            break;

        case 'p_e':
        ?>
            <script>
                swal('Pin do not match', 'check and try again', 'error');
            </script>
        <?php
            break;

        case 'e':
        ?>
            <script>
                swal('Something went wrong', 'try again', 'error');
            </script>
<?php
            break;
    }
}

?>