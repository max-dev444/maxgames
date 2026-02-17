// Tabs
const tabs=document.querySelectorAll('.tab');
const containers=document.querySelectorAll('.buttons-container');

tabs.forEach(tab=>{
tab.onclick=()=>{
tabs.forEach(t=>t.classList.remove('active'));
tab.classList.add('active');
containers.forEach(c=>{
c.style.display=(c.id===tab.dataset.tab)?'grid':'none';
});
};
});

// Firebase verified list
const firebaseConfig={
apiKey:"AIzaSyC39mabdSddFKYBfPeFiqXEH3vRuW0hBOg",
authDomain:"verify-2f72e.firebaseapp.com",
projectId:"verify-2f72e"
};

const app=firebase.initializeApp(firebaseConfig,'verifiedApp');
const db=firebase.firestore(app);

document.getElementById('verifiedBtn').onclick=async()=>{
const panel=document.getElementById("verifiedPanel");
if(panel.style.display==='block'){panel.style.display='none';return;}
panel.style.display='block';
const list=document.getElementById("verifiedList");
list.innerHTML="Loading...";
try{
const snap=await db.collection("verifiedEmails").get();
list.innerHTML="";
snap.forEach(doc=>{
const li=document.createElement("li");
li.textContent=doc.data()?.email||"null";
list.appendChild(li);
});
}catch(e){
list.innerHTML="<li>Error loading verified</li>";
}
};

// Gallery popup
document.querySelectorAll(".gallery-grid img").forEach(img=>{
img.onclick=()=>{
document.getElementById("popupImage").src=img.src;
document.getElementById("galleryPopup").style.display="flex";
};
});

function closeGalleryPopup(){
document.getElementById("galleryPopup").style.display="none";
}

// Featured Games
const featuredGames = [
"https://maxgames.org/Arcane%200.6","https://maxgames.org/Arcane%202","https://maxgames.org/Arsenic",
"https://maxgames.org/Chromium","https://maxgames.org/Element%20OS","https://maxgames.org/Fluorine",
"https://maxgames.org/Gamers%20Hub%20V4","https://maxgames.org/Hafnium","https://maxgames.org/Index",
"https://maxgames.org/Iridium","https://maxgames.org/LuckSimulator","https://maxgames.org/Nickel",
"https://maxgames.org/Osmium%20V1","https://maxgames.org/Palledium","https://maxgames.org/Platinum",
"https://maxgames.org/Polonium","https://maxgames.org/Read","https://maxgames.org/TMS%201.2",
"https://maxgames.org/TMSswitcherv2","https://maxgames.org/Xenon","https://maxgames.org/a",
"https://maxgames.org/accountcreation","https://maxgames.org/accountdeletion","https://maxgames.org/argon",
"https://maxgames.org/astatinedownload","https://maxgames.org/boredbutton","https://maxgames.org/boron",
"https://maxgames.org/cobalt","https://maxgames.org/index","https://maxgames.org/info",
"https://maxgames.org/lithium_single_file_html_coder","https://maxgames.org/maxsearch","https://maxgames.org/minicraft",
"https://maxgames.org/nanoconsole","https://maxgames.org/note","https://maxgames.org/phpconnecterindex",
"https://maxgames.org/play","https://maxgames.org/secret","https://maxgames.org/security",
"https://maxgames.org/snazz","https://maxgames.org/sneakpeek","https://maxgames.org/specialthanks",
"https://maxgames.org/supersecret","https://maxgames.org/updatelog","https://maxgames.org/websitehubv8",
"https://maxgames.org/websitepage","https://maxgames.org/Blockworld"
];

let currentIndex = 0;
function nextFeaturedGameFooter(){
currentIndex = (currentIndex + 1) % featuredGames.length;
document.getElementById("gameFrameFooter").src = featuredGames[currentIndex];
}

function loadPartial(file, elementId) {
  fetch(file)
    .then(res => res.text())
    .then(data => {
      document.getElementById(elementId).innerHTML = data;
    });
}

window.addEventListener("DOMContentLoaded", () => {
  loadPartial("newButtons.html", "newButtons");
});

const cursorRed = document.querySelector('.cursor-red');
const cursorBlue = document.querySelector('.cursor-blue');

let mouseX = 0, mouseY = 0;
let redX = 0, redY = 0;
let blueX = 0, blueY = 0;

document.addEventListener('mousemove', e => {
    mouseX = e.clientX;
    mouseY = e.clientY;
});

function animate() {
    // Red cursor lags behind
    redX += (mouseX - redX) * 0.15;
    redY += (mouseY - redY) * 0.15;
    cursorRed.style.left = redX + 'px';
    cursorRed.style.top = redY + 'px';

    // Blue cursor follows faster
    blueX += (mouseX - blueX) * 0.25;
    blueY += (mouseY - blueY) * 0.25;
    cursorBlue.style.left = blueX + 'px';
    cursorBlue.style.top = blueY + 'px';

    requestAnimationFrame(animate);
}

animate();


