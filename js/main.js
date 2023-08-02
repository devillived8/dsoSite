let xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        addAllAccounts(this.responseText);
    }
}


xhttp.open("GET", "search.php", true);
xhttp.send();

function addAllAccounts(data){
    let tableCharacters = document.querySelector(".tableCharacters");
    let htmlData = document.createElement("div");
    htmlData.innerHTML = data;
    tableCharacters.appendChild(htmlData);
    console.log(data);
}