
import InputPreviewFiles from "./ui/file_preview.js";
const form = document.querySelectorAll('form#idform');


var simplemde = new SimpleMDE({ element: document.getElementById("description") });
var simplemde1 = new SimpleMDE({ element: document.getElementById("description1") });
// const textarea = document.getElementById('description');

// textarea.addEventListener('input', function() {
//     this.style.height = 'auto';
//     this.style.height = (this.scrollHeight) + 'px';
// });

new InputPreviewFiles({
    section: form,
})