const menu = document.querySelector('.menu');
const navList = document.querySelector('nav ul');

menu.addEventListener('click', () => {
    menu.classList.toggle('active');
    navList.classList.toggle('active');
});


    window.addEventListener('scroll', function () {
        const contactBar = document.getElementById('topContact');
        if (window.scrollY === 0) {
            contactBar.style.display = 'flex';
        } else {
            contactBar.style.display = 'none';
        }
    });


const textElement = document.querySelector('.hebat');
const texts = ['SMK BPPI', 'Bright To The Future'];
let index = 0;

setInterval(() => {
    textElement.textContent = texts[index];
    index = (index + 1) % texts.length;
}, 5000);

// document.getElementById('switch-btn').addEventListener('click', function() {
//     var aboutSection = document.querySelector('.about-section');
//     var aboutImage = document.getElementById('about-image');
//     var aboutText = document.getElementById('about-text');

//     aboutSection.classList.toggle('row-reverse');

//     if (aboutSection.classList.contains('row-reverse')) {
//         aboutImage.src = 'img/isal2.jpeg';
//         aboutText.textContent = 'Bright to the Future: We aim to nurture students...';
//     } else {
//         aboutImage.src = 'img/logosmk.png';
//         aboutText.textContent = 'SMK Ucun is a leading vocational school providing top-notch education...';
//     }
// });

let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav a');

window.onscroll = () => {
    sections.forEach(sec => {
        let top = window.scrollY;
        let offset = sec.offsetTop;
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');

        if(top>offset && top<offset + height) {
            navLinks.forEach(links=>{
                links.classList.remove('Active');
                document.querySelector('header nav a[href*='+id+']').classList.add('Active');
            });
        };
    });
};


