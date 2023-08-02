//Тут навешивается событие на поиск
checkSearchInput();
//Тут изначальный вывод всех аккаунтов в таблицу
ajaxSelectAllAccounts(1);

//Тут функция самого события на поиск
function checkSearchInput() {
    let search = document.querySelector(".search");
    let timerId;
    search.addEventListener("input", () => {
        clearTimeout(timerId);
        let characterWrapper = document.querySelector(".characterWrapper");

        if (characterWrapper !== null) {
            characterWrapper.remove();
        }

        let searchText = search.value;


        if (search.value == false) {
            if (characterWrapper !== null) {
                characterWrapper.remove();
            }
            console.log("false");
            timerId = setTimeout(() => {
                ajaxSelectAllAccounts(1);
            }, 1000);
            
        } else {
            if (characterWrapper !== null) {
                characterWrapper.remove();
            }
            console.log(search.value);
            timerId = setTimeout(() => {
                ajaxSelectAllAccounts(2, searchText);
            }, 1000);
        }



    })

}

//Тут ajax запрос создаётся и проверяется получение ответа от сервера
function ajaxSelectAllAccounts(selectFunction, additionalParameter) {
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            addAllAccounts(this.responseText);
            console.log(this.responseText);
        }
    }

    if (selectFunction == 1) {
        let settings = selectFunction;
        xhttp.open("GET", "search.php?settings=" + encodeURIComponent(settings), true);
        xhttp.send()
    } else {
        let settings = selectFunction;
        xhttp.open("GET", "search.php?settings=" + encodeURIComponent(settings) + "&additionalParameter=" + encodeURIComponent(additionalParameter), true);
        xhttp.send()
    }
}

//Тут из бд происходит вывод на страницу ()
function addAllAccounts(data) {
    let tableCharacters = document.querySelector(".tableCharacters");
    let htmlData = document.createElement("div");
    htmlData.classList.add("characterWrapper");
    htmlData.innerHTML = data;
    tableCharacters.appendChild(htmlData);
}