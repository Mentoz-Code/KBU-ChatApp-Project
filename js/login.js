const form = document.querySelector(".login form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

//same logic used as the signup.js but here redirect to another file "users.js"
continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login2.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let data = xhr.response;
            // console.log(data);//debug
            if(data === "Success!") { //my fucking dumbass forgot that i didnt send "success"
                //alert('ok'); debugger
                location.href = "users.php";
            } else {
                errorText.style.display = "block";
                errorText.textContent = data;
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}