import './bootstrap';
import 'preline'

document.addEventListener('livewire:nagivated',() => {
    window.HSStaticMethods.autoInit();
})