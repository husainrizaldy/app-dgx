import './bootstrap';
import '../css/app.css';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import Swal from 'sweetalert2';

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
window.Swal = Swal;