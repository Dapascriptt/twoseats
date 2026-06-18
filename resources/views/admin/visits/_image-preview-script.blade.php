<script>
function previewImages(input) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';

    if (!input.files || input.files.length === 0) {
        preview.classList.add('hidden');
        return;
    }

    preview.classList.remove('hidden');

    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const div = document.createElement('div');
            div.className = 'aspect-square rounded-xl overflow-hidden bg-gray-100';
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-full h-full object-cover';
            div.appendChild(img);
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}
</script>
