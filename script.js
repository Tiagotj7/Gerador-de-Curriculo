// === Digitação animada no título ===
//script.js
const title = document.querySelector('.left h1');
const fullText = title.textContent;
title.textContent = '';
let i = 0;
function typeWriter(){
  if(i < fullText.length){
    title.textContent += fullText.charAt(i);
    i++;
    setTimeout(typeWriter,50);
  }
}
typeWriter();

// === Animar features ao aparecer na tela ===
const features = document.querySelectorAll('.feature');
const observer = new IntersectionObserver(entries=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){
      entry.target.style.opacity='1';
      entry.target.style.transform='translateY(0)';
    }
  })
},{threshold:0.2});
features.forEach(f => observer.observe(f));

// === Animação do painel e inputs ao foco ===
const panel = document.querySelector('.panel');
panel.addEventListener('mouseenter', ()=> panel.style.transform='translateY(-5px)');
panel.addEventListener('mouseleave', ()=> panel.style.transform='translateY(0)');

// Inputs já têm efeito no CSS (:focus)
