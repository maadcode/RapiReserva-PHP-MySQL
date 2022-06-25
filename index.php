<script type="module">
    import { validateToken } from './Views/Scripts/auth.js';
    
    document.addEventListener('DOMContentLoaded', (ev) => {
        validateToken();
    })
</script>