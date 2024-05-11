
import InputPreviewFiles from "./ui/file_preview.js";
const form = document.querySelectorAll('.idform');
form.forEach(function (button) {
    new InputPreviewFiles({section: button,})
    
})


$('.summernote').summernote({
    placeholder: 'Description de l\'article',
    tabsize: 2,
    height : 'auto',
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
// var simplemde1 = new SimpleMDE();
// const textarea = document.getElementById('description');

// textarea.addEventListener('input', function() {
//     this.style.height = 'auto';
//     this.style.height = (this.scrollHeight) + 'px';
// });