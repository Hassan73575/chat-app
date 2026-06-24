<?php
$query = "SELECT * FROM `users` WHERE id = '$current_userid';";
$exe = mysqli_query($conn, $query);
$profile_data = mysqli_fetch_assoc($exe);
?>
<div class="nav">
    <a href="index.php" class="nav-brand">
        <span class="nav-brand-icon"><i class="fa-solid fa-satellite-dish"></i></span>
        <span>Dudes App</span>
    </a>

    <div class="user-info">
        <div class="user-meta">
            <h3><?php echo "Howdy " . htmlspecialchars($_SESSION['username']); ?></h3>
            <p>Stay connected</p>
        </div>
        <a href="user-profile.php" class="nav-profile-link">
            <img src="profile_pics/<?php echo htmlspecialchars($profile_data["profilepic"]); ?>" class="nav-profile-avatar">
            <span class="status-dot"></span>
        </a>
    </div>
</div>