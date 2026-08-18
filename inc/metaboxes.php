<?php
/**
 * Metaboxes personnalisÃ©es pour Formations, HÃ©bergements et Restaurant
 * Domaine Saint Joseph
 */

// Ajout des metaboxes
function dsj_add_metaboxes() {
    
    // Metabox pour les formations
    add_meta_box( 
        'formation_meta', 
        __( 'ðŸ“š DÃ©tails de la formation', 'domaine-saint-joseph' ), 
        'dsj_formation_meta_callback', 
        'formation', 
        'normal', 
        'high' 
    );
    
    // Metabox pour les hÃ©bergements
    add_meta_box( 
        'hebergement_meta', 
        __( 'ðŸ  DÃ©tails de l\'hÃ©bergement', 'domaine-saint-joseph' ), 
        'dsj_hebergement_meta_callback', 
        'hebergement', 
        'normal', 
        'high' 
    );
    
    // Metabox pour les plats du restaurant
    add_meta_box( 
        'menu_meta', 
        __( 'ðŸ½ï¸ DÃ©tails du plat', 'domaine-saint-joseph' ), 
        'dsj_menu_meta_callback', 
        'menu', 
        'normal', 
        'high' 
    );
}
add_action( 'add_meta_boxes', 'dsj_add_metaboxes' );

// ========================================
// FORMATION METABOX
// ========================================

function dsj_formation_meta_callback( $post ) {
    wp_nonce_field( 'dsj_save_meta', 'dsj_meta_nonce' );
    ?>
    <div style="background: #fff3cd; border-left: 4px solid #D4AC0D; padding: 12px 15px; margin-bottom: 20px; border-radius: 4px;">
        <strong>ðŸ’¡ Guide pour cette formation :</strong><br>
        <small>
            Remplissez les champs ci-dessous. Ils apparaÃ®tront sur la fiche de la formation sur le site.<br>
            <strong>DurÃ©e</strong> : ex. "6 mois", "1 an"<br>
            <strong>Prix</strong> : ex. "45 000 F CFA"<br>
            <strong>Niveau</strong> : ex. "DÃ©butant", "BEPC requis"<br>
            <strong>Places</strong> : nombre maximum d'apprenantes<br>
            N'oubliez pas d'ajouter une <strong>image mise en avant</strong> dans la colonne de droite !
        </small>
    </div>
    <?php
    
    $duree = get_post_meta( $post->ID, '_dsj_duree', true );
    $prix  = get_post_meta( $post->ID, '_dsj_prix', true );
    $niveau = get_post_meta( $post->ID, '_dsj_niveau', true );
    $places = get_post_meta( $post->ID, '_dsj_places', true );
    $formateur = get_post_meta( $post->ID, '_dsj_formateur', true );
    $horaires = get_post_meta( $post->ID, '_dsj_horaires', true );
    ?>
    <style>
        .dsj-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            padding: 10px 0;
        }
        .dsj-meta-field {
            margin-bottom: 10px;
        }
        .dsj-meta-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #1A5276;
        }
        .dsj-meta-field input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .dsj-meta-field .description {
            font-size: 11px;
            color: #666;
            margin-top: 3px;
        }
    </style>
    
    <div class="dsj-meta-grid">
        <div class="dsj-meta-field">
            <label for="dsj_duree">ðŸ“… DurÃ©e</label>
            <input type="text" id="dsj_duree" name="dsj_duree" value="<?php echo esc_attr( $duree ); ?>" 
                   placeholder="Ex: 6 mois, 1 an">
            <div class="description">DurÃ©e totale de la formation</div>
        </div>
        
        <div class="dsj-meta-field">
            <label for="dsj_prix">ðŸ’° Prix / Frais</label>
            <input type="text" id="dsj_prix" name="dsj_prix" value="<?php echo esc_attr( $prix ); ?>" 
                   placeholder="Ex: 45 000 F CFA">
            <div class="description">CoÃ»t total ou frais d'inscription</div>
        </div>
        
        <div class="dsj-meta-field">
            <label for="dsj_niveau">ðŸ“š Niveau requis</label>
            <input type="text" id="dsj_niveau" name="dsj_niveau" value="<?php echo esc_attr( $niveau ); ?>" 
                   placeholder="Ex: DÃ©butant, BEPC">
            <div class="description">PrÃ©requis pour suivre la formation</div>
        </div>
        
        <div class="dsj-meta-field">
            <label for="dsj_places">ðŸ‘¥ Places disponibles</label>
            <input type="number" id="dsj_places" name="dsj_places" value="<?php echo esc_attr( $places ); ?>" 
                   placeholder="Ex: 15">
            <div class="description">Nombre maximum d'apprenantes</div>
        </div>
        
        <div class="dsj-meta-field">
            <label for="dsj_formateur">ðŸ‘©â€ðŸ« Formatrice</label>
            <input type="text" id="dsj_formateur" name="dsj_formateur" value="<?php echo esc_attr( $formateur ); ?>" 
                   placeholder="Ex: SÅ“ur Marie">
            <div class="description">Nom de la responsable pÃ©dagogique</div>
        </div>
        
        <div class="dsj-meta-field">
            <label for="dsj_horaires">â° Horaires</label>
            <input type="text" id="dsj_horaires" name="dsj_horaires" value="<?php echo esc_attr( $horaires ); ?>" 
                   placeholder="Ex: Lundi-Vendredi 8h-12h">
            <div class="description">Jours et heures des cours</div>
        </div>
    </div>
    <?php
}

// ========================================
// HÃ‰BERGEMENT METABOX
// ========================================

function dsj_hebergement_meta_callback( $post ) {
    wp_nonce_field( 'dsj_save_meta', 'dsj_meta_nonce' );
    ?>
    <div style="background: #d1ecf1; border-left: 4px solid #0c5460; padding: 12px 15px; margin-bottom: 20px; border-radius: 4px;">
        <strong>ðŸ’¡ Guide pour cet hÃ©bergement :</strong><br>
        <small>
            <strong>CapacitÃ©</strong> : nombre de personnes (ex. "2")<br>
            <strong>Prix</strong> : tarif par nuit en F CFA (ex. "8 000")<br>
            <strong>DisponibilitÃ©</strong> : mettez Ã  jour dÃ¨s qu'une chambre est rÃ©servÃ©e !<br>
            <strong>Ã‰quipements</strong> : sÃ©parÃ©s par des virgules (ex. "Climatisation, Wi-Fi, Salle de bain")
        </small>
    </div>
    <?php
    
    $capacite = get_post_meta( $post->ID, '_dsj_capacite', true );
    $prix_nuit = get_post_meta( $post->ID, '_dsj_prix_nuit', true );
    $dispo = get_post_meta( $post->ID, '_dsj_dispo', true );
    $equipements = get_post_meta( $post->ID, '_dsj_equipements', true );
    ?>
    <style>
        .dsj-meta-group {
            margin-bottom: 15px;
        }
        .dsj-meta-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #1A5276;
        }
        .dsj-meta-group input,
        .dsj-meta-group select,
        .dsj-meta-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .dsj-meta-group .description {
            font-size: 11px;
            color: #666;
            margin-top: 3px;
        }
    </style>
    
    <div class="dsj-meta-group">
        <label for="dsj_capacite">ðŸ‘¥ CapacitÃ© (personnes)</label>
        <input type="number" id="dsj_capacite" name="dsj_capacite" value="<?php echo esc_attr( $capacite ); ?>" 
               placeholder="Ex: 2">
        <div class="description">Nombre maximum de personnes</div>
    </div>
    
    <div class="dsj-meta-group">
        <label for="dsj_prix_nuit">ðŸ’° Prix par nuit (F CFA)</label>
        <input type="text" id="dsj_prix_nuit" name="dsj_prix_nuit" value="<?php echo esc_attr( $prix_nuit ); ?>" 
               placeholder="Ex: 8 000">
        <div class="description">Tarif pour une nuitÃ©e</div>
    </div>
    
    <div class="dsj-meta-group">
        <label for="dsj_equipements">ðŸ›‹ï¸ Ã‰quipements</label>
        <textarea id="dsj_equipements" name="dsj_equipements" rows="3" 
                  placeholder="Ex: Climatisation, Wi-Fi, Salle de bain privÃ©e"><?php echo esc_textarea( $equipements ); ?></textarea>
        <div class="description">SÃ©parÃ©s par des virgules</div>
    </div>
    
    <div class="dsj-meta-group">
        <label for="dsj_dispo">ðŸ“… DisponibilitÃ©</label>
        <select id="dsj_dispo" name="dsj_dispo">
            <option value="disponible" <?php selected( $dispo, 'disponible' ); ?>>âœ… Disponible</option>
            <option value="sur_reservation" <?php selected( $dispo, 'sur_reservation' ); ?>>ðŸ“ž Sur rÃ©servation</option>
            <option value="complet" <?php selected( $dispo, 'complet' ); ?>>âŒ Complet</option>
        </select>
    </div>
    <?php
}

// ========================================
// RESTAURANT METABOX
// ========================================

function dsj_menu_meta_callback( $post ) {
    wp_nonce_field( 'dsj_menu_meta_save', 'dsj_menu_meta_nonce' );
    ?>
    <div style="background: #f8d7da; border-left: 4px solid #721c24; padding: 12px 15px; margin-bottom: 20px; border-radius: 4px;">
        <strong>ðŸ’¡ Guide pour ce plat :</strong><br>
        <small>
            <strong>Prix</strong> : en F CFA (ex. "3 500")<br>
            <strong>Temps</strong> : temps de prÃ©paration (ex. "20 min")<br>
            <strong>IngrÃ©dients</strong> : liste complÃ¨te<br>
            <strong>AllergÃ¨nes</strong> : gluten, lactose, fruits Ã  coque...
        </small>
    </div>
    <?php
    
    $prix = get_post_meta( $post->ID, '_menu_prix', true );
    $temps = get_post_meta( $post->ID, '_menu_temps', true );
    $ingredients = get_post_meta( $post->ID, '_menu_ingredients', true );
    $allergenes = get_post_meta( $post->ID, '_menu_allergenes', true );
    ?>
    <style>
        .dsj-meta-menu { 
            display: grid; 
            grid-template-columns: repeat(2, 1fr); 
            gap: 15px; 
        }
        .dsj-meta-field { 
            margin-bottom: 10px; 
        }
        .dsj-meta-field label { 
            display: block; 
            font-weight: 600; 
            margin-bottom: 5px; 
            color: #1A5276; 
        }
        .dsj-meta-field input, 
        .dsj-meta-field textarea { 
            width: 100%; 
            padding: 8px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
        }
        .dsj-meta-field-full {
            grid-column: span 2;
        }
    </style>
    
    <div class="dsj-meta-menu">
        <div class="dsj-meta-field">
            <label for="menu_prix">ðŸ’° Prix (F CFA)</label>
            <input type="text" id="menu_prix" name="menu_prix" value="<?php echo esc_attr( $prix ); ?>" 
                   placeholder="Ex: 3 500">
        </div>
        
        <div class="dsj-meta-field">
            <label for="menu_temps">â° Temps de prÃ©paration</label>
            <input type="text" id="menu_temps" name="menu_temps" value="<?php echo esc_attr( $temps ); ?>" 
                   placeholder="Ex: 20 min">
        </div>
        
        <div class="dsj-meta-field dsj-meta-field-full">
            <label for="menu_ingredients">ðŸ¥— IngrÃ©dients</label>
            <textarea id="menu_ingredients" name="menu_ingredients" rows="3" 
                      placeholder="Liste des ingrÃ©dients..."><?php echo esc_textarea( $ingredients ); ?></textarea>
        </div>
        
        <div class="dsj-meta-field">
            <label for="menu_allergenes">âš ï¸ AllergÃ¨nes</label>
            <input type="text" id="menu_allergenes" name="menu_allergenes" value="<?php echo esc_attr( $allergenes ); ?>" 
                   placeholder="Ex: Gluten, lactose, fruits Ã  coque">
        </div>
    </div>
    <?php
}

// ========================================
// SAUVEGARDE DES METABOXES
// ========================================

// Sauvegarde pour formations et hÃ©bergements
function dsj_save_meta( $post_id ) {
    // VÃ©rifications de sÃ©curitÃ©
    if ( ! isset( $_POST['dsj_meta_nonce'] ) || ! wp_verify_nonce( $_POST['dsj_meta_nonce'], 'dsj_save_meta' ) ) {
        return;
    }
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    // Champs des formations
    $formation_fields = ['dsj_duree', 'dsj_prix', 'dsj_niveau', 'dsj_places', 'dsj_formateur', 'dsj_horaires'];
    foreach ( $formation_fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            $key = '_' . $field;
            update_post_meta( $post_id, $key, sanitize_text_field( $_POST[$field] ) );
        }
    }
    
    // Champs des hÃ©bergements
    $hebergement_fields = ['dsj_capacite', 'dsj_prix_nuit', 'dsj_dispo', 'dsj_equipements'];
    foreach ( $hebergement_fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            $key = '_' . $field;
            if ( $field === 'dsj_equipements' ) {
                update_post_meta( $post_id, $key, sanitize_textarea_field( $_POST[$field] ) );
            } else {
                update_post_meta( $post_id, $key, sanitize_text_field( $_POST[$field] ) );
            }
        }
    }
}
add_action( 'save_post', 'dsj_save_meta' );

// Sauvegarde pour les plats du restaurant
function dsj_save_menu_meta( $post_id ) {
    if ( ! isset( $_POST['dsj_menu_meta_nonce'] ) || ! wp_verify_nonce( $_POST['dsj_menu_meta_nonce'], 'dsj_menu_meta_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    $fields = ['menu_prix', 'menu_temps', 'menu_ingredients', 'menu_allergenes'];
    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            $key = '_' . $field;
            if ( $field === 'menu_ingredients' ) {
                update_post_meta( $post_id, $key, sanitize_textarea_field( $_POST[$field] ) );
            } else {
                update_post_meta( $post_id, $key, sanitize_text_field( $_POST[$field] ) );
            }
        }
    }
}
add_action( 'save_post', 'dsj_save_menu_meta' );

// ========================================
// COLONNES PERSONNALISÃ‰ES DANS L'ADMIN
// ========================================

function dsj_formation_columns( $columns ) {
    $columns['duree'] = __( 'DurÃ©e', 'domaine-saint-joseph' );
    $columns['prix'] = __( 'Prix', 'domaine-saint-joseph' );
    $columns['places'] = __( 'Places', 'domaine-saint-joseph' );
    return $columns;
}
add_filter( 'manage_formation_posts_columns', 'dsj_formation_columns' );

function dsj_formation_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'duree':
            echo esc_html( get_post_meta( $post_id, '_dsj_duree', true ) );
            break;
        case 'prix':
            echo esc_html( get_post_meta( $post_id, '_dsj_prix', true ) );
            break;
        case 'places':
            echo esc_html( get_post_meta( $post_id, '_dsj_places', true ) );
            break;
    }
}
add_action( 'manage_formation_posts_custom_column', 'dsj_formation_column_content', 10, 2 );

// Colonnes pour les plats du restaurant
function dsj_menu_columns( $columns ) {
    $columns['prix'] = __( 'Prix', 'domaine-saint-joseph' );
    $columns['temps'] = __( 'Temps', 'domaine-saint-joseph' );
    return $columns;
}
add_filter( 'manage_menu_posts_columns', 'dsj_menu_columns' );

function dsj_menu_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'prix':
            echo esc_html( get_post_meta( $post_id, '_menu_prix', true ) ) . ' F CFA';
            break;
        case 'temps':
            echo esc_html( get_post_meta( $post_id, '_menu_temps', true ) );
            break;
    }
}
add_action( 'manage_menu_posts_custom_column', 'dsj_menu_column_content', 10, 2 );