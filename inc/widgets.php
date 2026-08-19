<?php
/**
 * Widgets personnalis&#233;s pour le th&#232;me
 * Domaine Saint Joseph
 */

// V&#233;rifier si la classe n'existe pas d&#233;j&#224;
if ( ! class_exists( 'DSJ_Hero_Widget' ) ) {

    class DSJ_Hero_Widget extends WP_Widget {
        
        public function __construct() {
            parent::__construct(
                'dsj_hero_widget',
                __( '&#127775; Bandeau Hero DSJ', 'domaine-saint-joseph' ),
                [ 
                    'description' => __( 'Widget pour le bandeau principal avec image, texte et boutons', 'domaine-saint-joseph' ),
                    'classname' => 'dsj-hero-widget'
                ]
            );
        }
        
        public function widget( $args, $instance ) {
            echo $args['before_widget'];
            
            $badge = ! empty( $instance['badge'] ) ? $instance['badge'] : '';
            $titre = ! empty( $instance['titre'] ) ? $instance['titre'] : '';
            $sous_titre = ! empty( $instance['sous_titre'] ) ? $instance['sous_titre'] : '';
            $image_url = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
            $bouton1_texte = ! empty( $instance['bouton1_texte'] ) ? $instance['bouton1_texte'] : '';
            $bouton1_lien = ! empty( $instance['bouton1_lien'] ) ? $instance['bouton1_lien'] : '';
            $bouton2_texte = ! empty( $instance['bouton2_texte'] ) ? $instance['bouton2_texte'] : '';
            $bouton2_lien = ! empty( $instance['bouton2_lien'] ) ? $instance['bouton2_lien'] : '';
            $overlay_opacity = ! empty( $instance['overlay_opacity'] ) ? $instance['overlay_opacity'] : '0.7';
            
            // Style inline pour garantir l'affichage mobile
            $bg_style = ! empty( $image_url ) ? 'background-image: url(' . esc_url( $image_url ) . '); background-size: cover; background-position: center;' : '';
            $fallback_bg = empty( $image_url ) ? 'background: linear-gradient(135deg, var(--clr-primary, #1A5276) 0%, #1a3c5e 100%);' : '';
            ?>
            
            <div class="custom-hero" style="<?php echo esc_attr( $bg_style . $fallback_bg ); ?>">
                <div class="hero-overlay" style="background: rgba(26, 60, 94, <?php echo esc_attr( $overlay_opacity ); ?>);"></div>
                <div class="hero-content-wrapper">
                    <div class="container">
                        <div class="hero-content">
                            <?php if ( $badge ) : ?>
                                <span class="hero-badge"><?php echo esc_html( $badge ); ?></span>
                            <?php endif; ?>
                            
                            <h1 class="hero-title"><?php echo wp_kses_post( nl2br( $titre ) ); ?></h1>
                            
                            <?php if ( $sous_titre ) : ?>
                                <p class="hero-subtitle"><?php echo nl2br( esc_html( $sous_titre ) ); ?></p>
                            <?php endif; ?>
                            
                            <div class="hero-buttons">
                                <?php if ( ! empty( $bouton1_texte ) && ! empty( $bouton1_lien ) ) : ?>
                                    <a href="<?php echo esc_url( $bouton1_lien ); ?>" class="btn btn-primary btn-large">
                                        <?php echo esc_html( $bouton1_texte ); ?>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ( ! empty( $bouton2_texte ) && ! empty( $bouton2_lien ) ) : ?>
                                    <a href="<?php echo esc_url( $bouton2_lien ); ?>" class="btn btn-secondary btn-large">
                                        <?php echo esc_html( $bouton2_texte ); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-wave">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
                        <path fill="#ffffff" fill-opacity="1" d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,80C1120,85,1280,75,1360,69.3L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
                    </svg>
                </div>
            </div>
            <?php
            echo $args['after_widget'];
        }
        
        public function form( $instance ) {
            $badge = ! empty( $instance['badge'] ) ? $instance['badge'] : '&#9962; Domaine Saint Joseph - Bobo-Dioulasso';
            $titre = ! empty( $instance['titre'] ) ? $instance['titre'] : 'Former les jeunes filles, accueillir avec compassion';
            $sous_titre = ! empty( $instance['sous_titre'] ) ? $instance['sous_titre'] : "Centre de formation technique & Maison d'accueil\nBobo-Dioulasso, Burkina Faso";
            $image_url = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
            $bouton1_texte = ! empty( $instance['bouton1_texte'] ) ? $instance['bouton1_texte'] : '&#127891; Nos formations';
            $bouton1_lien = ! empty( $instance['bouton1_lien'] ) ? $instance['bouton1_lien'] : '/formations';
            $bouton2_texte = ! empty( $instance['bouton2_texte'] ) ? $instance['bouton2_texte'] : '&#127968; Maison d\'accueil';
            $bouton2_lien = ! empty( $instance['bouton2_lien'] ) ? $instance['bouton2_lien'] : '/maison-accueil';
            $overlay_opacity = ! empty( $instance['overlay_opacity'] ) ? $instance['overlay_opacity'] : '0.7';
            ?>
            <style>
                .dsj-widget-field { margin-bottom: 15px; }
                .dsj-widget-field label { display: block; font-weight: 600; margin-bottom: 5px; color: #1A5276; }
                .dsj-widget-field input[type="text"],
                .dsj-widget-field input[type="url"],
                .dsj-widget-field textarea,
                .dsj-widget-field select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
                .dsj-widget-field .description { font-size: 11px; color: #666; margin-top: 3px; }
                .image-preview { margin-top: 10px; max-width: 100%; border-radius: 4px; }
                .dsj-widget-field hr { margin: 15px 0; }
                .dsj-widget-field h4 { margin: 0 0 10px; color: #1A5276; }
            </style>
            
            <div class="dsj-widget-field">
                <label for="<?php echo $this->get_field_id( 'badge' ); ?>">&#127991;&#65039; Badge :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'badge' ); ?>" 
                       name="<?php echo $this->get_field_name( 'badge' ); ?>" 
                       type="text" value="<?php echo esc_attr( $badge ); ?>">
                <div class="description">Petit texte au-dessus du titre</div>
            </div>
            
            <div class="dsj-widget-field">
                <label for="<?php echo $this->get_field_id( 'titre' ); ?>">&#128221; Titre principal :</label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'titre' ); ?>" 
                          name="<?php echo $this->get_field_name( 'titre' ); ?>" rows="3"><?php echo esc_textarea( $titre ); ?></textarea>
                <div class="description">Utilisez &lt;br&gt; pour les retours &#224; la ligne</div>
            </div>
            
            <div class="dsj-widget-field">
                <label for="<?php echo $this->get_field_id( 'sous_titre' ); ?>">&#128196; Sous-titre :</label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'sous_titre' ); ?>" 
                          name="<?php echo $this->get_field_name( 'sous_titre' ); ?>" rows="3"><?php echo esc_textarea( $sous_titre ); ?></textarea>
            </div>
            
            <div class="dsj-widget-field">
                <label for="<?php echo $this->get_field_id( 'image_url' ); ?>">&#128444;&#65039; Image de fond :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'image_url' ); ?>" 
                       name="<?php echo $this->get_field_name( 'image_url' ); ?>" 
                       type="url" value="<?php echo esc_url( $image_url ); ?>" placeholder="https://...">
                <div class="description">
                    <button type="button" class="button upload-image-btn">&#128247; Choisir une image</button>
                    <span> ou collez une URL</span>
                </div>
                <?php if ( $image_url ) : ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" class="image-preview" style="max-width:100%; margin-top:10px;">
                <?php endif; ?>
            </div>
            
            <div class="dsj-widget-field">
                <label for="<?php echo $this->get_field_id( 'overlay_opacity' ); ?>">&#127912; Opacit&#233; :</label>
                <select id="<?php echo $this->get_field_id( 'overlay_opacity' ); ?>" 
                        name="<?php echo $this->get_field_name( 'overlay_opacity' ); ?>">
                    <option value="0.3" <?php selected( $overlay_opacity, '0.3' ); ?>>L&#233;g&#232;re (30%)</option>
                    <option value="0.5" <?php selected( $overlay_opacity, '0.5' ); ?>>Moyenne (50%)</option>
                    <option value="0.7" <?php selected( $overlay_opacity, '0.7' ); ?>>Forte (70%)</option>
                    <option value="0.9" <?php selected( $overlay_opacity, '0.9' ); ?>>Tr&#232;s forte (90%)</option>
                </select>
                <div class="description">Plus l'opacit&#233; est forte, plus le texte est lisible</div>
            </div>
            
            <hr>
            <h4>&#128280; Bouton 1 (principal)</h4>
            <div class="dsj-widget-field">
                <label for="<?php echo $this->get_field_id( 'bouton1_texte' ); ?>">Texte :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'bouton1_texte' ); ?>" 
                       name="<?php echo $this->get_field_name( 'bouton1_texte' ); ?>" 
                       type="text" value="<?php echo esc_attr( $bouton1_texte ); ?>">
                <div class="description">Ex: &#127891; Nos formations</div>
            </div>
            <div class="dsj-widget-field">
                <label for="<?php echo $this->get_field_id( 'bouton1_lien' ); ?>">Lien :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'bouton1_lien' ); ?>" 
                       name="<?php echo $this->get_field_name( 'bouton1_lien' ); ?>" 
                       type="url" value="<?php echo esc_url( $bouton1_lien ); ?>" placeholder="https://...">
                <div class="description">Ex: /formations, /contact, https://...</div>
            </div>
            
            <hr>
            <h4>&#128280; Bouton 2 (secondaire)</h4>
            <div class="dsj-widget-field">
                <label for="<?php echo $this->get_field_id( 'bouton2_texte' ); ?>">Texte :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'bouton2_texte' ); ?>" 
                       name="<?php echo $this->get_field_name( 'bouton2_texte' ); ?>" 
                       type="text" value="<?php echo esc_attr( $bouton2_texte ); ?>">
            </div>
            <div class="dsj-widget-field">
                <label for="<?php echo $this->get_field_id( 'bouton2_lien' ); ?>">Lien :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'bouton2_lien' ); ?>" 
                       name="<?php echo $this->get_field_name( 'bouton2_lien' ); ?>" 
                       type="url" value="<?php echo esc_url( $bouton2_lien ); ?>" placeholder="https://...">
            </div>
            <?php
        }
        
        public function update( $new_instance, $old_instance ) {
            $instance = [];
            $instance['badge'] = sanitize_text_field( $new_instance['badge'] );
            $instance['titre'] = sanitize_textarea_field( $new_instance['titre'] );
            $instance['sous_titre'] = sanitize_textarea_field( $new_instance['sous_titre'] );
            $instance['image_url'] = esc_url_raw( $new_instance['image_url'] );
            $instance['bouton1_texte'] = sanitize_text_field( $new_instance['bouton1_texte'] );
            $instance['bouton1_lien'] = esc_url_raw( $new_instance['bouton1_lien'] );
            $instance['bouton2_texte'] = sanitize_text_field( $new_instance['bouton2_texte'] );
            $instance['bouton2_lien'] = esc_url_raw( $new_instance['bouton2_lien'] );
            $instance['overlay_opacity'] = sanitize_text_field( $new_instance['overlay_opacity'] );
            
            // Forcer les valeurs par d&#233;faut si vides (optionnel)
            if ( empty( $instance['bouton1_texte'] ) ) {
                $instance['bouton1_texte'] = '&#127891; Nos formations';
            }
            if ( empty( $instance['bouton1_lien'] ) ) {
                $instance['bouton1_lien'] = '/formations';
            }
            if ( empty( $instance['bouton2_texte'] ) ) {
                $instance['bouton2_texte'] = '&#127968; Maison d\'accueil';
            }
            if ( empty( $instance['bouton2_lien'] ) ) {
                $instance['bouton2_lien'] = '/maison-accueil';
            }
            
            return $instance;
        }
    }
}

// Enregistrement des widgets
if ( ! function_exists( 'dsj_register_widgets' ) ) {
    function dsj_register_widgets() {
        if ( class_exists( 'DSJ_Hero_Widget' ) ) {
            register_widget( 'DSJ_Hero_Widget' );
        }
    }
    add_action( 'widgets_init', 'dsj_register_widgets' );
}