const regs = document.getElementById('regs');

if (regs) {
    regs.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-cpt btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/reg/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}