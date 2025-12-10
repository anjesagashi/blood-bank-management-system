const items = document.querySelectorAll(".faqItem");

items.forEach((item) => {
  item.addEventListener("click", () => {
    item.classList.toggle("active");
  });
});

const slider = document.querySelector(".bloodGroupSlider");

bloodGroups.forEach((group) => {
  const card = document.createElement("div");
  card.classList.add("bloodGroupCard");

  card.innerHTML = `
    <img src="../../images/home/bloodBag.png" class="bloodBagImage" alt="Blood Bag Image" />
    <div class="bloodGroupContent">
      <h4>Type: ${group.name}</h4>
      <p>${group.shortDesc}</p>
      <a href="../bloodDetails/bloodDetails.html?group=${group.id}">Read More</a>
    </div>

  `;
  card.addEventListener("click", () => {
    window.location.href = `../bloodDetails/bloodDetails.html?group=${group.id}`;
  });
  slider.appendChild(card);
});
const prevBtn = document.querySelector(".prevBtn");
const nextBtn = document.querySelector(".nextBtn");

const cardWidth = 300;

nextBtn.addEventListener("click", () => {
  slider.scrollLeft += cardWidth;
});

prevBtn.addEventListener("click", () => {
  slider.scrollLeft -= cardWidth;
});
