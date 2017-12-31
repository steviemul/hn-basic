class SMView extends HTMLElement {

  constructor() {
    super();
  }

  connectedCallback() {
    this._clickHandler = this._clickHandler.bind(this);
  
    document.addEventListener('click', this._clickHandler)

    const self = this;

    window.addEventListener('popstate', function(event) {
      self._fetchPosts(location.pathname + location.search);
    });
  }

  toggleItemView(visible) {
    if (visible) {
      this.pagingControls.setAttribute('hidden', true);
      this.posts.setAttribute('hidden', true);
      this.item.removeAttribute('hidden');
    }
    else {
      this.pagingControls.removeAttribute('hidden');
      this.posts.removeAttribute('hidden');
      this.item.setAttribute('hidden', true);
    }
  }

  get posts() {
    return this.getElementsByTagName('sm-posts')[0];
  }

  get pagingControls() {
    return this.getElementsByTagName('sm-paging')[0];    
  }

  get item() {
    return this.getElementsByTagName('sm-item')[0];
  }

  _fetchPosts(url) {
    const apiUrl = '/api' + url;
    const self = this;

    fetch(apiUrl).then((response) => {
      return response.json();
    })
    .then(function(json) {

      if (json.items) {
        self.posts.update(json);

        const pagingInfo = Object.assign({}, json.pagingInfo, {
          'url':url
        });

        self.pagingControls.update(pagingInfo);
        self.toggleItemView(false);
      }
      else {
        self.item.update(json);
        self.toggleItemView(true);
      }
    });
  }

  _clickHandler(evt) {
    if (evt.target.tagName === 'A') {
      const url = evt.target.getAttribute('href');
      
      if (url.indexOf('http') !== 0) {
        history.pushState(null, null, url);

        evt.preventDefault();

        this._fetchPosts(url);
      }
    }
  }
}

if (window.customElements) {
  window.customElements.define('sm-view', SMView);
}
else {
  window.addEventListener('WebComponentsReady', function(e) {
    window.customElements.define('sm-view', SMView);
  });
}

export default SMView;