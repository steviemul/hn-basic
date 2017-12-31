import patch from '../patch';

class SMStatefulElement extends HTMLElement {

  constructor() {
    super();
  }

  connectedCallback() {
    if (this.hasAttribute('data-sm')) {
      const decoded = atob(this.getAttribute('data-sm'));
    
      this.state = JSON.parse(decoded);
      this.removeAttribute('data-sm');
    }
    else {
      this.state = {};
    }
  }

  get template() {
    return '';
  }

  update(state) {
    this.state = Object.assign({}, this.state, state);
    this.innerHTML = this.template;

    patch(this, this.template);
  }
}

export default SMStatefulElement;