class HeaderComponent extends HTMLElement {
  connectedCallback() {
    this.render();
    this.addEventListeners();
  }
  render() {
    this.innerHTML = `
            <header class="headerSection">
      <div class="headerContainer">
        <div class="burgerMenu">
          <img src="../../images/svg/burgerMenu.svg" alt="Burger Menu" />
        </div>
        <div class="logoContainer">
          <h1>LifeFlow</h1>
        </div>

        <nav class="navigationBar">
          <li><a href="#">Home</a></li>
          <li><a href="#">Home</a></li>
          <li><a href="#">Home</a></li>
        </nav>

        <div class="headerActions">
          <div class="searchContainer">
            <input
              type="text"
              placeholder="Search Center"
              class="searchInput"
            />
            <img
              src="../../images/svg/searchIcon1.svg"
              alt="Search Icon"
              class="searchIcon"
            />
          </div>
          <a href="#" class="loginButton">Login</a>
        </div>
      </div>
    </header>
        `;
  }

  addEventListeners() {
    const burgerMenu = this.querySelector(".burgerMenu");
    const navigationBar = this.querySelector(".navigationBar");
    const headerContainer = this.querySelector(".headerContainer");

    burgerMenu.addEventListener("click", () => {
      if (
        navigationBar.style.maxHeight &&
        navigationBar.style.maxHeight !== "0px"
      ) {
        navigationBar.style.maxHeight = "0";
        headerContainer.style.borderRadius = "25px";
      } else {
        navigationBar.style.maxHeight = navigationBar.scrollHeight + "px";
        headerContainer.style.borderRadius = "25px 25px 0px 0px";
      }
    });
  }
}

customElements.define("custom-header", HeaderComponent);
