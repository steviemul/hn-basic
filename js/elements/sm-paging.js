import SMStatefulElement from './sm-stateful-element';

class SMPaging extends SMStatefulElement {

  constructor() {
    super();
  }

  connectedCallback() {
    super.connectedCallback();
  }

  get template() {
    return `
      &lt;
      <a class="previous" href="${this.previous}" ${this.previousDisabled}>prev</a>
      <span> ${this.state.pageNum}</span>
      /
      <span>${this.state.pages} </span>
      <a class="next" href="${this.next}" ${this.nextDisabled}>next</a>
      &gt;
    `;
  }

  get previous() {
    const part = this.state.url.split('/')[1];

    return '/' + part + '/' + (this.state.pageNum -1);
  }

  get next() {
    const part = this.state.url.split('/')[1];

    return '/' + part + '/' + (this.state.pageNum + 1);  
  }

  get previousDisabled() {
    if (this.state.pageNum <= 1) {
      return 'disabled'
    }

    return '';
  }

  get nextDisabled() {
    if (this.state.pageNum >= this.state.pages) {
      return 'disabled';
    }

    return '';
  }
}

if (window.customElements) {
  window.customElements.define('sm-paging', SMPaging);
}
else {
  window.addEventListener('WebComponentsReady', function(e) {
    window.customElements.define('sm-paging', SMPaging);
  });
}

export default SMPaging;