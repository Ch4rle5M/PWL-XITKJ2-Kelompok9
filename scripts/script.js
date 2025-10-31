function openModal(title) {
  document.getElementById("modal").style.display = "flex";
  document.getElementById("modal-img").src = 
    title === "Kripto kalau jadi manusia" 
      ? "https://i.ibb.co/Fh7tRm4/anime-crypto.jpg"
      : "https://i.ibb.co/FKsn5Yf/quantum-post.jpg";
}

function closeModal() {
  document.getElementById("modal").style.display = "none";
}
