import SMStatefulElement from './sm-stateful-element';

class SMPost extends SMStatefulElement {

  constructor() {
    super();
  }

  get template() {
    const comments = getCommentsString(this.state);

    return `
      <h1>
        <a href="${this.state.url}" target="_blank" rel="noopener">${this.state.title}</a>
      </h1>
      <div>
        ${this.state.score} points by ${this.state.by} | ${comments}
      </div>
    `;
  }
}

if (window.customElements) {
  window.customElements.define('sm-post', SMPost);
}
else {
  window.addEventListener('WebComponentsReady', function(e) {
    window.customElements.define('sm-post', SMPost);
  });
}

function getCommentsString(item) {

  let text = "discuss";

  if (item['kids']) {
    text = item['kids'].length + ' comments';
  }

  return `<a href="/item/${item.id}">${text}</a>`;
}

export default SMPost;
