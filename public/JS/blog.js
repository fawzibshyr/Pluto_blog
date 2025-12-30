const masonry = document.getElementById("masonry");
const cols = Array.from(document.querySelectorAll(".masonry__col"));
const grid = document.getElementById("grid");

const searchInput = document.getElementById("searchInput");
const clearSearch = document.getElementById("clearSearch");
const categoryList = document.getElementById("categoryList");
const sortSelect = document.getElementById("sortSelect");

const loadMoreBtn = document.getElementById("loadMore");
const toggleSidebarBtn = document.getElementById("toggleSidebar");
const sidebar = document.getElementById("sidebar");
const layoutBtns = Array.from(document.querySelectorAll("[data-layout]"));

let allPosts = (window.__BLOG_BOOT__ && Array.isArray(window.__BLOG_BOOT__.items))
  ? window.__BLOG_BOOT__.items
  : [];

const ENABLE_FILTERS = false;

function escapeHtml(str){
  return String(str).replace(/[&<>"']/g, s => ({
    "&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"
  }[s]));
}

function formatDate(iso){
  if(!iso) return "";
  const d = new Date(iso + "T00:00:00");
  if(Number.isNaN(d.getTime())) return iso;
  return d.toLocaleDateString(undefined, { year:"numeric", month:"short", day:"2-digit" });
}

function createCard(post){
  const a = document.createElement("a");
  a.className = "card";
  a.href = post.url || "#";

  const imgUrl = post.img || post.image || "";

  const img = imgUrl && imgUrl.trim() ? imgUrl : "https://via.placeholder.com/1200x700?text=Post";

  const category = escapeHtml((post.category || "article").toString());
  const title = escapeHtml((post.title || "Untitled").toString());
  const desc = escapeHtml((post.desc || "").toString());
  const date = formatDate(post.date);
  const read = Number(post.read || 4);

  a.innerHTML = `
    <div class="card__media">
      <span class="badge">${category}</span>
      <img src="${img}" alt="${title}" loading="lazy"
           onerror="this.src='https://via.placeholder.com/1200x700?text=Post'; this.onerror=null;" />
    </div>
    <div class="card__body">
      <div class="card__title">${title}</div>
      <div class="card__desc">${desc}</div>
      <div class="card__meta">
        <span>${escapeHtml(date)}</span>
        <span class="meta-dot">•</span>
        <span>${read} min read</span>
      </div>
    </div>
  `;
  return a;
}


function renderStatic(){
  masonry.classList.remove("hidden");
  grid.classList.add("hidden");
  cols.forEach(c => c.innerHTML = "");

  let i = 0;
  allPosts.forEach(post => {
    const card = createCard(post);
    cols[i % cols.length].appendChild(card);
    i++;
  });
}

async function loadMore(){
  const boot = window.__BLOG_BOOT__ || {};
  if(!boot.loadUrl) return;
  if(!boot.hasMore){ loadMoreBtn.style.display = "none"; return; }

  loadMoreBtn.disabled = true;
  try{
    const url = new URL(boot.loadUrl, window.location.origin);
    url.searchParams.set("page", String(boot.nextPage || 2));

    const res = await fetch(url.toString(), { headers: { "Accept": "application/json" } });
    if(!res.ok) throw new Error("Bad response");

    const data = await res.json();
    const items = Array.isArray(data.items) ? data.items : [];
    allPosts = allPosts.concat(items);

    boot.hasMore = !!data.hasMore;
    boot.nextPage = data.nextPage || (boot.nextPage + 1);

    if(!boot.hasMore) loadMoreBtn.style.display = "none";
    renderStatic();
  } catch(e){
  } finally {
    loadMoreBtn.disabled = false;
  }
}

toggleSidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
});

loadMoreBtn.addEventListener("click", loadMore);

if(ENABLE_FILTERS){
}

renderStatic();
if(!(window.__BLOG_BOOT__ && window.__BLOG_BOOT__.hasMore)) {
  loadMoreBtn.style.display = "none";
}
