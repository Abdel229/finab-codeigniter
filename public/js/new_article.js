
import InputPreviewFiles from "./ui/file_preview.js";
const form = document.querySelectorAll('form.idform');

new InputPreviewFiles({
    section: form,
})

const textarea = document.getElementById('description');

textarea.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});