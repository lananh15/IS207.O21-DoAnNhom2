const cards=document.querySelectorAll(".card");
const charpng=[
    "../../public/images&videos/Home/joypng.jpg",
    "../../public/images&videos/Home/sadnesspng.jpg",
    "../../public/images&videos/Home/fearpng.jpg",
    "../../public/images&videos/Home/disgustpng.jpg",
    "../../public/images&videos/Home/angerpng.jpg",
    "../../public/images&videos/Home/embarrassmentpng.webp",
    "../../public/images&videos/Home/ennuipng.webp",
    "../../public/images&videos/Home/anxietypng.jpg",
    "../../public/images&videos/Home/envypng.webp",
];
cards.forEach((card,index) => {
    var beforeElement = document.createElement('div');
    beforeElement.classList.add('before-element');
    beforeElement.style.content = '';
    beforeElement.style.position = 'absolute';
    beforeElement.style.inset = '0';
    beforeElement.style.opacity = '0';
    beforeElement.style.transition = '0.4s ease-in-out';
    beforeElement.style.backgroundImage = `url(${charpng[index % charpng.length]})`;
    beforeElement.style.backgroundSize = 'cover';
    beforeElement.style.width = '20vw';
    card.appendChild(beforeElement);
    
    if(index===5){
        card.addEventListener('mouseover', () => {
        beforeElement.style.opacity = '1';
        beforeElement.style.zIndex= '1';
        beforeElement.style.transform = 'translateX(95%)';
    });
    }
    else if(index===7){
        card.addEventListener('mouseover', () => {
            beforeElement.style.opacity = '1';
            beforeElement.style.zIndex= '1';
            beforeElement.style.transform = 'translateX(50%)';
        });
    }
    else {
        card.addEventListener('mouseover', () => {
            beforeElement.style.opacity = '1';
            beforeElement.style.zIndex= '1';
            beforeElement.style.transform = 'translateX(60%)';
    });
    } 
    card.addEventListener('mouseout', () => {
        beforeElement.style.opacity = '0';
        beforeElement.style.transform = 'translateX(-10%)';
    });
    
});

