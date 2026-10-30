import fs from 'fs';
import path from 'path';

// Helper to convert style string to JSX object string
function styleStringToJsx(styleStr) {
  if (!styleStr || styleStr.trim() === '') return '{}';
  const properties = styleStr.split(';').filter(p => p.trim() !== '');
  const obj = {};
  for (const prop of properties) {
    const colonIdx = prop.indexOf(':');
    if (colonIdx === -1) continue;
    let key = prop.substring(0, colonIdx).trim();
    let val = prop.substring(colonIdx + 1).trim();
    // convert kebab-case to camelCase
    key = key.replace(/-([a-z])/g, (_, letter) => letter.toUpperCase());
    obj[key] = val;
  }
  return JSON.stringify(obj);
}

export function htmlToJsx(html) {
  let jsx = html;

  // 1. Remove or convert HTML comments
  // In JSX, comments outside tags must be wrapped in {/* ... */}
  jsx = jsx.replace(/<!--[\s\S]*?-->/g, (match) => {
    // If the comment contains large commented HTML blocks, keep it as JSX comment
    const cleanComment = match.replace(/^<!--/, '').replace(/-->$/, '').replace(/\*\//g, '* /');
    return `{/* ${cleanComment} */}`;
  });

  // 2. Replace class= with className=
  jsx = jsx.replace(/\bclass="/g, 'className="');
  jsx = jsx.replace(/\bclass='/g, "className='");

  // 3. Replace for= with htmlFor=
  jsx = jsx.replace(/\bfor="/g, 'htmlFor="');
  jsx = jsx.replace(/\bfor='/g, "htmlFor='");

  // 4. Convert style="..."
  jsx = jsx.replace(/\bstyle="([^"]*)"/g, (match, styleContent) => {
    const jsxStyle = styleStringToJsx(styleContent);
    return `style={${jsxStyle}}`;
  });

  // 5. SVG and HTML attribute conversions
  const attrMap = {
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

  for (const [attr, camel] of Object.entries(attrMap)) {
    const regex = new RegExp(`\\b${attr}=`, 'g');
    jsx = jsx.replace(regex, `${camel}=`);
  }

  // 6. Ensure self-closing tags are closed
  const voidTags = ['img', 'input', 'br', 'hr', 'source', 'link', 'meta', 'col'];
  for (const tag of voidTags) {
    const regex = new RegExp(`<(${tag}\\b[^>]*?)(?<!/)>`, 'gi');
    jsx = jsx.replace(regex, '<$1 />');
  }

  // 7. PHP replacements
  jsx = jsx.replace(/<\?php\s*\$this->load->view\(["']commons\/inc\/new-megamenu\.php["']\)\s*;?\s*\?>/g, '<MegaMenu />');
  jsx = jsx.replace(/<\?php\s*echo\s+asset_url\(\);?\s*\?>/g, '/assets/');
  jsx = jsx.replace(/<\?=\s*asset_url\(\);?\s*\?>/g, '/assets/');
  jsx = jsx.replace(/<\?php\s*echo\s+date\(["']Y["']\);?\s*\?>/g, '{new Date().getFullYear()}');
  jsx = jsx.replace(/<\?=\s*date\(["']Y["']\);?\s*\?>/g, '{new Date().getFullYear()}');

  return jsx;
}

