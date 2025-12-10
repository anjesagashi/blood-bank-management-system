// Merr query string nga URL
const params = new URLSearchParams(window.location.search);
const groupId = Number(params.get("group"));

const selectedGroup = bloodGroups.find((group) => group.id === groupId);
const heroTitle = document.querySelector(".hero h1");
const heroDesc = document.querySelector(".hero p");
const heading = document.querySelector(".heading");
const canDonateTo = document.querySelector(".donate");
const canReceiveFrom = document.querySelector(".receive");
const infoParagraph = document.querySelector(".description");

if (selectedGroup) {
  heroTitle.textContent = `Group: ${selectedGroup.name}`;
  heroDesc.textContent = selectedGroup.shortDesc;
  heading.textContent = selectedGroup.name + " Blood Group";
  canDonateTo.textContent = selectedGroup.canDonateTo;
  canReceiveFrom.textContent = selectedGroup.canReceiveFrom;
  infoParagraph.textContent = selectedGroup.longDesc;
}

let vid = document.querySelector(".bgVideo");
vid.playbackRate = 0.75;
