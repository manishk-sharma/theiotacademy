import { parse, NodeType } from 'node-html-parser';

const voidElements = new Set(['img', 'input', 'br', 'hr', 'source', 'link', 'meta', 'col']);

const svgAttrMap = {
  'clip-rule': 'clipRule',
  'fill-rule': 'fillRule',
  'stroke-width': 'strokeWidth',
  'stroke-linecap': 'strokeLinecap',
  'stroke-linejoin': 'strokeLinejoin',
  'stroke-miterlimit': 'strokeMiterlimit',
  'stop-color': 'stopColor',
  'stop-opacity': 'stopOpacity',
  'fill-opacity': 'fillOpacity',
  'font-family': 'fontFamily',
  'font-size': 'fontSize',
  'font-weight': 'fontWeight',
  'xlink:href': 'xlinkHref',
  'tabindex': 'tabIndex',
  'readonly': 'readOnly',
  'autocomplete': 'autoComplete',
  'autofocus': 'autoFocus',
  'novalidate': 'noValidate',
  'charset': 'charSet',
  'fetchpriority': 'fetchPriority',
  'crossorigin': 'crossOrigin'
};

function styleStringToJsx(styleStr) {
  if (!styleStr || styleStr.trim() === '') return null;
  const properties = styleStr.split(';').filter(p => p.trim() !== '');
  const obj = {};
  for (const prop of properties) {
    const colonIdx = prop.indexOf(':');
    if (colonIdx === -1) continue;
    let key = prop.substring(0, colonIdx).trim();
    let val = prop.substring(colonIdx + 1).trim();
    if (!key) continue;
    // camelCase
    key = key.replace(/-([a-z])/g, (_, letter) => letter.toUpperCase());
    obj[key] = val;
  }
  return obj;
}

export function convertNodeToJsx(node) {
  if (node.nodeType === NodeType.TEXT_NODE) {
    let raw = node.rawText;
    if (!raw) return '';
    // Escape literal curlies if they aren't part of an expression
    raw = raw.replace(/\{/g, '&#123;').replace(/\}/g, '&#125;');
    return raw;
  }

  if (node.nodeType === NodeType.COMMENT_NODE) {
    const comment = node.rawText.replace(/\*\//g, '* /');
    return `{/* ${comment} */}`;
  }

  if (node.nodeType === NodeType.ELEMENT_NODE) {
    const rawTagName = node.rawTagName.toLowerCase();
    let tag = rawTagName;

    // Attributes
    const attrs = [];
    for (const [attrName, attrVal] of Object.entries(node.attributes)) {
      if (attrName === 'class') {
        attrs.push(`className="${attrVal.replace(/"/g, '&quot;')}"`);
      } else if (attrName === 'for') {
        attrs.push(`htmlFor="${attrVal.replace(/"/g, '&quot;')}"`);
      } else if (attrName === 'style') {
        const styleObj = styleStringToJsx(attrVal);
        if (styleObj && Object.keys(styleObj).length > 0) {
          attrs.push(`style={${JSON.stringify(styleObj)}}`);
        }
      } else {
        const mappedAttr = svgAttrMap[attrName.toLowerCase()] || attrName;
        // Boolean attributes or standard strings
        if (attrVal === '' || attrVal === true) {
          attrs.push(mappedAttr);
        } else {
          // Replace PHP asset_url in attribute value
          let cleanVal = attrVal
            .replace(/<\?php\s*echo\s+asset_url\(\);?\s*\?>/g, '/assets/')
            .replace(/<\?=\s*asset_url\(\);?\s*\?>/g, '/assets/')
            .replace(/"/g, '&quot;');
          attrs.push(`${mappedAttr}="${cleanVal}"`);
        }
      }
    }

    const attrStr = attrs.length > 0 ? ' ' + attrs.join(' ') : '';

    if (voidElements.has(tag)) {
      return `<${tag}${attrStr} />`;
    }

    // Process children
    const childrenJsx = node.childNodes.map(child => convertNodeToJsx(child)).join('');
    return `<${tag}${attrStr}>${childrenJsx}</${tag}>`;
  }

  return '';
}

export function parseHtmlToJsx(html) {
  // Pre-clean PHP tags
  let cleaned = html
    .replace(/<\?php\s*echo\s+asset_url\(\);?\s*\?>/g, '/assets/')
    .replace(/<\?=\s*asset_url\(\);?\s*\?>/g, '/assets/')
    .replace(/<\?php\s*echo\s+date\(["']Y["']\);?\s*\?>/g, '{new Date().getFullYear()}')
    .replace(/<\?=\s*date\(["']Y["']\);?\s*\?>/g, '{new Date().getFullYear()}')
    .replace(/<\?php\s*\$this->load->view\(["']commons\/inc\/new-megamenu\.php["']\)\s*;?\s*\?>/g, '<div id="megamenu-placeholder"></div>');

  // Fix known legacy invalid nested tags like <h2>...</h1>
  cleaned = cleaned.replace(/<h2([^>]*)>([\s\S]*?)<\/h1>/gi, '<h2$1>$2</h2>');

  const root = parse(cleaned, {
    lowerCaseTagName: false,
    comment: true,
    voidTag: {
      tags: ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr']
    }
  });

  let jsx = root.childNodes.map(node => convertNodeToJsx(node)).join('\n');
  jsx = jsx.replace(/<div id="megamenu-placeholder"><\/div>/g, '<MegaMenu />');
  return jsx;
}

