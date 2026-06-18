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