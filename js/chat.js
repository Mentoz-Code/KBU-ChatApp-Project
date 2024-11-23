const form = document.querySelector(".typing-area");
const incoming_id = form.querySelector(".incoming_id").value;
const inputField =form.querySelector(".input-field");
const sendBtn = form.querySelector("button");
const chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=> {
    e.preventDefault();
}

inputField.focus();

//add active class if anything is written
inputField.onkeyup = ()=>{
    if(inputField.value != "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            inputField.value = "";
            scrollToBottom();
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}