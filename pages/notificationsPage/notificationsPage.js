document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".notifItem");
  const detailsArea = document.querySelector("#notifDetailsId");

  const messages = {
    1: {
      title: "Përditësim i Sistemit",
      body: "Admin: Kemi shtuar funksionalitete të reja në dashboard. Tani mund të shihni statistikat në kohë reale.",
      date: "Sot, 10:00",
    },
    2: {
      title: "Mesazh nga Admin",
      body: "Përshëndetje! Mos harroni të plotësoni profilin tuaj dhe të verifikoni email-in për siguri më të lartë.",
      date: "Dje, 15:30",
    },
  };

  items.forEach((item) => {
    item.addEventListener("click", () => {
      items.forEach((i) => i.classList.remove("active"));
      item.classList.add("active");

      const id = item.getAttribute("data-id");
      const msg = messages[id];

      if (msg) {
        detailsArea.innerHTML = `
          <div class="messageView">
            <h2>${msg.title}</h2>
            <p style="color: gray; font-size: 0.9rem;">${msg.date}</p>
            <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">
            <p style="line-height: 1.6; color: #333; font-size: 1.1rem;">${msg.body}</p>
          </div>
        `;
      }
    });
  });
});
