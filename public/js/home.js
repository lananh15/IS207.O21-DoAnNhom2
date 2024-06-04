const cards=document.querySelectorAll(".card");
const charpng=[
    "/IS207.O21-DoAnNhom2/public/images&videos/Home/joypng.jpg",
    "/IS207.O21-DoAnNhom2/public/images&videos/Home/sadnesspng.jpg",
    "/IS207.O21-DoAnNhom2/public/images&videos/Home/fearpng.jpg",
    "/IS207.O21-DoAnNhom2/public/images&videos/Home/disgustpng.jpg",
    "/IS207.O21-DoAnNhom2/public/images&videos/Home/angerpng.jpg",
    "/IS207.O21-DoAnNhom2/public/images&videos/Home/embarrassmentpng.webp",
    "/IS207.O21-DoAnNhom2/public/images&videos/Home/ennuipng.webp",
    "/IS207.O21-DoAnNhom2/public/images&videos/Home/anxietypng.jpg",
    "/IS207.O21-DoAnNhom2/public/images&videos/Home/envypng.webp",
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
    
    if (index===2 || index===8){
        card.addEventListener('mouseover', () => {
            beforeElement.style.opacity = '1';
            beforeElement.style.zIndex= '1';
            beforeElement.style.transform = 'translateX(40%)';
        });
    }
    else if(index===5){
        card.addEventListener('mouseover', () => {
            beforeElement.style.opacity = '1';
            beforeElement.style.zIndex= '1';
            beforeElement.style.transform = 'translateX(43%)';
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
let watchBtn=document.getElementById("watch-btn");
watchBtn.addEventListener("click",function(){
    window.location.href="watch1.php";
})
