function sentmessage() {

    let message =
    document.getElementById("message").value;

    document.getElementById("chatBody").innerHTML += `
        <div class="message sent">
            ${message}
        </div>
    `;

    document.getElementById("message").value = "";
}
function logout() {
    confirm("Are you sure you want to logout?") &&
    (window.location.href = "logout.php");
}
setInterval(() => {
    fetch(window.location.href)
        .then(res => res.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            document.getElementById('chatBody').innerHTML =
                doc.getElementById('chatBody').innerHTML;
        });
}, 600);

document.getElementById("sendBtn").addEventListener("click", function(){
    let audio = document.getElementById("audio");
    audio.play();
});
function recievemsg(){
        let recieveaudio = document.getElementById("recieveaudio");
    recieveaudio.play();
};