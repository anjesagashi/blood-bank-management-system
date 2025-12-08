class StatsComponent extends HTMLElement {
  connectedCallback() {
    this.render();
  }
  render() {
    const src = this.getAttribute("src");
    const value = this.getAttribute("value");
    const description = this.getAttribute("description");
    this.innerHTML = `
             <div class="statsBox">
      <img
        src="${src}"
        alt="Stats Icon"
        class="statsIcon"
      />
      <div class="statsCotent">
        <h1>${value}</h1>
        <p>${description}</p>
      </div>
    </div>
        `;
  }
}
customElements.define("custom-stats", StatsComponent);
