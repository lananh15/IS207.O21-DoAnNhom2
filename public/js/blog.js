
document.addEventListener('DOMContentLoaded', function () {
  const cards = document.querySelectorAll('.card');

  cards.forEach(card => {
    card.addEventListener('click', function () {
      if (!this.classList.contains('clicked')) {
        cards.forEach(card => {
          card.classList.remove('clicked');
        });
        this.classList.add('clicked');
      } else {
        const imgSrc = this.querySelector('img').src;
        displayFullImage(imgSrc);
      }
    });
  });

  function displayFullImage(imgSrc) {
  const modal = document.createElement('div');
  modal.classList.add('modal');
  modal.innerHTML = `
    <div class="modal-content">
      <img src="${imgSrc}" alt="Full Image">
      <div class="close-text">Click outside to close</div>
    </div>
  `;
  
  modal.querySelector('.modal-content').classList.add('animate-in');

  document.body.appendChild(modal);

  modal.addEventListener('click', function (event) {
    if (event.target === modal) {
      modal.remove();
    }
  });

  const modalContent = modal.querySelector('.modal-content');
  modalContent.addEventListener('click', function (event) {
    event.stopPropagation(); 
  });
}

});


