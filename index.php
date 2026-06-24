<?php
include "dbconnect.php";
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$current_userid = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DudesApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="images/app_logo.png" type="image/jpg">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "navbar.php" ?>

    <div class="main">
        <div class="container">
            <div class="overflow-hidden chat-wrapper">
                <aside class="users-panel">
                    <div class="users-panel-header">
                        <div>
                            <p class="eyebrow">Inbox</p>
                            <h3>Contacts</h3>
                        </div>
                        <div class="panel-icon">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                    </div>

                    <div class="users-list">
                        <?php
                        $currentUser = $_SESSION['id'];
                        $q = mysqli_query($conn, "SELECT * FROM users WHERE id != $currentUser");

                        if (mysqli_num_rows($q) > 0) {
                            while ($user = mysqli_fetch_assoc($q)) {
                                ?>
                                <a href="?user=<?php echo $user['id']; ?>" class="user-item">
                                    <div class="user-pill-avatar">
                                        <i class="fa-solid fa-circle-user"></i>
                                    </div>
                                    <div class="user-pill-content">
                                        <span class="user-name"><?php echo htmlspecialchars($user['username']); ?></span>
                                        <span class="user-caption">Tap to chat</span>
                                    </div>
                                </a>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="empty-users">No other users are available yet.</div>
                            <?php
                        }
                        ?>
                    </div>
                </aside>

                <section class="chat-panel">
                    <div class="chat-header">
                        <?php
                        if (isset($_GET["user"])) {
                            $id = (int) $_GET["user"];
                            $query = "SELECT * FROM `users` WHERE id = '$id'";
                            $exe = mysqli_query($conn, $query);
                            $user = mysqli_fetch_assoc($exe);

                            if ($user) {
                                ?>
                                <div class="chat-header-user">
                                    <div class="avatar-bubble">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div>
                                        <h4><?php echo htmlspecialchars($user["username"]); ?></h4>
                                        <p>Online now</p>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="chat-header-user">
                                <div class="avatar-bubble">
                                    <i class="fa-solid fa-message"></i>
                                </div>
                                <div>
                                    <h4>Select a conversation</h4>
                                    <p>Choose someone from the list to start chatting</p>
                                </div>
                            </div>
                            <?php
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

                            if (mysqli_num_rows($exe) > 0) {
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
                            } else {
                                ?>
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fa-solid fa-paper-plane"></i></div>
                                    <h3>No messages yet</h3>
                                    <p>Say hello and start the conversation.</p>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fa-solid fa-comments"></i></div>
                                <h3>Start your next conversation</h3>
                                <p>Pick a contact from the sidebar and send a message instantly.</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="chat-search">
                        <form action="" method="post" class="message-form">
                            <div class="input-group">
                                <input type="text" class="form-control" name="message" placeholder="Type a message..." id="message" autocomplete="off">
                                <button class="btn btn-primary" type="submit" name="send" id="sendBtn">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="chat.js"></script>
</body>
</html>
<?php
if (isset($_POST["send"]) && isset($_GET['user'])) {
    $message = trim($_POST["message"]);

    if ($message !== "") {
        $sender_id = $_SESSION['id'];
        $sender_name = $_SESSION['username'];
        $receiverid = (int) $_GET['user'];

        $query = "INSERT INTO `messages` (`user_id`, `receiver_id`, `sender`, `message`) VALUES ('$sender_id','$receiverid','$sender_name','$message')";
        $exe = mysqli_query($conn, $query);

        if (!$exe) {
            echo "<script>alert('Failed to send message'); window.location.href='index.php';</script>";
        }
    }
}
?>