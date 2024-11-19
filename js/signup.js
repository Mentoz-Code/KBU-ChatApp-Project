const form = document.querySelector(".signup form"); //the whole form
const continueBtn = form.querySelector(".button input"); //start chatting button
const errorText = form.querySelector(".error-text"); //the error message in case of error, yok yavvv

form.onsubmit = (e) => {
    //prevents default input submission
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    //this is what will make my page dynamic and not need to reload in order to get new data
    //it is called ajax... evet hocam bunun biliyorum hahahaha
    let xhr = new XMLHttpRequest ();
    xhr.open("POST", "php/signup.php", true); //true means asynchronous...try without- check its location plz
    xhr.onload = ()=>{
        //if the connection is done and successful '200'
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let data = xhr.response; //either succcess or no connection to xml
            if(data === "success") {
                location.href = "users.php";//check location
            } else {
                errorText.style.display = "block"; //css
                errorText.textContent = data;
            }
        }
    }
    //here i created a formData object to collect all the form inputs then i send it
    let formData = new FormData(form);
    xhr.send(formData);
}