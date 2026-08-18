jQuery(document).ready(function($) {
    // Pour chaque bouton d'upload d'image
    $(document).on('click', '.upload-image-btn', function(e) {
        e.preventDefault();
        
        var button = $(this);
        var field = button.closest('.dsj-widget-field').find('input[type="url"]');
        var preview = button.closest('.dsj-widget-field').find('.image-preview');
        
        // Créer le frame de média
        var frame = wp.media({
            title: 'Choisir une image pour le hero',
            button: { text: 'Utiliser cette image' },
            multiple: false,
            library: { type: 'image' }
        });
        
        // Quand une image est sélectionnée
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            
            // Mettre à jour le champ URL
            field.val(attachment.url);
            
            // Ajouter/mettre à jour l'aperçu
            if (preview.length === 0) {
                button.closest('.dsj-widget-field').append('<img src="' + attachment.url + '" class="image-preview" style="max-width:100%; height:auto; margin-top:10px;">');
            } else {
                preview.attr('src', attachment.url);
                preview.show();
            }
        });
        
        // Ouvrir le frame
        frame.open();
    });
});