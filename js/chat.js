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

//when message is sent clear the field and scroll to bottom
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

//for css 
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

//for css
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

//to make it execute this function every 1000ms (1s) i used setInterval
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")) {
                scrollToBottom();
            }
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //ill send a request to the server with incoming id
    xhr.send("incoming_id=" + incoming_id);
}, 1000);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}