import './bootstrap';
import Quill from 'quill';
import 'quill/dist/quill.snow.css';
import ImageResize from 'quill-image-resize-module';

Quill.register('modules/imageResize', ImageResize);

const quill = new Quill('#content', {
    theme: 'snow',
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            ['image', 'link'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'align': [] }],
        ],
        imageResize: {
            // Konfigurasi opsional
            displaySize: true,
        }
    }
});
