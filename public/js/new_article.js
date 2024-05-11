
import InputPreviewFiles from "./ui/file_preview.js";
const form = document.querySelectorAll('.idform');
form.forEach(function (button) {
    new InputPreviewFiles({section: button,})
    
})


var simplemde = new SimpleMDE();
// var simplemde1 = new SimpleMDE();
// const textarea = document.getElementById('description');

// textarea.addEventListener('input', function() {
//     this.style.height = 'auto';
//     this.style.height = (this.scrollHeight) + 'px';
// });