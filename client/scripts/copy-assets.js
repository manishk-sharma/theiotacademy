import fs from 'fs';
import path from 'path';

const src = path.resolve(process.cwd(), '../assets');
const dest = path.resolve(process.cwd(), 'public/assets');

if (fs.existsSync(src)) {
  if (!fs.existsSync(dest)) {
    console.log('[Build] Copying static assets from root to client/public/assets for cloud deployment...');
    fs.cpSync(src, dest, { recursive: true });
    console.log('[Build] Assets copied successfully.');
  } else {
    console.log('[Build] Static assets junction/directory present in client/public/assets.');
  }
} else {
  console.warn('[Build] Warning: root ../assets directory not found.');
}

