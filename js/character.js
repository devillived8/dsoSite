let fotoCarouselImg = document.querySelectorAll(".fotoCarousel img");
let prev = document.querySelector(".prev");
let next = document.querySelector(".next");
let imageCharacter = document.querySelector(".imageCharacter");
let imageViewingBg = document.querySelector(".imageViewing");
let countImg = fotoCarouselImg.length;
let newCharacterPhoto = document.createElement("img");
let exit = document.querySelector(".exit");



exit.addEventListener("click", closeImageViewing);



prev.addEventListener("click", () => {
    let originalSearchIndex = newCharacterPhoto.src;
    let modifiedSearchIndex = originalSearchIndex.replace("http://localhost", ".");
    for (let i = 0; i < fotoCarouselImg.length; i++) {
        let element = fotoCarouselImg[i];
        if (element.tagName === "IMG" && element.getAttribute("src") === modifiedSearchIndex) {
            // Делайте что-то, если src совпадает
            if (i == 0) {
                let allKeys = Object.keys(fotoCarouselImg);
                let lastKey = allKeys[allKeys.length - 1];
                console.log(lastKey);
                newCharacterPhoto.src = fotoCarouselImg[lastKey].src;
            } else {
                newCharacterPhoto.src = fotoCarouselImg[i - 1].src;
                console.log(element + " " + i);
            }
        } else {
            console.log(element.getAttribute("src"));
        }
    }




})

next.addEventListener("click", () => {
    let originalSearchIndex = newCharacterPhoto.src;
    let modifiedSearchIndex = originalSearchIndex.replace("http://localhost", ".");
    for (let i = 0; i < fotoCarouselImg.length; i++) {
        let element = fotoCarouselImg[i];
        if (element.tagName === "IMG" && element.getAttribute("src") === modifiedSearchIndex) {
            // Делайте что-то, если src совпадает
            let allKeys = Object.keys(fotoCarouselImg);
            let lastKey = allKeys[allKeys.length - 1];
            if (i == lastKey) {
                let allKeys = Object.keys(fotoCarouselImg);
                let firstKey = allKeys[0];
                console.log(firstKey);
                newCharacterPhoto.src = fotoCarouselImg[firstKey].src;
            } else {
                newCharacterPhoto.src = fotoCarouselImg[i + 1].src;
                console.log(element + " " + i);
            }
        } else {
            console.log(element.getAttribute("src"));
        }
    }




})



fotoCarouselImg.forEach(element => {
    element.addEventListener("click", imageViewing);

})



imageCharacter.addEventListener("click", (e) => {
    e.stopPropagation();
});

imageViewingBg.addEventListener("click", closeImageViewing);

function closeImageViewing() {
    imageViewingBg.style.display = "none";
    newCharacterPhoto.remove();
}



function imageViewing() {
    imageViewingBg.style.display = "block";
    console.log(this);
    let firstChild = imageCharacter.firstChild;
    newCharacterPhoto.src = this.src;
    newCharacterPhoto.classList.add("characterPhoto");
    imageCharacter.insertBefore(newCharacterPhoto, firstChild);
    // imageCharacter.style.backgroundImage = "url('" + this.src +"')";
    // url("../img/war/war1.jpg")
}






if (countImg > 6) {
    fotoCarouselImg[0].style.width = "50%";
    fotoCarouselImg[1].style.width = "50%";
    let lastImg = countImg - 2;
    let width = 100 / lastImg;
    console.log(width);
    let i = 2;
    while (i < countImg) {
        let character = fotoCarouselImg[i];
        console.log(character);
        character.style.width = width + "%";
        i++;
    }
} else if (countImg == 6) {
    fotoCarouselImg[0].style.width = "33.3%";
    fotoCarouselImg[1].style.width = "33.3%";
    fotoCarouselImg[2].style.width = "33.3%";
    let lastImg = countImg - 3;
    let width = 100 / lastImg;
    console.log(width);
    let i = 2;
    while (i < countImg) {
        let character = fotoCarouselImg[i];
        console.log(character);
        character.style.width = width + "%";
        i++;
    }
} else if (countImg == 5 || countImg == 4) {
    fotoCarouselImg[0].style.width = "50%";
    fotoCarouselImg[1].style.width = "50%";

    let lastImg = countImg - 2;
    let width = 100 / lastImg;
    console.log(width);
    let i = 2;
    while (i < countImg) {
        let character = fotoCarouselImg[i];
        console.log(character);
        character.style.width = width + "%";
        i++;
    }
} else if (countImg == 3) {
    fotoCarouselImg[0].style.width = "100%";
    let lastImg = countImg - 1;
    let width = 100 / lastImg;
    console.log(width);
    let i = 1;
    while (i < countImg) {
        let character = fotoCarouselImg[i];
        console.log(character);
        character.style.width = width + "%";
        i++;
    }
} else if (countImg == 2) {
    fotoCarouselImg[0].style.width = "50%";
    fotoCarouselImg[1].style.width = "50%";
} else if (countImg == 1) {
    fotoCarouselImg[0].style.width = "100%";
}