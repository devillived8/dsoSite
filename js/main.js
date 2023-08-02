//Loader запускается пока не прогрузится таблица
loader();
//Тут навешивается событие на поиск
checkSearchInput();
//Тут изначальный вывод всех аккаунтов в таблицу
ajaxSelectAllAccounts(1);
//Функция сортировки
sorting();


//Функция loader для ожидания прогрузки таблицы
function loader() {
    const loader = document.querySelector(".svg-loader");
    loader.style.display = "flex";
}

//Тут функция самого события на поиск
function checkSearchInput() {
    let search = document.querySelector(".search");
    let timerId;

    search.addEventListener("input", () => {
        clearTimeout(timerId);


        const characterWrapper = document.querySelectorAll(".characterWrapper");

        characterWrapper.forEach(item => {
            item.remove();
        });

        let searchText = search.value;

        if (search.value == false) {

            console.log("false");
            timerId = setTimeout(() => {
                ajaxSelectAllAccounts(1);
            }, 700);

        } else {

            console.log(search.value);
            timerId = setTimeout(() => {
                ajaxSelectAllAccounts(2, searchText);
            }, 700);
        }



    })

}

//Тут ajax запрос создаётся и проверяется получение ответа от сервера
function ajaxSelectAllAccounts(selectFunction, additionalParameter) {
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const loader = document.querySelector(".svg-loader");
            const loaderWrapper = document.querySelector(".loaderWrapper");
            loaderWrapper.style.display = "none";
            loader.style.display = "none";
            addAllAccounts(this.responseText);
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


//Функции сортировки для таблицы
function sorting() {

    let date = document.querySelector(".info__Date"),
        price = document.querySelector(".info__Price");

    //Функция сортировки по дате
    let dateSwitch = "notSelected";
    date.addEventListener("click", () => {
        if (dateSwitch == "notSelected") {
            dateSwitch = true;
            date.textContent = "Дата получения \u2193";
            sortByAscDate();
        } else if (dateSwitch == true) {
            dateSwitch = false;
            date.textContent = "Дата получения \u2191";
            sortByDescDate();
        } else if (dateSwitch == false) {
            dateSwitch = true;
            date.textContent = "Дата получения \u2193";
            sortByAscDate();
        }

    });



    //Функция сортировки по цене
    let priceSwitch = "notSelected";
    price.addEventListener("click", () => {
        if (priceSwitch == "notSelected") {
            priceSwitch = true;
            price.textContent = "Цена \u2193";
            sortByAscPrice();

        } else if (priceSwitch == true) {
            priceSwitch = false;
            price.textContent = "Цена \u2191";
            sortByDescPrice();
        } else if (priceSwitch == false) {
            priceSwitch = true;
            price.textContent = "Цена \u2193";
            sortByAscPrice();
        }
    });
}

//Сортировка по дате (по возврастанию)
function sortByAscDate() {
    const parentContainer = document.querySelector(".tableCharacters");
    const characterWrapper = document.querySelector(".characterWrapper");

    // Получаем все элементы с классом "linkOnCharacter"
    const items = characterWrapper.querySelectorAll(".linkOnCharacter");

    // Преобразуем NodeList в массив, чтобы использовать метод сортировки
    const itemsArray = Array.from(items);
    // Сортируем блоки по дате возрастания
    itemsArray.sort((a, b) => {
        const dateA = new Date(a.getAttribute("data-date"));
        const dateB = new Date(b.getAttribute("data-date"));
        console.log(dateA);
        return dateB - dateA;
    });

    // Очищаем characterWrapper
    characterWrapper.innerHTML = '';

    // Вставляем отсортированные блоки обратно в characterWrapper
    itemsArray.forEach(item => {
        characterWrapper.appendChild(item);
    });

    // Вставляем characterWrapper обратно в родительский контейнер
    parentContainer.appendChild(characterWrapper);
}

//Сортировка по дате (по убыванию)
function sortByDescDate() {
    const parentContainer = document.querySelector(".tableCharacters");
    const characterWrapper = document.querySelector(".characterWrapper");

    // Получаем все элементы с классом "linkOnCharacter"
    const items = characterWrapper.querySelectorAll(".linkOnCharacter");

    // Преобразуем NodeList в массив, чтобы использовать метод сортировки
    const itemsArray = Array.from(items);
    // Сортируем блоки по дате возрастания
    itemsArray.sort((a, b) => {
        const dateA = new Date(a.getAttribute("data-date"));
        const dateB = new Date(b.getAttribute("data-date"));
        console.log(dateA);
        return dateA - dateB;
    });

    // Очищаем characterWrapper
    characterWrapper.innerHTML = '';

    // Вставляем отсортированные блоки обратно в characterWrapper
    itemsArray.forEach(item => {
        characterWrapper.appendChild(item);
    });

    // Вставляем characterWrapper обратно в родительский контейнер
    parentContainer.appendChild(characterWrapper);
}


//Сортировка по цене (по возврастанию)
function sortByAscPrice() {
    const parentContainer = document.querySelector(".tableCharacters");
    const characterWrapper = document.querySelector(".characterWrapper");

    // Получаем все элементы с классом "linkOnCharacter"
    const items = characterWrapper.querySelectorAll(".linkOnCharacter");

    // Преобразуем NodeList в массив, чтобы использовать метод сортировки
    const itemsArray = Array.from(items);
    // Сортируем блоки по дате возрастания
    itemsArray.sort((a, b) => {
        const dateA = new Date(a.getAttribute("data-price"));
        const dateB = new Date(b.getAttribute("data-price"));
        console.log(dateA);
        return dateB - dateA;
    });

    // Очищаем characterWrapper
    characterWrapper.innerHTML = '';

    // Вставляем отсортированные блоки обратно в characterWrapper
    itemsArray.forEach(item => {
        characterWrapper.appendChild(item);
    });

    // Вставляем characterWrapper обратно в родительский контейнер
    parentContainer.appendChild(characterWrapper);
}

//Сортировка по цене (по убыванию)
function sortByDescPrice() {
    const parentContainer = document.querySelector(".tableCharacters");
    const characterWrapper = document.querySelector(".characterWrapper");

    // Получаем все элементы с классом "linkOnCharacter"
    const items = characterWrapper.querySelectorAll(".linkOnCharacter");

    // Преобразуем NodeList в массив, чтобы использовать метод сортировки
    const itemsArray = Array.from(items);
    // Сортируем блоки по дате возрастания
    itemsArray.sort((a, b) => {
        const dateA = new Date(a.getAttribute("data-price"));
        const dateB = new Date(b.getAttribute("data-price"));
        console.log(dateA);
        return dateA - dateB;
    });

    // Очищаем characterWrapper
    characterWrapper.innerHTML = '';

    // Вставляем отсортированные блоки обратно в characterWrapper
    itemsArray.forEach(item => {
        characterWrapper.appendChild(item);
    });

    // Вставляем characterWrapper обратно в родительский контейнер
    parentContainer.appendChild(characterWrapper);
}