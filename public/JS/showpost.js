const yearEl = document.getElementById("year");
if (yearEl) yearEl.textContent = new Date().getFullYear();

const contentEl = document.getElementById("postContent");
const wcEl = document.getElementById("wc");
const rtEl = document.getElementById("rt");
const progressBar = document.getElementById("progressBar");

function countWords(text){
  const t = (text || "").trim();
  if(!t) return 0;
  return t.split(/\s+/).filter(Boolean).length;
}

if(contentEl && wcEl && rtEl){
  const words = countWords(contentEl.innerText);
  wcEl.textContent = `${words} words`;
  const mins = words ? Math.max(1, Math.round(words / 200)) : 0;
  rtEl.textContent = `${mins} min`;
}

function updateProgress(){
  if(!progressBar) return;
  const doc = document.documentElement;
  const scrollTop = doc.scrollTop || document.body.scrollTop;
  const scrollHeight = doc.scrollHeight - doc.clientHeight;
  const p = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
  progressBar.style.width = `${p}%`;
}
window.addEventListener("scroll", updateProgress, { passive: true });
updateProgress();

const copyLink = document.getElementById("copyLink");
if(copyLink){
  copyLink.addEventListener("click", async () => {
    try{
      await navigator.clipboard.writeText(window.location.href);
      copyLink.textContent = "Copied ✓";
      setTimeout(() => (copyLink.textContent = "Copy Link"), 900);
    }catch{
      alert("Copy not supported in this browser.");
    }
  });
}

const scrollTopBtn = document.getElementById("scrollTop");
if(scrollTopBtn){
  scrollTopBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}

const shareBtn = document.getElementById("shareBtn");
if(shareBtn){
  shareBtn.addEventListener("click", async () => {
    const data = { title: document.title, url: window.location.href };
    if(navigator.share){
      try{ await navigator.share(data); } catch {}
    } else {
      try{
        await navigator.clipboard.writeText(window.location.href);
        shareBtn.textContent = "Copied ✓";
        setTimeout(() => (shareBtn.textContent = "Share"), 900);
      }catch{
        alert("Share not supported.");
      }
    }
  });
}
