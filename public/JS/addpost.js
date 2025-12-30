const contentEl = document.getElementById("content");
const wcEl = document.getElementById("wc");
const rtEl = document.getElementById("rt");
const statusEl = document.getElementById("status");
const toast = document.getElementById("toast");

const imgInput = document.getElementById("image");
const coverBox = document.getElementById("coverBox");
const coverEmpty = document.getElementById("coverEmpty");
const coverFilled = document.getElementById("coverFilled");
const coverImg = document.getElementById("coverImg");
const pickImg = document.getElementById("pickImg");
const changeImg = document.getElementById("changeImg");
const removeImg = document.getElementById("removeImg");
const footNote = document.getElementById("footNote");

const draftBtn = document.getElementById("draftBtn");
const draftBtn2 = document.getElementById("draftBtn2");

const genSlug = document.getElementById("genSlug");
const tagInput = document.getElementById("tagInput");

function showToast(msg){
  toast.textContent = msg;
  toast.classList.add("show");
  setTimeout(() => toast.classList.remove("show"), 900);
}

function countWords(text){
  const t = (text || "").trim();
  if(!t) return 0;
  return t.split(/\s+/).filter(Boolean).length;
}
function updateStats(){
  const words = countWords(contentEl.value);
  wcEl.textContent = `${words} words`;
  const mins = words ? Math.max(1, Math.round(words / 200)) : 0;
  rtEl.textContent = `${mins} min`;
}

function autoResize(){
  contentEl.style.height = "auto";
  contentEl.style.height = (contentEl.scrollHeight + 2) + "px";
}

function setCover(url){
  coverImg.src = url;
  coverEmpty.style.display = "none";
  coverFilled.style.display = "block";
  footNote.textContent = "Cover image added ✓";
}
function clearCover(){
  imgInput.value = "";
  coverImg.src = "";
  coverFilled.style.display = "none";
  coverEmpty.style.display = "flex";
  footNote.textContent = "No cover image yet";
}

pickImg.addEventListener("click", () => imgInput.click());
changeImg.addEventListener("click", () => imgInput.click());

imgInput.addEventListener("change", () => {
  const file = imgInput.files && imgInput.files[0];
  if(!file) return;
  const url = URL.createObjectURL(file);
  setCover(url);
});

removeImg.addEventListener("click", clearCover);

["dragenter","dragover"].forEach(evt => {
  coverBox.addEventListener(evt, (e) => {
    e.preventDefault();
    coverBox.style.outline = "3px solid rgba(183,198,192,.45)";
    coverBox.style.outlineOffset = "-6px";
  });
});
["dragleave","drop"].forEach(evt => {
  coverBox.addEventListener(evt, (e) => {
    e.preventDefault();
    coverBox.style.outline = "none";
  });
});
coverBox.addEventListener("drop", (e) => {
  const file = e.dataTransfer.files && e.dataTransfer.files[0];
  if(!file || !file.type.startsWith("image/")) return;

  const dt = new DataTransfer();
  dt.items.add(file);
  imgInput.files = dt.files;

  const url = URL.createObjectURL(file);
  setCover(url);
});


tagInput.addEventListener("keydown", (e) => {
  if(e.key === "Enter"){
    e.preventDefault();
    tagInput.value = ""; 
  }
});

function fakeDraft(){
  statusEl.textContent = "Draft";
}
draftBtn.addEventListener("click", fakeDraft);
draftBtn2.addEventListener("click", fakeDraft);

contentEl.addEventListener("input", () => {
  statusEl.textContent = "Draft";
  updateStats();
  autoResize();
});

updateStats();
autoResize();
