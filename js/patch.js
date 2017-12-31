import diff from './diff';

export default function(element, html) {

  const template = document.createElement('template');

  template.innerHTML = html;

  const result = diff(element.childNodes, template.content.childNodes);
}