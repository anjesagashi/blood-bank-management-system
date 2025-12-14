class FooterComponent extends HTMLElement {
  connectedCallback() {
    this.render();
  }
  render() {
    this.innerHTML = `
          <footer class="footer">
      <div class="socials">
        <img
          src="../../images/lifeFlow.png"
          alt="Life Flow Image"
          class="lifeFlowlogo"
        />
        <p>
          Our mission is to save lives by connecting generous donors with those
          in urgent need.
        </p>
        <div class="mediaIcons">
          <a
            href="https://www.instagram.com/"
            target="_blank"
            class="mediaIcon"
          >
            <img src="../../images/svg/instagram.svg" alt="Instagram Icon" />
          </a>
          <a href="https://www.facebook.com/" target="_blank" class="mediaIcon">
            <img src="../../images/svg/facebook.svg" alt="Facebook Icon" />
          </a>
          <a
            href="https://www.whatsapp.com/?lang=en"
            target="_blank"
            class="mediaIcon"
          >
            <img src="../../images/svg/whatsapp.svg" alt="Whatsapp Icon" />
          </a>
        </div>
      </div>

      <div class="footerSection">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="../../pages/homePage/homePage.html">Home</a></li>
          <li><a href="../../pages/aboutUsPage/aboutUsPage.html">About Us</a></li>
           <li><a href="../../pages/donationCenters/donationCenters.html">Donation Centers</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="../../pages/pageNotFound/pageNotFound.html">Privacy & Policy</a></li>
        </ul>
      </div>

      <div class="footerSection">
        <h4>Contact</h4>
        <p>Email: info@bloodbank.com</p>
        <p>Phone: +383 XX XXX XXX</p>
      </div>
    </footer>
        `;
  }
}
customElements.define("custom-footer", FooterComponent);
