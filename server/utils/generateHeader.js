import fs from 'fs';
import { parseHtmlToJsx } from './domToJsx.js';

const headerPhpPath = 'c:/xampp/htdocs/theiotacademy/application/views/commons/inc/new-header.php';
const content = fs.readFileSync(headerPhpPath, 'utf-8');
const lines = content.split('\n');

// Markup is lines 68 to 1311
const markupLines = lines.slice(67, 1311);
const markupHtml = markupLines.join('\n');
console.log('Total header markup lines:', markupLines.length);

const headerJsx = parseHtmlToJsx(markupHtml);

const headerComponent = `import React from 'react';
import MegaMenu from './MegaMenu';

const Header = () => {
  return (
    <>
      ${headerJsx}
    </>
  );
};

export default Header;
`;

fs.writeFileSync('c:/xampp/htdocs/theiotacademy/client/src/components/includes/Header.jsx', headerComponent, 'utf-8');
console.log('Successfully written client/src/components/includes/Header.jsx with DOM parser!');
