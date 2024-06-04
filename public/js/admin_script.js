let header = document.querySelector('.header');

document.querySelector('#menu-btn').onclick = () =>{
   header.classList.toggle('active');
}

window.onscroll = () =>{
   header.classList.remove('active');
}

document.querySelectorAll('.posts-content').forEach(content => {
   if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
});
const navLinks = document.querySelectorAll('.header .navbar a');
const currentURL = window.location.href;

navLinks.forEach(link => {
  const linkURL = link.href;
  if (currentURL.includes(linkURL)) {
    link.classList.add('active');
  }
  
});