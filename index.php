<?php
include "dbconnect.php";
session_start();


if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="chat.css">
</head>

<body>
    <div class="nav">
        <div class="name">
            <h2 class="">DudesApp</h2>
        </div>
        <div>
            <h3><?php
            echo "Wellcome," . $_SESSION['username'];
            ?></h3>
        </div>
    </div>

    <div class="container">

        <div class="overflow-hidden chat-wrapper">

            <!-- USERS -->

            <div class="col-md-2 users-panel">
                <div class="users container d-flex justify-content-between align-items-center gap-2 border-bottom">
                    <h3 class="py-3">Users</h3>
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="users-list list-group">
                    <?php

                    // $currentUser = $_SESSION['id'];
                    $currentUser = $_SESSION['id'];

                    $q = mysqli_query(
                        $conn,
                        "SELECT * FROM users WHERE id != $currentUser"
                    );

                    while ($user = mysqli_fetch_assoc($q)) {
                        ?>
                        <div class="user-item">
                            <a href="?user=<?php echo $user['id']; ?>" class="list-group-item-action d-flex justify-content-between align-items-center text-dark p-3 border-bottom text-decoration-none">
                                <?php echo $user['username']; ?>
                                <i class="fa-regular fa-user"></i>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <!-- CHAT -->
            <!-- <meta http-equiv="refresh" content="15"> -->



            <div class="chat-panel">

                <div class="chat-header">
                    <?php
                    include "dbconnect.php";
                    if (isset($_GET["user"])) {
                        $id = $_GET["user"];
                        $query = "SELECT * FROM `users` WHERE id = '$id';";
                        $exe = mysqli_query($conn, $query);
                        $user = mysqli_fetch_assoc($exe);
                        echo $user["username"];

                    } else {
                        return;
                    }

                    ?>

                </div>

                <div class="chat-body" id="chatBody">

                    <?php

                    if (isset($_GET['user'])) {
                        $chatUser = (int) $_GET['user'];

                        $query = "
                                SELECT * FROM messages
                                WHERE
                                (user_id = '$currentUser' AND receiver_id = '$chatUser')
                                OR
                                (user_id = '$chatUser' AND receiver_id = '$currentUser')
                                ORDER BY created_at ASC
                                ";

                        $exe = mysqli_query($conn, $query);

                        while ($message = mysqli_fetch_assoc($exe)) {
                            if ($message['user_id'] == $currentUser) {
                                ?>
                                <div class="message sent">
                                    <?php echo htmlspecialchars($message['message']); ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="message received">
                                    <?php echo htmlspecialchars($message['message']); ?>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>

                <div class="chat-footer">
                    <form action="" method="post">

                        <div class="input-group">

                            <input type="text" class="form-control" name="message" placeholder="Type a message..."
                                id="message">

                            <button class="btn btn-primary" name="send" id="sendBtn">
                                Send
                            </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="chat.js"></script>

</body>

</html>
<?php
if (isset($_POST["send"]) && isset($_GET['user'])) {

    $message = $_POST["message"];
    $sender_id = $_SESSION['id'];
    $sender_name = $_SESSION['username'];
    $receiverid = $_GET['user'];

    $query = "INSERT INTO `messages`
(`user_id`, `receiver_id`, `sender`, `message`)
VALUES
('$sender_id','$receiverid','$sender_name','$message')";
    $exe = mysqli_query($conn, $query);

    if ($exe) {
        echo "<script> alert('Message sent successfully')</script>";
    } else {
        echo "<script> alert('Failed to send message')
        window.location.href ='index.php';
        </script>";

    }
    ;

}
?>