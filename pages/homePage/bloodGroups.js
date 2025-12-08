const bloodGroups = [
  {
    id: "A+",
    shortDesc: "A very common and important blood type for hospitals.",
    longDesc:
      "People with A+ blood can donate to A+ and AB+. They can receive blood from A+, A-, O+ and O-. This blood type is crucial because it is frequently needed in medical emergencies.",
  },
  {
    id: "A-",
    shortDesc: "A rare blood type, very valuable in emergencies.",
    longDesc:
      "A- donors can give blood to A-, A+, AB-, and AB+. Since A- is uncommon, these donors are especially needed for critical situations.",
  },
  {
    id: "B+",
    shortDesc: "A common blood type that hospitals request often.",
    longDesc:
      "B+ can donate to B+ and AB+, and receive from B+, B-, O+ and O-. This group is important in trauma and surgery cases.",
  },
  {
    id: "B-",
    shortDesc: "Rare type and very important for compatible transfusions.",
    longDesc:
      "B- donors can give to B-, B+, AB-, and AB+. They can receive from B- and O-. Because it is rare, B- blood is highly valuable.",
  },
  {
    id: "AB+",
    shortDesc: "Universal plasma donor and universal receiver for blood.",
    longDesc:
      "AB+ individuals can receive blood from all types. They can donate only to AB+. This group is important because of its universal receiving capability.",
  },
  {
    id: "AB-",
    shortDesc: "One of the rarest blood types, extremely important.",
    longDesc:
      "AB- donors can give to AB- and AB+. They can receive blood from A-, B-, O-, and AB-. Because AB- is very rare, hospitals often have limited supply.",
  },
  {
    id: "O+",
    shortDesc: "The most common blood type and highly needed.",
    longDesc:
      "O+ can donate to all positive types (A+, B+, AB+, O+). They can receive from O+ and O-. O+ is always in high demand due to its widespread compatibility.",
  },
  {
    id: "O-",
    shortDesc: "Universal donor — crucial for emergencies.",
    longDesc:
      "O- blood can be given to all blood types, making it essential in emergency rooms. O- donors can receive blood only from O-. This is the most valuable blood type during trauma situations.",
  },
];

const slider = document.querySelector(".bloodGroupSlider");

bloodGroups.forEach((group) => {
  const card = document.createElement("div");
  card.classList.add("bloodGroupCard");

  card.innerHTML = `
    <img src="../../images/home/bloodBag.png" class="bloodBagImage" alt="Blood Bag Image" />
    <div class="bloodGroupContent">
      <h4>Type: ${group.id}</h4>
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
