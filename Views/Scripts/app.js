import { ajaxPost } from './ajax.js';
import { saveToken, validateToken } from './auth.js';

document.addEventListener('DOMContentLoaded', (ev) => {
    validateToken();
  })