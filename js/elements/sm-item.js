import SMStatefulElement from './sm-stateful-element';

function tag() {
  console.log(arguments);
}

class SMItem extends SMStatefulElement {

  constructor() {
    super();
  }

  connectedCallback() {

    super.connectedCallback();

    if (this.state.kids) {
      this.state.kids.forEach((kid) => {
        const url = '/api/item/' + kid;

        fetch(url).then((response) => {
          return response.json();
        }).then(function(json) {
          console.log(json);
        });
      });
    }
  }

  get template() {
    return `
      <h1><a href="${this.state.url}">${this.state.title}</a></h1>
      <div>
         ${this.state.score} points by ${this.state.by}
      </div>
    `;
  }
}

if (window.customElements) {
  window.customElements.define('sm-item', SMItem);
}
else {
  window.addEventListener('WebComponentsReady', function(e) {
    window.customElements.define('sm-item', SMItem);
  });
}
export default SMItem;