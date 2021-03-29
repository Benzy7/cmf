const nature = document.getElementById('nature');

if (nature) {
    nature.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-nat btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/naturec/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}