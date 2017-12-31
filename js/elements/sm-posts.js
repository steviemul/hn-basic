function createPostElement() {
  const postElement = document.createElement('sm-post');

  return postElement;
}

class SMPosts extends HTMLElement {

  constructor() {
    super();
  }

  connectedCallback() {
    this.posts = this.querySelectorAll('sm-post');
  }

  addNewPost() {
    this.appendChild(createPostElement());
    this.posts = this.querySelectorAll('sm-post');
  }

  update(posts) {
    const items = posts.items;

    items.forEach((post, index) => {
      if (!this.posts[index]) {
        this.addNewPost();
      }

      this.posts[index].update(post);
      this.posts[index].removeAttribute('hidden');
    });

    if (items.length < this.posts.length) {
      for (let i=items.length;i<this.posts.length;i++) {
        this.posts[i].setAttribute('hidden', true);
      }
    }
  }
}

if (window.customElements) {
  window.customElements.define('sm-posts', SMPosts);
}
else {
  window.addEventListener('WebComponentsReady', function(e) {
    window.customElements.define('sm-posts', SMPosts);
  });
}

export default SMPosts;