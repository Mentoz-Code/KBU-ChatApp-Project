const searchBar = document.querySelector(".search input");
const searchIcon = document.querySelector(".search button");
const usersList = document.querySelector(".users-list");

searchIcon.onclick = ()=>{
    //when the user clicks on the search icon itll be active and the input field will show
    searchBar.classList.toggle("show");
    searchIcon.classList.toggle("active");
    searchBar.focus();

    if(searchBar.classList.contains("active")) {
        searchBar.value = "";
        searchBar.classList.remove("active");
    }
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    //if the search is empty then remove active class from it
    if(searchTerm != "") {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }

    let xhr = new XMLHttpRequest();
    //this will get the POST declared in line 7 in search.php which will get it from data.php
    xhr.open("POST", "php/search.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let data = xhr.response;
            usersList.innerHTML = data;
        }
    }

    //ill make the name of the header "Content-type" be urlencoded... meaning itll show in the url
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

//every second
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users2.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let data = xhr.response;
            //dynamic user refresh
            if(!searchBar.classList.contains("active")) {
                usersList.innerHTML = data;
            }
        }
    }
    xhr.send();
}, 1000)