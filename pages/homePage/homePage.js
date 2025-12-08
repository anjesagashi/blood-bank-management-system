const items = document.querySelectorAll(".faqItem");

items.forEach((item) => {
  item.addEventListener("click", () => {
    item.classList.toggle("active");
  });
});
