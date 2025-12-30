const $ = (id) => document.getElementById(id);

const title = $("title");
const body = $("body");
const image = $("image");

const wc = $("wc");

const cover = $("cover");
const pTitle = $("pTitle");
const pTag = $("pTag");
const pBody = $("pBody");

const tagBtn = $("tagBtn");
const tagPop = $("tagPop");
const tagText = $("tagText");
const tagInput = $("tagInput");
const tagManual = $("tagManual");
const tagApply = $("tagApply");

const fileHint = $("fileHint");

let coverSrc = "";

function wordsCount(text){
  const t = (text || "").trim();
  if(!t) return 0;
  return t.split(/\s+/).filter(Boolean).length;
}

function setCover(src){
  cover.innerHTML = "";
  if(!src){
    const d = document.createElement("div");
    d.className = "cover-empty";
    d.textContent = "Cover";
    cover.appendChild(d);
    return;
  }
  const img = document.createElement("img");
  img.src = src;
  cover.appendChild(img);
}

function sync(){
  const w = wordsCount((title.value || "") + " " + (body.value || ""));
  wc.textContent = `${w} words`;

  pTitle.textContent = title.value.trim() || "Title";
  pBody.textContent = (body.value.trim() || "...").slice(0, 520);

  // tag
  const t = (tagInput.value || "").trim() || "tag";
  pTag.textContent = t;
  tagText.textContent = t;
}

image?.addEventListener("change", ()=>{
  const f = image.files?.[0];
  if(!f){
    coverSrc = "";
    fileHint.textContent = "No file";
    return;
  }
  coverSrc = URL.createObjectURL(f);
  fileHint.textContent = f.name;
  setCover(coverSrc);
});

[title, body].forEach(el => el?.addEventListener("input", sync));

function openTagPop(open){
  tagPop.classList.toggle("show", open);
  tagBtn.setAttribute("aria-expanded", open ? "true" : "false");
  tagPop.setAttribute("aria-hidden", open ? "false" : "true");
}

tagBtn.addEventListener("click", () => {
  openTagPop(!tagPop.classList.contains("show"));
});

tagPop.addEventListener("click", (e) => {
  const opt = e.target.closest(".tag-opt");
  if(!opt) return;
  const val = opt.dataset.tag || "";
  tagInput.value = val;
  tagManual.value = "";
  openTagPop(false);
  sync();
});

tagApply.addEventListener("click", () => {
  const val = (tagManual.value || "").trim();
  if(!val) return;
  tagInput.value = val;
  openTagPop(false);
  sync();
});

document.addEventListener("click", (e) => {
  if(!e.target.closest(".tag-wrap")){
    openTagPop(false);
  }
});

sync();
