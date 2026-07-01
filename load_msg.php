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
                                            <div class="audio-container">
                                            <audio id="recieveaudio" src="whatsapp_notification.mp3" controls ></audio>
                                        </div>
                                        <script>
                                            recievemsg();
                                        </script>
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